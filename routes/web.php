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

$app->group(['middleware' => 'auth'], function () use ($app) {
	$app->get('/current/user', ['uses' => 'UserController@profile']);
	$app->get('/users/{login_name}', ['uses' => 'UserController@view']);


	$app->post('/organizations', ['uses' => 'OrganizationController@create']);
	$app->get('/organizations', ['uses' => 'OrganizationController@showList']);
	$app->get('/organizations/{id}', ['uses' => 'OrganizationController@view']);
	$app->get('/organizations/{id}/members', ['uses' => 'OrganizationController@members']);
	$app->get('/organizations/{id}/structure', ['uses' => 'OrganizationController@structure']);
});

