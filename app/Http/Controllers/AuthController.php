<?php


namespace App\Http\Controllers;


use App\Repositories\UserRepository\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @group Auth
 *
 * Api for auth
 */
class AuthController extends RespondController
{
    protected $userRepository;

    /**
     * AuthController constructor.
     * @param $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function login(Request $request)
    {
        $user = $this->userRepository->findByUsername($request->input('username'));
        if (is_null($user)) {
            if ($user->check($request['password'])) {
                return $this->respond(['status' => 200, 'data' => $user['api_token']]);
            }
            return $this->respond(['status' => 401, 'data' => 'wrong password'], 401);
        }
        return $this->respondNotFoundError();
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if (!is_null($user)) {
            $user->update($request->all());
            return $this->respondSuccess();
        }
        return $this->respondNotFoundError();
    }


    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), User::rules());

        if (!$validate->fails()) {
            $this->userRepository->store($request->all());
            return $this->respondSuccess();
        }

        return $this->respondValidateError($validate->errors());

    }
}