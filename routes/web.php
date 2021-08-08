<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

Route::group(['prefix' => 'auth'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
});

$router->group(['prefix' => 'categories'], function () use ($router) {
    $router->get('/', 'CategoryController@index');
    $router->post('add', 'CategoryController@store');
    $router->get('/{id}', 'CategoryController@show');
    $router->post('/{id}', 'CategoryController@update');
    $router->get('/{id}/delete', 'CategoryController@destroy');
});


$router->group(['prefix' => 'blogs'], function () use ($router) {
    $router->get('/', 'CategoryController@index');
    $router->post('add', 'CategoryController@store');
    $router->get('/{id}', 'CategoryController@show');
    $router->post('/{id}', 'CategoryController@update');
    $router->get('/{id}/delete', 'CategoryController@destroy');
});