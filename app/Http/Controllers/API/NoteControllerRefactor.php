<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Note;

class NoteControllerRefactor extends Controller
{

    private $noteFields = ['project_id' => 'required|int', 'title' => 'required|string|max:255', 'content' => 'required|string'];


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

        $isValid = $this->checkIfValid($request->all(), $this->noteFields);

        if ($isValid) {
            $note = Note::create($request->all());
            if(!empty($note->id)) {
                $message = 'Successfully added note with id '.$note->id;
                $data = $note;
                $httpResponseCode = 201;
            } else {
                $message = 'Failed uploading data in database.';
                $data = '';
                $httpResponseCode = 500;
            }
        } else {
            $message = 'Did not pass validator.';
            $data = '';
            $httpResponseCode = 400;
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

        $isValid = $this->checkIfValid($request->all(), $this->noteFields);

        if ($isValid) {
            if (intval($noteId) === 0) {
                $message = 'Invalid argument.';
                $data = '';
                $httpResponseCode = 400;
            } else {
                $note = Note::find($noteId);

                if (!empty($note)) {
                    $note->project_id = $request->get('project_id');
                    $note->title = $request->get('title');
                    $note->content = $request->get('content');
                    $note->save();

                    $message = 'Successfully updated note with id ' . $note->id;
                    $data = $note;
                    $httpResponseCode = 201;
                } else {
                    $message = 'Project with ID ' . $noteId . ' not found.';
                    $data = '';
                    $httpResponseCode = 404;
                }
            }
        } else {
            $message = 'Did not pass validator.';
            $data = '';
            $httpResponseCode = 400;
        }

        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $httpResponseCode);
    }

    /** ----------------------------------------------------
     * deleteNote
     *
     * @param $noteId
     * @return string
     */
    public function deleteNote($noteId) {
        if (intval($noteId) === 0) {
            $message = 'Invalid argument.';
            $data = '';
            $httpResponseCode = 400;
        } else {
            $note = Note::find($noteId);

            if (!empty($note)) {
                $note->delete();

                $message = 'Succesfully removed note with id ' . $note->id;
                $data = '';
                $httpResponseCode = 201;
            } else {
                $message = 'Note with ID ' . $noteId . ' not found.';
                $data = '';
                $httpResponseCode = 404;
            }
        }

        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $httpResponseCode);

    }

    /** ----------------------------------------------------
     * checkIfValid
     *
     * @param $data
     * @param $fields
     * @return bool
     */
    public function checkIfValid($data, $fields){

        $validator = Validator::make($data, $fields);

        if ($validator->fails()) {
            $returnValue = false;
        } else {
            $returnValue = true;
        }

        return $returnValue;
    }
}
