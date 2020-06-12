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

$router->group(['prefix' => 'api/v1/' ,'middleware' => 'throttle:10,1'], function () use ($router) {

    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->get("/profile/{username}", ['as' => 'api.v1.user.profile', 'uses' => 'UserController@profile']);
        $router->post("register", ['as' => 'api.v1.user.register', 'uses' => 'UserController@register']);
        $router->post("/", ['as' => 'api.v1.user.login', 'uses' => 'UserController@login']);
        $router->put("/update", ['as' => 'api.v1.user.update', 'uses' => 'UserController@update']);
    });

    $router->group(['prefix' => 'jobs'], function () use ($router) {
        $router->get("/{id}", ['as' => 'api.v1.job.getJobById', 'uses' => 'JobController@getJobById']);
        $router->put("/{id}", ['as' => 'api.v1.updateJobById', 'uses' => 'JobController@updateJobById']);
        $router->get("/", ['as' => 'api.v1.getAllJob' ,'uses' => 'JobController@getAllJob']);
    });
    $router->group(['prefix' => 'shots'], function () use ($router) {
        $router->get("/", ['as' => 'api.v1.shots.all', 'uses' => 'ShotController@getAllShots']);
        $router->get("/{id}", ['as' => 'api.v1.shots.get', 'uses' => 'ShotController@getShotById']);
        $router->put("/{id}", ['as' => 'api.v1.shots.update', 'uses' => 'ShotController@updateShotById']);
        $router->put("/{id}/tags", ['as' => 'api.v1.shots.update.tags', 'uses' => 'ShotController@updateShotTagsById']);
        $router->get("/{id}/comment", ['as' => 'api.v1.shots.comment', 'uses' => 'ShotController@getCommentByShotId']);
        $router->post("/{id}/media", ['as' => 'api.v1.shots.media', 'uses' => 'ShotController@addMedia']);
    });
});
