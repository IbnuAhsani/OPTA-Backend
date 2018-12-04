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

$router->get('/', function() {
    return view('maskapai/home', ['title' => $_ENV['APP_NAME']]);
})->name('root')->middleware('login');

$router->post('/login', 'AuthController@login_admin_maskapai')->name('login')->middleware('login');

$router->group(['prefix' => 'maskapai'], function($router) {
    $router->get('/', 'MaskapaiController@home')->name('maskapai_home');
    $router->get('/logout', 'MaskapaiController@logout')->name('logout');
    $router->get('/register', 'MaskapaiController@view_register')->name('view_register');    
    $router->post('/do_register', 'MaskapaiController@register')->name('register');

    // need maskapai privilage
    $router->group(['middleware' => 'maskapai'], function($router) {
        $router->get('/dashboard', 'MaskapaiController@dashboard')->name('dashboard');
        $router->post('/add_bus', 'MaskapaiController@add_bus');
        $router->get('/delete', 'MaskapaiController@delete_bus');
        $router->get('/edit', 'MaskapaiController@edit_bus')->name('edit_bus');
        $router->get('/download_qr', 'MaskapaiController@download_qr')->name('download.qr');
        $router->post('/save_edit', 'MaskapaiController@save_edit');
        $router->get('/routes', 'MaskapaiController@view_routes');
        $router->get('/withdraw', 'MaskapaiController@view_withdraw')->name('withdraw');
        $router->post('/withdraw', 'MaskapaiController@req_withdraw');
    });
});

$router->group(['prefix' => 'admin'], function($router){
    $router->get('/logout', 'AdminController@logout');
    $router->get('/error', 'AdminController@error')->name('error');

    // need admin privilage
    $router->group(['middleware' => 'admin'], function($router){
        $router->get('/top_up', 'AdminController@topUp')->name('admin_top_up');
        $router->get('/withdraw', 'AdminController@withdraw')->name('admin_withdraw');
        $router->get('/withdraw/accept', 'AdminController@acceptWithdraw');
        $router->get('/withdraw/decline', 'AdminController@declineWithdraw');
        $router->get('/manifesto', 'AdminController@manifesto');
        $router->get('/top_up/accept', 'AdminController@acceptTopUp');
        $router->get('/top_up/decline', 'AdminController@declineTopUp');
    });
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
    $router->get('bus/{bus_id}/price', 'BusController@busPrice');
});