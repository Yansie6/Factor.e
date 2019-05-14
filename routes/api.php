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

Route::post('/get-all-videos', 'API\VideoController@addVideo');
Route::post('/add-video', 'API\VideoController@addVideo');
Route::post('/delete-video', 'API\VideoController@deleteVideo');

Route::post('/get-all-video-notes', 'API\VideoNoteController@getAllVideoNotes');
Route::post('/create-video-note', 'API\VideoNoteController@createVideoNote');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
