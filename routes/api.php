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

Route::post('/get-all-videos', 'API\VideoController@getAllVideos');
Route::post('/add-video', 'API\VideoController@addVideo');
Route::patch('/update-video/{id}', 'API\VideoController@updateVideo');
Route::delete('/delete-video/{id}', 'API\VideoController@deleteVideo');

Route::post('/get-all-video-notes', 'API\VideoNoteController@getAllVideoNotes');
Route::post('/create-video-note', 'API\VideoNoteController@createVideoNote');
Route::patch('/update-video-note/{id}', 'API\VideoNoteController@updateVideoNote');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
