<?php


/** @var Router $router */
/** @var Router $router */


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});
// TODO remove throttle for testing dont forget put that  ['prefix' => 'api/v1/', 'middleware' => 'throttle:15,1']
$router->group(['prefix' => 'api/v1/'], function () use ($router) {

    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post("/register", ['as' => 'api.v1.auth.register', 'uses' => 'AuthController@register']);
        $router->post("/login", ['as' => 'api.v1.auth.login', 'uses' => 'AuthController@login']);
        $router->put("/update", ['as' => 'api.v1.auth.update', 'uses' => 'AuthController@update']);
    });


    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->get("{username}/shots", ['as' => 'api.v1.user.shots', 'uses' => 'UserController@getShots']);
        $router->get("{username}/jobs", ['as' => 'api.v1.user.jobs', 'uses' => 'UserController@getJobs']);
        $router->get("{username}/profile", ['as' => 'api.v1.user.profile', 'uses' => 'UserController@getProfile']);
    });


    $router->group(['prefix' => 'shots'], function () use ($router) {
        $router->get("/", ['as' => 'api.v1.shots.all', 'uses' => 'ShotController@getAll']);
        $router->get("/{id}", ['as' => 'api.v1.shots.get', 'uses' => 'ShotController@getById']);
        $router->delete("/{id}", ['as' => 'api.v1.shots.get', 'uses' => 'ShotController@deleteById']);
        $router->put("/{id}", ['as' => 'api.v1.shots.update', 'uses' => 'ShotController@updateById']);
        $router->put("/{id}/tags", ['as' => 'api.v1.shots.update.tags', 'uses' => 'ShotController@updateShotTagsById']);
        $router->get("/{id}/comment", ['as' => 'api.v1.shots.comment', 'uses' => 'ShotController@getCommentByShotId']);
        $router->post("/{id}/media", ['as' => 'api.v1.shots.media', 'uses' => 'ShotController@addMedia']);
    });


    $router->group(['prefix' => 'jobs'], function () use ($router) {
        $router->get("/", ['as' => 'api.v1.getAllJob', 'uses' => 'JobController@getAll']);
        $router->post("/", ['as' => 'api.v1.storeJob', 'uses' => 'JobController@store']);
        $router->get("/{id}", ['as' => 'api.v1.job.getJobById', 'uses' => 'JobController@getById']);
        $router->put("/{id}", ['as' => 'api.v1.updateJobById', 'uses' => 'JobController@updateById']);
    });


});
