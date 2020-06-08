<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Gif extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gifs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [ 'gif'
    ];
    protected $hidden = [];
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [];
    public function shot()
    {
        return $this->belongsTo('App\Shot');
    }
}
