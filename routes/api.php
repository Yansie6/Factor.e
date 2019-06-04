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


/*    Route::get(     'get-all-videos/{projectId?}',          'API\VideoController@getAllVideos');
    Route::post(    'create-video',                         'API\VideoController@createVideo');
    Route::post(   'update-video/{videoId}',               'API\VideoController@updateVideo');
    Route::delete(  'delete-video/{videoId}',               'API\VideoController@deleteVideo');

    Route::get(     'get-all-projects/{companyId?}',        'API\ProjectController@getAllProjects');
    Route::post(    'create-project',                       'API\ProjectController@createProject');
    Route::post(   'update-project/{projectId}',           'API\ProjectController@updateProject');
    Route::delete(  'delete-project/{projectId}',           'API\ProjectController@deleteProject');

    Route::get(     'get-all-notes/{projectId?}',           'API\NoteController@getAllNotes');
    Route::post(    'create-note',                          'API\NoteController@createNote');
    Route::post(   'update-note/{noteId}',                 'API\NoteController@updateNote');
    Route::delete(  'delete-note/{noteId}',                 'API\NoteController@deleteNote');

    Route::get(     'get-all-video-notes/{videoId?}',       'API\VideoNoteController@getAllVideoNotes');
    Route::post(    'create-video-note',                    'API\VideoNoteController@createVideoNote');
    Route::post(   'update-video-note/{videoNoteId}',      'API\VideoNoteController@updateVideoNote');
    Route::delete(  'delete-video-note/{videoNoteId}',      'API\VideoNoteController@deleteVideoNote');

    Route::get(     'get-all-companies',                    'API\companyController@getAllCompanies');
    Route::post(    'create-company',                       'API\companyController@createCompany');
    Route::post(   'update-company/{companyId}',           'API\companyController@updateCompany');
    Route::delete(  'delete-company/{companyId}',           'API\companyController@deleteCompany');

        Route::get(     'get-all-notes-t/{projectId?}',           'API\NoteControllerRefactor@getAllNotes');
        Route::post(    'create-note-t',                          'API\NoteControllerRefactor@createNote');
        Route::post(   'update-note-t/{noteId}',                 'API\NoteControllerRefactor@updateNote');
        Route::delete(  'delete-note-t/{noteId}',                 'API\NoteControllerRefactor@deleteNote');*/

Route::get(     'get-all-tags/{type}/{id}',        'API\TagController@getAllTags');
Route::post(    'create-tag/{type}/{id}',          'API\TagController@createTag');
//Route::post(    'update-project/{projectId}',           'API\TagController@updateProject'); NODIG???
//Route::delete(  'delete-project/{projectId}',           'API\TagController@deleteTag');

/*Route::group(['middleware' => 'auth:api'], function() {

});*/

    Route::get(     'get/{type}/{linkedId?}',                   'API@get');
    Route::post(    'create/{type}',                            'API@create');
    Route::post(    'update/{type}/{id}',                       'API@update');
    Route::delete(  'delete/{type}/{id}',                       'API@delete');