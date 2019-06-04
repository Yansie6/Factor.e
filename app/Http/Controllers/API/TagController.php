<?php

namespace App\Http\Controllers\API;

use App\Video;
use App\Video_linked_tag;
use App\Project;
use App\Project_linked_tag;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    private $tagFields = [
        'tag' => 'string|max:255',
    ];

    /*private $videoTagFields = [
        'tag_id' => 'int',
        'video_id' => 'int',
    ];

    private $projectTagFields = [
        'tag_id' => 'int',
        'project_id' => 'int',
    ];*/

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
                    $data = Tag::select('id', 'tag', 'created_at', 'updated_at')->where('video_id', $id)->join('videos_linked_tags', 'tags.id', '=', 'videos_linked_tags.tag_id')->get();
                    break;

                case 'project':
                    $data = Tag::select('id', 'tag', 'created_at', 'updated_at')->where('project_id', $id)->join('projects_linked_tags', 'tags.id', '=', 'projects_linked_tags.tag_id')->get();
                    break;

                default:
                    $message = 'Invalid argument.';
                    $data = '';
                    $httpResponseCode = 400;
            }
        } else {
            $message = 'Invalid argument.';
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
     * @param $type
     * @param $id
     * @return string
     */
    public function createTag(Request $request, $type, $id) {

        $tagFieldsIsValid = $this->checkIfValid($request->all(), $this->tagFields);

        if ($tagFieldsIsValid) {
            if (is_numeric($id)) {
                $types = ['video', 'project'];

                if (in_array($type, $types)) {
                    $tagName = $request->input('tag');
                    $tag = Tag::firstOrCreate(['tag' => $tagName]);

                    switch ($type) {
                        case $types[0]:
                            $video = Video::where('id', '=', $id)->exists();

                            if ($video) {
                                $exists = $tag->videos->contains($id);
                                if ($exists) {
                                    $message = 'Connection with video id ' . $id . ' already exists.';
                                    $data = '';
                                    $httpResponseCode = 409;
                                } else {
                                    $tag->videos()->attach($id);

                                    $message = 'Successfully connected tag (id ' . $tag->id . ') to video (id ' . $id . ').';
                                    $data = $tag;
                                    $httpResponseCode = 201;
                                }
                            } else {
                                $message = 'Video with id ' . $id . ' does not exist.';
                                $data = '';
                                $httpResponseCode = 400;
                            }
                            break;

                        case $types[1]:
                            $project = Project::where('id', '=', $id)->exists();

                            if ($project) {
                                $exists = $tag->projects->contains($id);
                                if ($exists) {
                                    $message = 'Connection with project id ' . $id . ' already exists.';
                                    $data = '';
                                    $httpResponseCode = 409;
                                } else {
                                    $tag->projects()->attach($id);

                                    $message = 'Successfully connected tag (id ' . $tag->id . ') to project (id ' . $id . ').';
                                    $data = $tag;
                                    $httpResponseCode = 201;
                                }
                            } else {
                                $message = 'Project with id ' . $id . ' does not exist.';
                                $data = '';
                                $httpResponseCode = 400;
                            }
                            break;
                        default:
                            $message = 'Something went wrong checking the type.';
                            $data = '';
                            $httpResponseCode = 400;
                            break;
                    }
                } else {
                    $message = 'Invalid argument "type".';
                    $data = '';
                    $httpResponseCode = 400;
                }
            } else {
                $message = 'Invalid argument "id".';
                $data = '';
                $httpResponseCode = 400;
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
    public function updateTag(Request $request, $noteId) {

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
    public function deleteTag($noteId) {
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
