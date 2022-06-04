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
    return 'Hello guest :)';
});

// login
$router->post('/login', "Users@login");

// category
$router->post('/category/add', "Categorys@add");
$router->post('/category/edit', "Categorys@edit");
$router->post('/category/delete', "Categorys@delete");
$router->get('/category', "Categorys@getAllCategory");
$router->post('/category/detail', "Categorys@getDetailCategory");