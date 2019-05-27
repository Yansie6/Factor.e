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


    Route::get(     'get-all-videos/{projectId?}',          'API\VideoController@getAllVideos');
    Route::post(    'create-video',                         'API\VideoController@createVideo');
    Route::patch(   'update-video/{videoId}',               'API\VideoController@updateVideo');
    Route::delete(  'delete-video/{videoId}',               'API\VideoController@deleteVideo');

    Route::get(     'get-all-projects/{companyId?}',        'API\ProjectController@getAllProjects');
    Route::post(    'create-project',                       'API\ProjectController@createProject');
    Route::patch(   'update-project/{projectId}',           'API\ProjectController@updateProject');
    Route::delete(  'delete-project/{projectId}',           'API\ProjectController@deleteProject');

    Route::get(     'get-all-notes/{projectId?}',           'API\NoteController@getAllNotes');
    Route::post(    'create-note',                          'API\NoteController@createNote');
    Route::patch(   'update-note/{noteId}',                 'API\NoteController@updateNote');
    Route::delete(  'delete-note/{noteId}',                 'API\NoteController@deleteNote');

    Route::get(     'get-all-video-notes/{videoId?}',       'API\VideoNoteController@getAllVideoNotes');
    Route::post(    'create-video-note',                    'API\VideoNoteController@createVideoNote');
    Route::patch(   'update-video-note/{videoNoteId}',      'API\VideoNoteController@updateVideoNote');
    Route::delete(  'delete-video-note/{videoNoteId}',      'API\VideoNoteController@deleteVideoNote');

    Route::get(     'get-all-companies',                    'API\companyController@getAllCompanies');
    Route::post(    'create-company',                       'API\companyController@createCompany');
    Route::patch(   'update-company/{companyId}',           'API\companyController@updateCompany');
    Route::delete(  'delete-company/{companyId}',           'API\companyController@deleteCompany');

        Route::get(     'get-all-notes-t/{projectId?}',           'API\NoteControllerRefactor@getAllNotes');
        Route::post(    'create-note-t',                          'API\NoteControllerRefactor@createNote');
        Route::patch(   'update-note-t/{noteId}',                 'API\NoteControllerRefactor@updateNote');
        Route::delete(  'delete-note-t/{noteId}',                 'API\NoteControllerRefactor@deleteNote');

Route::group(['middleware' => 'auth:api'], function() {

});

    Route::get(     'get/{type}/{linkedId?}',                   'API@get');
    Route::post(    'create/{type}',                            'API@create');
    Route::patch(   'update/{type}/{id}',                       'API@update');
    Route::delete(  'delete/{type}/{id}',                       'API@delete');


//DIT KAN WEG :=)
//
//Route::get(     'get/{project}/{companyId?}',        'API@getAll');
//Route::post(    'create-project',                       'API@create');
//Route::patch(   'update-project/{projectId}',           'API@update');
//Route::delete(  'delete-project/{projectId}',           'API@delete');
//
//Route::get(     'get-all-notes/{projectId?}',           'API@getAll');
//Route::post(    'create-note',                          'API@create');
//Route::patch(   'update-note/{noteId}',                 'API@update');
//Route::delete(  'delete-note/{noteId}',                 'API@delete');
//
//Route::get(     'get-all-video-notes/{videoId?}',       'API@getAll');
//Route::post(    'create-video-note',                    'API@create');
//Route::patch(   'update-video-note/{videoNoteId}',      'API@update');
//Route::delete(  'delete-video-note/{videoNoteId}',      'API@delete');
//
//Route::get(     'get-all-companies',                    'API@getAll');
//Route::post(    'create-company',                       'API@create');
//Route::patch(   'update-company/{companyId}',           'API@update');
//Route::delete(  'delete-company/{companyId}',           'API@delete');
