<?php


namespace App\Repositories\ShotRepository;


use App\Shot;

class EloquentShotRepository implements ShotRepositoryInterface
{

    public function all()
    {
        return Shot::all();
    }

    public function allWithPages($size = 10)
    {
        return Shot::with(['user', 'images'])->orderBy('create_at')->paginate($size);
    }

    public function find($id)
    {
        return $shot = Shot::with(['user', 'comments', 'images', 'videos', 'gifs', 'tags'])->find($id);

    }

    public function store(array $data)
    {
        Shot::create($data);
    }

    public function delete($id)
    {
        Shot::destroy($id);
    }

}