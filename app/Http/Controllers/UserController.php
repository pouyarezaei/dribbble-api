<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobsResource;
use App\Http\Resources\ShotsResource;
use App\Providers\UserServiceProvider;
use App\Repositories\ShotRepository\ShotRepositoryInterface;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\User;
use Illuminate\Http\JsonResponse;


/**
 * @group Users
 *
 * Api for users
 */
class UserController extends RespondController
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $username string
     * @urlParam  username required The username of the user. Example: candice
     * @return JsonResponse
     */
    public function getProfile($username)
    {
        $user = $this->userRepository->findByUsername($username);
        if ($user) {
            return $this->respond(['status' => 200, 'data' => $user]);

        }
        return $this->respondNotFoundError();

    }

    /**
     * @param $username string
     * @urlParam  username required The username of the user. Example: candice
     * @return ShotsResource|JsonResponse
     */
    public function getShots($username)
    {
        $user = $this->userRepository->findByUsername($username);
        if ($user) {
            return new ShotsResource($user->shots);
        }
        return $this->respondNotFoundError();

    }

    /**
     * @param $username string
     * @urlParam  username required The username of the user. Example: candice
     * @return JobsResource|JsonResponse
     */
    public function getJobs($username)
    {
        $user = $this->userRepository->findByUsername($username);
        if ($user) {
            return new JobsResource($user->jobs);
        }
        return $this->respondNotFoundError();

    }
}
