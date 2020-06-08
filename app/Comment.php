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
        'user_id', 'body'
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
        $this->belongsTo('App\User');
    }

    public function shot()
    {
        $this->belongsTo('App\Shot');
    }
}
