<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public const BASE_URL = "www.dd.ir/profile/";
    protected $fillable = [
        'password', 'name', 'username', 'email', 'profile_url', 'avatar_url', 'bio', 'web', 'gender'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'id', 'remember_token'
    ];
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [];

    public function getUsernameAttribute()
    {
        return $this->attributes['username'];

    }

    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtolower($value);
        $this->generateProfileUrl();

    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public function generateProfileUrl()
    {
        $this->attributes['profile_url'] = self::BASE_URL . $this->getUsernameAttribute();

    }

    public static function rules($merge = [])
    {
        return array_merge(
            [
                'username' => 'required|min:6|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'name' => 'required',
                'avatar_url' => 'required',
                'gender' => 'required|in:male,female',
                'password' => 'required',
            ],
            $merge
        );
    }

    public function check($password)
    {
        return Hash::check($password, $this->attributes['password']);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }


    public function shots()
    {
        return $this->hasMany(Shot::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
