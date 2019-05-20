<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App;
use App\Note;

class NoteController extends Controller
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

        if ($projectId) {
            $notes = App\Note::where('project_id', $projectId)->get();
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
     * @param Request $request
     * @return string
     */
    public function createNote(Request $request) {

        $validator = Validator::make($request->all(), [
            'project_id' => 'required|int',             //int
            'title' => 'required|string|max:255',       //varchar
            'content' => 'required|string',             //longtext
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
    }

    /** ----------------------------------------------------
     * updateNote
     * - Updates note with the given id
     *
     * @param Request $request
     * @param $note_id
     * @return string
     */
    public function updateNote(Request $request, $note_id) {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',       //varchar
            'content' => 'required|string',             //longtext
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {
            $note = Note::find($note_id);

            $note->title = $request->get('title');
            $note->content = $request->get('content');

            $note->save();

            return response()->json([
                'message' => 'Successfully updated note with id '.$note->id,
                'data' => $note
            ], 201);
        }
    }

    /** ----------------------------------------------------
     * deleteNote
     *
     * @param $note_id
     * @return string
     */
    public function deleteNote($note_id) {
        if (intval($note_id) === 0) {
            return response()->json([
                'message' => 'Invalid argument.'
            ], 400);
        } else {
            $note = Note::find($note_id);

            if (!empty($note)) {
                $note->delete();
                return response()->json([
                    'message' => 'Succesfully removed note with id ' . $note->id
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Note with ID ' . $note_id . ' not found.'
                ], 404);
            }
        }
    }
}
