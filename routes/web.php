<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

$router->group(['prefix' => 'api'], function($router){

    // Routes for Auth
    $router->post('login/', 'AuthController@login');

    // Routes for User
    $router->get('user/{id}', 'UserController@viewOneUser');
    $router->get('route/', 'BusController@viewRoutes');
    $router->post('user/register', 'UserController@register');
    $router->post('user/pay', 'UserController@pay');
    $router->post('user/topup/', 'UserController@topup');
    $router->post('user/pay/history', 'UserController@paymentHistory');

    // Routes for Bus
    $router->get('bus/{id}', 'BusController@viewOneBus');

    // Routes for Bus Admin
    $router->post('bus-admin/register', 'BusAdminController@register');
});