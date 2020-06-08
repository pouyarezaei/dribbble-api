<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function shots()
    {
        return $this->belongsToMany('App\Shot');
    }
}
