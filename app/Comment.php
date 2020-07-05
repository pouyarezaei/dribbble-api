<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'comments';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id', 'body', 'shot_id'
    ];
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

    public function shot()
    {
        return $this->belongsTo('App\Shot');
    }
}
