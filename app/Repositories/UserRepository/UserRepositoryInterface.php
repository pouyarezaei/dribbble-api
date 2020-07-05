<?php


namespace App\Repositories\UserRepository;


interface UserRepositoryInterface
{
    public function findById($id);

    public function findByUsername($username);

    public function delete($id);

    public function store(array $data);
}