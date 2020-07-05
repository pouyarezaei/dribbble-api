<?php

/** @var Factory $factory */

use App\Comment;
use App\Gif;
use App\Image;
use App\Job;
use App\Shot;
use App\Tag;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $username = $faker->firstName;
    return [
        'name' => $faker->firstName,
        'username' => $username,
        'web' => $faker->domainName,
        'avatar_url' => $faker->imageUrl(),
        'bio' => $faker->paragraph,
        'password' => "password",
        'email' => $faker->email,
        'api_token' => $faker->sha1,
        'city' => $faker->city,
        'gender' => $faker->randomElement(['male', 'female']),
        'role' => $faker->randomElement(['designer', 'employee'])
    ];
});

$factory->define(Job::class, function (Faker $faker) {

    return [
        'organization_name' => $faker->firstName,
        'title' => $faker->paragraph,
        'location' => $faker->city,
        'description' => $faker->paragraph,
        'category' => $faker->jobTitle,
        'role_type' => $faker->randomElement(['freelance', 'full_time', 'part_time']),
        'website' => $faker->url,
        'active' => $faker->boolean,
    ];
});

$factory->define(Shot::class, function (Faker $faker) {

    return [
        'title' => $faker->paragraph,
        'description' => $faker->paragraph

    ];
});
$factory->define(Image::class, function (Faker $faker) {

    return [
        'image' => "https://i.picsum.photos/id/405/3000/1688.jpg?hmac=wihswILm48QrPF9GurD8QtSqMDtOY28jEWZPvlwderk",
        'poster' => $faker->boolean
    ];
});
$factory->define(Gif::class, function (Faker $faker) {

    return [
        'gif' => "/shots/gif/1591298962mo.png"
    ];
});
$factory->define(Comment::class, function (Faker $faker) {
    $user = User::all()->random();
    return [
        'user_id' => $user['id'],
        'body' => $faker->paragraph
    ];
});
