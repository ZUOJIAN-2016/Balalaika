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

/*
$app->get('/', function () use ($app) {
    return $app->version();
});
*/

$app->post('/login', ['uses' => 'UserController@login']);
$app->get('/logout', ['uses' => 'UserController@logout']);
$app->post('/users', ['uses' => 'UserController@create']);
$app->get('/current/user', ['uses' => 'UserController@profile', 'middleware' => 'auth']);
$app->get('/users/{login_name}', ['uses' => 'UserController@view', 'middleware' => 'auth']);
