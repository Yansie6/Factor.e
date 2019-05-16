<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App;
use App\Video_note;
use PHPUnit\Util\Json;

class VideoNoteController extends Controller
{
    /** ----------------------------------------------------
     * GetAllVideosNotes
     * - Gets all videos from the videos table
     *
     * @param $videoId
     * @return String
     */
    public function getAllVideosNotes($videoId = false) {

        if(!empty($videoId)){
            $videoNotes = Video::where('video_id', $videoId)->get();
        } else {
            $videoNotes = Video::all();
        }

        return response()->json([
            'message' => 'Success',
            'data' => $videoNotes
        ], 200);
    }

    /** ----------------------------------------------------
     * createVideoNote
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
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {
            $videonote = Video_note::create($request->all());
            if(!empty($videonote->id)) {
                return response()->json([
                    'message' => 'Successfully added video_note with id '.$videonote->id,
                    'data' => $videonote
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Failed uploading data in database.'
                ], 500);
            }
        }
    }

    /** ----------------------------------------------------
     * updateVideoNote
     * - Updates videonote with the given id
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
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {
            $videonote = Video_note::find($videonote_id);

            $videonote->content = $request->get('content');

            $videonote->save();

            return response()->json([
                'message' => 'Successfully updated video_note with id '.$videonote->id,
                'data' => $videonote
            ], 201);
        }
    }

    /** ----------------------------------------------------
     * deleteVideoNote
     *
     * @param $videonote_id
     * @return string
     */
    public function deleteVideoNote($videonote_id) {
        if (intval($videonote_id) === 0) {
            return response()->json([
                'message' => 'Invalid argument.'
            ], 400);
        } else {
            $videonote = Video_note::find($videonote_id);

            if (!empty($videonote)) {
                $videonote->delete();
                return response()->json([
                    'message' => 'Succesfully removed video_note with id ' . $videonote->id
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Video_note with ID ' . $videonote_id . ' not found.'
                ], 404);
            }
        }
    }
}
