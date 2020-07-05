<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Shot extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shots';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function gifs()
    {
        return $this->hasMany('App\Gif');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'title' => 'required',
                'description' => 'required',

            ],
            $merge
        );
    }

}
