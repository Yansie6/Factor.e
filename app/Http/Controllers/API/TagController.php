<?php

namespace App\Http\Controllers\API;

use App\Video_linked_tag;
use App\Project_linked_tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    private $noteFields = [
        'id' => 'required|int',
        'tag' => 'string|max:255',
    ];

    /** ----------------------------------------------------
     * getAllTags
     * - Gets all tags from a project or a video
     *
     * @param $type
     * @param $id
     * @return string
     */
    public function getAllTags($type, $id) {
        if (is_numeric($id)) {
            $message = 'Succes';
            $httpResponseCode = 200;

            switch ($type) {
                case 'video':
                    /*$tagIds = Video_linked_tag::where('project_id', $id)->get();
                    foreach ($tagIds as $tagId) {
                        $tags = Tag::where('id', $tagId);
                    }*/
                    $data = Tag::select('id', 'tag', 'created_at', 'updated_at')->where('video_id', $id)->join('videos_linked_tags', 'tags.id', '=', 'videos_linked_tags.tag_id')->get();
                    break;

                case 'project':
                    $data = Tag::select('id', 'tag', 'created_at', 'updated_at')->where('project_id', $id)->join('projects_linked_tags', 'tags.id', '=', 'projects_linked_tags.tag_id')->get();
                    break;

                default:
                    $message = 'Invalid argument';
                    $data = '';
                    $httpResponseCode = 400;
            }
        } else {
            $message = 'Invalid argument';
            $data = '';
            $httpResponseCode = 400;
        }

        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $httpResponseCode);

    }

    /** ----------------------------------------------------
     * createTag
     * - Creates a tag that is connected to a project or video
     *
     * @param $request
     * @return string
     */
    public function createNote(Request $request, $type, $id) {

        $isValid = $this->checkIfValid($request->all(), $this->noteFields);

        /*if ($isValid) {
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
        ], $httpResponseCode);*/

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

        /*$isValid = $this->checkIfValid($request->all(), $this->noteFields);

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
        ], $httpResponseCode);*/
    }

    /** ----------------------------------------------------
     * deleteNote
     *
     * @param $noteId
     * @return string
     */
    public function deleteNote($noteId) {
        /*if (intval($noteId) === 0) {
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
        ], $httpResponseCode);*/
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
