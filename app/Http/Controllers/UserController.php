<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
/**
 * @group users
 *
 * Api for users
 */
class UserController extends ApiController
{
    public function login(Request $request)
    {
        $user = User::where('username', $request['username'])->first();
        if ($user) {
            if ($user->check($request['password'])) {
                return $this->respond(['Login Success']);
            } else {
                return $this->respond(['Wrong Password']);
            }
        } else {
            return $this->respond(['Username Not Exist']);
        }
    }

    public function update(Request $request)
    {
        if ($request['remember_token']) {
            $user = User::where('remember_token', $request['remember_token'])->first();
            $user->update($request->all());
            return $user;
        } elseif ($request['reset']) {

        }

    }

    public function profile($username)
    {
        if (is_null(User::where('username', $username)->first())) {
            return $this->respondNotFound();
        }
        return $this->respond(User::where('username', $username)->first());
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, User::rules());
            User::create($request->all());
            return $this->respond(["register success"]);
        } catch (ValidationException $e) {
            return $this->respondNotValid($data = $e->errors());
        }
    }


}
