<?php

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

/*$router->get('/key', function() {
    return str_random(32);
});*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('auth/login', ['uses' => 'AuthController@authenticate']);

$router->group(['prefix' => 'api/v1', 'middleware' => 'jwt.auth'], function () use ($router) {

    /*    $router->get('/users', function() {
        $users = \App\User::all();
        return response()->json($users);
    });*/

    $router->get('/users', 'UserController@index');
    $router->get('/user/{userId}', 'UserController@edit');
    $router->post('/user', 'UserController@store');
    $router->put('/user/{userId}', 'UserController@update');
    $router->delete('/user/{userId}', 'UserController@delete');

    $router->get('/projects', 'ProjectsController@index');
    $router->get('/project/{projectId}', 'ProjectsController@edit');
    $router->post('/project', 'ProjectsController@store');
    $router->put('/project/{projectId}', 'ProjectsController@update');
    $router->delete('/project/{projectId}', 'ProjectsController@delete');
});
