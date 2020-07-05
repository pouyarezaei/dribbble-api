<?php


namespace App\Repositories\ShotRepository;


interface ShotRepositoryInterface
{
    public function all();

    public function allWithPages($size = 10);

    public function find($id);

    public function delete($id);

    public function store(array $data);
}