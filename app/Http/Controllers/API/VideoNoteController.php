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
        $videonotes = Video_note::all();
        return $videonotes;
    }

    /** ----------------------------------------------------
     * CreateVideoNote
     * - Creates a note that is connected to a video
     *
     * @param Request $request
     * @return string
     */
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
            $videonote = Video_note::create($request->all());

            if(!empty($videonote->id)) {
                http_response_code(200);
                return http_response_code().": ID is missing.";
            } else {
                http_response_code(400);
                return http_response_code().': failed uploading data in database.';
            }
        }
    }

    /** ----------------------------------------------------
     * UpdateVideoNote
     *
     * @param Request $request
     * @param $videonote_id
     * @return string
     */
    public function updateVideoNote(Request $request, $videonote_id) {

        $validator = Validator::make($request->all(), [
            'content' => 'required|string',             //longtext
        ]);

        if ($validator->fails()) {
            http_response_code(400);
            return http_response_code().': Did not pass validator.';
        } else {
            $videonote = Video_note::find($videonote_id);

            $videonote->content = $request->get('content');

            $videonote->save();

            http_response_code(200);
            return http_response_code().': updated row with id '.$videonote->id;
        }
    }

    public function deleteVideoNote() {
        //TODO: finish deleteNote() function
    }
}
