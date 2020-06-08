<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
            'image'
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
