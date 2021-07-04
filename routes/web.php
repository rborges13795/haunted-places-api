<?php

use Laravel\Lumen\Routing\Router;

/** @var \Laravel\Lumen\Routing\Router $router */

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

/** @var Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/api/haunts'], function () use ($router) {
    $router->get('', 'HauntController@getKeyword');
    $router->get('/all', 'HauntController@getHaunts');
    $router->get('/{id}', 'HauntController@show');
});

// $router->post('/api/login', 'TokenController@generateToken');
// $router->post('/api/user', 'UserController@create');

// $router->group(['prefix' => '/api/user', 'middleware' => 'auth'], function () use ($router) {
//     $router->get('/', 'UserController@getUsers');
//     $router->get('/{id}', 'UserController@show');
//     $router->delete('/{id}', 'UserController@remove');
//     $router->put('/{id}', 'UserController@update');
//     $router->get('/{id}/haunts', 'UserHauntController@getUserHaunts');
//     $router->post('/{id}/haunts', 'UserHauntController@store');
//     $router->delete('/{id}/haunts', 'UserHauntController@remove');
// });

