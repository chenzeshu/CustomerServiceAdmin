<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware'=>'cors','namespace'=>'API'], function (){
    //客户列表模糊搜索
    Route::get('customers/search/{name}','customersController@search');
    //合同列表模糊搜索
    Route::get('contracts/search/{name}','contractsController@search');
    //addman搜索员工
    Route::get('addman/users/{name}','UsersController@search');
    //addman搜索客户联系人
    Route::get('addman/cus2s/{name}','customer2sController@search');
    //addman搜索客户单位
    Route::get('addman/cus/{name}','customersController@search');

    Route::resource('customers', 'customersController');
    Route::resource('customer2s', 'customer2sController');
    Route::resource('contracts', 'contractsController');
});
