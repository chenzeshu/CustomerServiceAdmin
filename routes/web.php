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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Auth::routes();


//搜索返回类似客户的名称与id
Route::get('searchcus/{cus_name}','CustomersController@showList');
//直接查看该客户下所有的服务单，还没有写
Route::get('customers/{cus_id}/services','CustomersController@showServices');

Route::resource('users', 'UsersController');
Route::resource('customers', 'CustomersController');
Route::resource('customer2s', 'Customer2sController');
Route::resource('contracts', 'ContractsController');
Route::resource('services', 'ServicesController');
Route::resource('duties', 'DutiesController');


