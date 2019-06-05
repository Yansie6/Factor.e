<?php

namespace App\Http\Controllers\API;

use App\Video;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    private $tagFields = [
        'tag' => 'string|max:255',
    ];
    
    private $types = ['video', 'project'];

    /** ----------------------------------------------------
     * getAllTags
     * - Gets all tags from a project or a video
     *
     * @param $type
     * @param $typeId
     * @return string
     */
    public function getAllTags($type, $typeId) {
        if (is_numeric($typeId)) {

            if (in_array($type, $this->types)) {

                    switch ($type) {
                        case $this->types[0]:
                            $videoIdExists = Video::where('id', '=', $typeId)->exists();

                            if ($videoIdExists) {
                                $data = Tag::select('id', 'tag', 'created_at', 'updated_at')->where('video_id', $typeId)->join('videos_linked_tags', 'tags.id', '=', 'videos_linked_tags.tag_id')->get();

                                $message = 'Success.';
                                $httpResponseCode = 200;
                                break;
                            } else {
                                $message = 'Video with id ' . $typeId . ' does not exist.';
                                $data = '';
                                $httpResponseCode = 404;
                                break;
                            }

                        case $this->types[1]:
                            $projectIdExists = Project::where('id', '=', $typeId)->exists();

                            if ($projectIdExists) {
                                $data = Tag::select('id', 'tag', 'created_at', 'updated_at')->where('project_id', $typeId)->join('projects_linked_tags', 'tags.id', '=', 'projects_linked_tags.tag_id')->get();

                                $message = 'Success.';
                                $httpResponseCode = 200;
                                break;
                            } else {
                                $message = 'Project with id ' . $typeId . ' does not exist.';
                                $data = '';
                                $httpResponseCode = 404;
                                break;
                            }

                        default:
                            $message = 'Invalid argument.';
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
                $message = 'Invalid argument "typeId".';
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
     * @param $typeId
     * @return string
     */
    public function createTag(Request $request, $type, $typeId) {

        $tagFieldsIsValid = $this->checkIfValid($request->all(), $this->tagFields);

        if ($tagFieldsIsValid) {

            if (is_numeric($typeId)) {

                if (in_array($type, $this->types)) {
                    $tagName = $request->input('tag');
                    $tag = Tag::firstOrCreate(['tag' => $tagName]);

                    switch ($type) {
                        case $this->types[0]:
                            $video = Video::where('id', '=', $typeId)->exists();

                            if ($video) {
                                $exists = $tag->videos->contains($typeId);
                                if ($exists) {
                                    $message = 'Connection with video id ' . $typeId . ' already exists.';
                                    $data = '';
                                    $httpResponseCode = 409;
                                } else {
                                    $tag->videos()->attach($typeId);

                                    $message = 'Successfully connected tag (id ' . $tag->id . ') to video (id ' . $typeId . ').';
                                    $data = $tag;
                                    $httpResponseCode = 201;
                                }
                            } else {
                                $message = 'Video with id ' . $typeId . ' does not exist.';
                                $data = '';
                                $httpResponseCode = 404;
                            }
                            break;

                        case $this->types[1]:
                            $project = Project::where('id', '=', $typeId)->exists();

                            if ($project) {
                                $exists = $tag->projects->contains($typeId);
                                if ($exists) {
                                    $message = 'Connection with project id ' . $typeId . ' already exists.';
                                    $data = '';
                                    $httpResponseCode = 409;
                                } else {
                                    $tag->projects()->attach($typeId);

                                    $message = 'Successfully connected tag (id ' . $tag->id . ') to project (id ' . $typeId . ').';
                                    $data = $tag;
                                    $httpResponseCode = 201;
                                }
                            } else {
                                $message = 'Project with id ' . $typeId . ' does not exist.';
                                $data = '';
                                $httpResponseCode = 404;
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
     * deleteTag
     *
     * @param $type
     * @param $typeId
     * @param $tagId
     * @return string
     */
    public function deleteTag($type, $typeId, $tagId) {

        if (is_numeric($typeId) and is_numeric($tagId)) {
            $typeInArray = in_array($type, $this->types);

            if ($typeInArray) {

                $tag = Tag::where('id', $tagId)->first();

                if ($tag === Null) {

                    $message = 'Tag with id ' . $typeId . ' does not exist.';
                    $data = '';
                    $httpResponseCode = 404;

                } else {

                    switch ($type) {
                        case $this->types[0]:
                            $tag->videos()->detach($typeId);
                            $otherTag = Tag::where('id', $tagId)->first();
                            $existsElsewhere = $otherTag->projects->contains($tagId);
                            break;

                        case $this->types[1]:
                            $tag->projects()->detach($typeId);
                            $otherTag = Tag::where('id', $tagId)->first();
                            $existsElsewhere = $otherTag->videos->contains($tagId);
                            break;

                        default:
                            $existsElsewhere = "nope";
                            break;
                    }

                    if ($existsElsewhere === "nope") {

                        $message = 'Something went wrong checking the type.';
                        $data = '';
                        $httpResponseCode = 400;

                    } elseif ($existsElsewhere) {

                        $message = 'Successfully disconnected tag (id ' . $tag->id . ') from ' . $type . ' (id ' . $typeId . ').';
                        $data = $tag;
                        $httpResponseCode = 201;

                    } else {
                        $tag->delete();

                        $message = 'Successfully disconnected tag (id ' . $tag->id . ') from ' . $type . ' (id ' . $typeId . '), and deleted it.';
                        $data = $tag;
                        $httpResponseCode = 201;

                    }
                }
            } else {
                $message = 'Invalid argument "type".';
                $data = '';
                $httpResponseCode = 400;
            }
        } else {
            $message = 'Invalid argument "typeId" or "tagId".';
            $data = '';
            $httpResponseCode = 400;
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
