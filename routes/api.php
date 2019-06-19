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

//login
Route::group(['prefix' => 'auth'], function () {
    Route::post(    'login',                                'API\AuthController@login');
    Route::post(    'signup',                               'API\AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get( 'logout',                               'API\AuthController@logout');
        Route::get( 'user',                                 'API\AuthController@user');
    });
});


Route::group(['middleware' => 'auth:api'], function() {
    //This is the middleware, not needed now for testing purposes
});

Route::get(     'get/{type}/{linkedId?}',                   'API@get');
Route::post(    'create/{type}',                            'API@create');
Route::post(    'update/{type}/{id}',                       'API@update');
Route::delete(  'delete/{type}/{id}',                       'API@delete');

Route::get(     'get-version',                              'API@getVersion');

Route::get(     'get-all-tags/{type}/{typeId}',             'API\TagController@getAllTags');
Route::post(    'create-tag/{type}/{typeId}/',              'API\TagController@createTag');
Route::delete(  'delete-tag/{type}/{typeId}/{tagId}',       'API\TagController@deleteTag');



