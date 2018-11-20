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

$router->group(['prefix' => 'maskapai'], function($router) {
    // the root is login
    $router->get('/', 'MaskapaiController@home')->name('home');
    $router->post('/login', 'MaskapaiController@login')->name('login');
    $router->get('/logout', 'MaskapaiController@logout')->name('logout');
    $router->get('/dashboard', 'MaskapaiController@dashboard')->name('dashboard')->middleware('maskapai');
    $router->post('/add_bus', 'MaskapaiController@add_bus')->middleware('maskapai');
    $router->get('/delete', 'MaskapaiController@delete_bus')->middleware('maskapai');
    $router->get('/edit', 'MaskapaiController@edit_bus')->name('edit_bus')->middleware('maskapai');
    $router->get('/download_qr', 'MaskapaiController@download_qr')->name('download.qr')->middleware('maskapai');
    $router->post('/save_edit', 'MaskapaiController@save_edit')->middleware('maskapai');
    $router->get('/routes', 'MaskapaiController@view_routes')->middleware('maskapai');
    $router->get('/withdraw', 'MaskapaiController@view_withdraw')->middleware('maskapai');
});

$router->group(['prefix' => 'api'], function($router){

    // Routes for Auth
    $router->post('login/', 'AuthController@login');

    // Routes for User
    $router->get('user/{id}', 'UserController@viewOneUser');
    $router->post('user/register', 'UserController@register');
    $router->post('user/pay', 'UserController@pay');
    $router->post('user/topup/', 'UserController@requestTopup');
    $router->post('user/balance', 'UserController@viewBalance');
    $router->post('user/pay/history', 'UserController@viewPaymentHistory');
    
    // Routes for Bus
    $router->get('route/', 'BusController@viewRoutes');

    // Routes for Bus Admin
    $router->post('bus-admin/register', 'BusAdminController@register');
    $router->post('bus-admin/bus', 'BusAdminController@viewOneBus');
    $router->post('bus-admin/bus/all', 'BusAdminController@viewAllBusses');
    $router->post('bus-admin/bus/add', 'BusAdminController@addBus');
    $router->post('bus-admin/bus/delete', 'BusAdminController@deleteBus');
    $router->post('bus-admin/bus/update', 'BusAdminController@updateBus');
});