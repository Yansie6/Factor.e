<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App;
use App\Video_note;

class VideoNoteController extends Controller
{
    /** ----------------------------------------------------
     * GetAllVideoNotes
     * - Gets all videonotes from the videonotes table
     *
     * @param $videoId
     * @return String
     */
    public function getAllVideoNotes($videoId = false) {

        if(!empty($videoId)){
            $videoNotes = Video_note::where('video_id', $videoId)->get();
        } else {
            $videoNotes = Video_note::all();
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
     * @param $request
     * @return string
     */
    public function createVideoNote(Request $request) {

        $validator = Validator::make($request->all(), [
            'video_id' => 'required|int',
            'content' => 'required|string',
            'timestamp' => 'required|string|max:255',
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
     * @param $request
     * @param $videoNoteId
     * @return string
     */
    public function updateVideoNote(Request $request, $videoNoteId) {

        $validator = Validator::make($request->all(), [
            'video_id' => 'required|int',
            'content' => 'required|string',
            'timestamp' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {
            if (intval($videoNoteId) === 0) {
                return response()->json([
                    'message' => 'Invalid argument.'
                ], 400);
            } else {

                $videonote = Video_note::find($videoNoteId);

                if(!empty($videonote)){
                    $videonote->video_id = $request->get('video_id');
                    $videonote->content = $request->get('content');
                    $videonote->timestamp = $request->get('timestamp');
                    $videonote->save();

                    return response()->json([
                        'message' => 'Successfully updated video_note with id ' . $videonote->id,
                        'data' => $videonote
                    ], 201);
                } else {
                    return response()->json([
                        'message' => 'Project with ID ' . $videoNoteId . ' not found.'
                    ], 404);
                }
            }
        }
    }

    /** ----------------------------------------------------
     * deleteVideoNote
     *
     * @param $videoNoteId
     * @return string
     */
    public function deleteVideoNote($videoNoteId) {
        if (intval($videoNoteId) === 0) {
            return response()->json([
                'message' => 'Invalid argument.'
            ], 400);
        } else {
            $videonote = Video_note::find($videoNoteId);

            if (!empty($videonote)) {
                $videonote->delete();
                return response()->json([
                    'message' => 'Succesfully removed video_note with id ' . $videonote->id
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Video_note with ID ' . $videoNoteId . ' not found.'
                ], 404);
            }
        }
    }
}
