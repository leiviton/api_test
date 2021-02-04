<?php
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


Route::group(['prefix' => 'v1/', 'middleware' => 'auth:api'], function () {
    /*Routes Admin*/
    Route::group(['prefix' => 'admin', 'namespace' => 'Api\V1\Admin'], function () {
        /*util*/
        Route::get('cnpj/{cnpj}', 'UtilController@getCnpj');
        Route::get('cep/{cep}', 'UtilController@getCep');
        Route::get('calls', 'UtilController@initCall');
        Route::get('feriados', 'UtilController@diasFeriados');
        Route::delete('file/delete/{image}/{folder}', 'UtilController@deleteFile');
        Route::post('sms/send', 'CalledController@send');

        /*Users*/
        Route::post('user', 'UserController@store');
        Route::post('user/upload', 'UserController@upload');
        Route::get('authenticated', 'UserController@authenticated');
        Route::get('user', 'UserController@index');
        Route::get('user/attendant', 'UserController@getAttendant');
        Route::get('user/{id}', 'UserController@edit');
        Route::get('permissions', 'PermissionController@index');
        Route::post('user/permission', 'UserController@permission');
        Route::put('user/{id}', 'UserController@update');
        Route::delete('user/{id}', 'UserController@delete');
        Route::patch('user/{id}', 'UserController@updateStatus');
        Route::patch('user/password/{id}', 'UserController@updatePassword');

        /*categories*/
        Route::post('categories', 'CategoriesController@store');
        Route::get('categories', 'CategoriesController@index');
        Route::delete('categories/{id}', 'CategoriesController@delete');

        /*products*/
        Route::get('products', 'ProductsController@index');
        Route::post('products', 'ProductsController@store');
        Route::delete('products/{id}', 'ProductsController@delete');
    });
});
