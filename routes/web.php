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

//测试
Route::get('test','CustomersController@test');

//模糊搜索返回单位的名称与id
Route::get('searchcus/{cus_name}','CustomersController@showList');
//模糊搜索返回联系人的名称与id
//Route::get('searchcus2/{name}', 'Customer2sController@showList');
Route::get('contracts/{contract_id}/customer2s/{name2}', 'Customer2sController@showList');
//模糊搜索返回员工的名称与id
Route::get('searchuser/{name}', 'UsersController@showList');

//导出客户任务单
Route::post('services/createTask', 'ServicesController@createTask');
Route::get('services/printTask', 'ServicesController@printTask');

//直接查看该客户下所有的服务单，还没有写
Route::get('customers/{cus_id}/services','CustomersController@showServices');

Route::resource('users', 'UsersController');
Route::resource('customers', 'CustomersController');
Route::resource('customer2s', 'Customer2sController');
Route::resource('contracts', 'ContractsController');
Route::resource('services', 'ServicesController');
Route::resource('duties', 'DutiesController');


