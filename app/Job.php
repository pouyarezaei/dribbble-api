<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jobs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'organization_name', 'title', 'location', 'description', 'category', 'role_type', 'website', 'active'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];
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

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'title' => 'required',
                'location' => 'required',
                'description' => 'required',
                'category' => 'required',
                'role_type' => 'required|in:freelance,full_time,part_time',
                'active' => 'required',
            ],
            $merge
        );
    }
}
