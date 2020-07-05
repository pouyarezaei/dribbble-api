<?php


namespace App\Repositories\UserRepository;


use App\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findByUsername($username)
    {
        return User::findByUsername($username);
    }

    public function findById($id)
    {
        return User::find($id);
    }

    public function delete($id)
    {
        User::destroy($id);
    }

    public function store(array $data)
    {
        User::create($data);
    }


}