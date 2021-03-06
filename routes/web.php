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

//$router->get('/makeCart', function () use ($router) {
//    return $router->app->version();
//});
$router->post('/login', 'AuthController@login');
$router->post('/makeCart', 'APIController@makeCart');

$router->group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () use ($router) {
    $router->post('createProduct', 'APIController@createProduct');

    $router->post('createOffer', 'APIController@createOffer');
});
