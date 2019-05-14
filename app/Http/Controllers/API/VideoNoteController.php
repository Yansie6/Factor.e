<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App;
use App\Video_note;

class VideoNoteController extends Controller
{
    public function getAllVideoNotes() {
        $videoNotes = Video_note::all();
        return $videoNotes;
    }

    public function createVideoNote(Request $request) {

        $validator = Validator::make($request->all(), [
            'video_id' => 'required|int',               //int
            'content' => 'required|string',             //longtext
            'timestamp' => 'required|string|max:255',   //varchar
        ]);

        if ($validator->fails()) {
            http_response_code(400);
            return http_response_code().': Did not pass validator, missing video_id, content or timestamp.';
        } else {
            $videoNote = Video_note::create($request->all());

            if(!empty($videoNote->id)) {
                http_response_code(200);
                return http_response_code();
            } else {
                http_response_code(400);
                return http_response_code().': failed uploading data in database.';
            }
        }
    }

    public function updateVideoNote() {
        //TODO: finish updateNote() function
    }

    public function deleteVideoNote() {
        //TODO: finish deleteNote() function
    }
}
