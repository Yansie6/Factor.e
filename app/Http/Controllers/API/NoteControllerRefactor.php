<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Note;

class NoteControllerRefactor extends Controller
{
    /** ----------------------------------------------------
     * getAllNotes
     * - Gets all notes
     * - Or gets all notes from a project
     *
     * @param $projectId
     * @return string
     */
    public function getAllNotes($projectId = false) {

        return 'test';

        if ($projectId) {
            $notes = Note::where('project_id', $projectId)->get();
        } else {
            $notes = Note::all();
        }

        return response()->json([
            'message' => 'Succes',
            'data' => $notes,
        ], 200);
    }

    /** ----------------------------------------------------
     * createNote
     * - Creates a note that is connected to a project
     *
     * @param $request
     * @return string
     */
    public function createNote(Request $request) {

        $validator = Validator::make($request->all(), [
            'project_id' => 'required|int',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {
            $note = Note::create($request->all());
            if(!empty($note->id)) {
                return response()->json([
                    'message' => 'Successfully added note with id '.$note->id,
                    'data' => $note
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Failed uploading data in database.'
                ], 500);
            }
        }


        return response()->json([
            'message' => $message,
            'data' => $data
        ], $httpResponseCode);
    }

    /** ----------------------------------------------------
     * updateNote
     * - Updates note with the given id
     *
     * @param $request
     * @param $noteId
     * @return string
     */
    public function updateNote(Request $request, $noteId) {

        $validator = Validator::make($request->all(), [
            'project_id' => 'required|int',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {
            if (intval($noteId) === 0) {
                return response()->json([
                    'message' => 'Invalid argument.'
                ], 400);
            } else {
                $note = Note::find($noteId);

                if (!empty($note)) {
                    $note->project_id = $request->get('project_id');
                    $note->title = $request->get('title');
                    $note->content = $request->get('content');
                    $note->save();

                    return response()->json([
                        'message' => 'Successfully updated note with id ' . $note->id,
                        'data' => $note
                    ], 201);
                } else {
                    return response()->json([
                        'message' => 'Project with ID ' . $noteId . ' not found.'
                    ], 404);
                }
            }
        }
    }

    /** ----------------------------------------------------
     * deleteNote
     *
     * @param $noteId
     * @return string
     */
    public function deleteNote($noteId) {
        if (intval($noteId) === 0) {
            return response()->json([
                'message' => 'Invalid argument.'
            ], 400);
        } else {
            $note = Note::find($noteId);

            if (!empty($note)) {
                $note->delete();
                return response()->json([
                    'message' => 'Succesfully removed note with id ' . $note->id
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Note with ID ' . $noteId . ' not found.'
                ], 404);
            }
        }
    }
}
