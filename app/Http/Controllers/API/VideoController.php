<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Video;

class VideoController extends Controller
{
    /** ----------------------------------------------------
     * GetAllVideos
     * - Gets all videos from the videos table
     *
     * @param $projectId
     * @return String
     */
    public function getAllVideos($projectId = false) {

        if($projectId){
            $videos = Video::where('project_id', $projectId)->get();
        } else {
            $videos = Video::all();
        }

        return response()->json([
            'message' => 'Success',
            'data' => $videos
        ], 200);
    }

    /** ----------------------------------------------------
     * createVideo
     * - Adds video to the videos table
     *
     * @param $request
     * @return string
     */
    public function createVideo(Request $request) {

        $validator = Validator::make($request->all(), [
            'project_id' => 'required|int',
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {
            $video = Video::create($request->all());

            if(!empty($video->id)) {
                return response()->json([
                    'message' => 'Successfully created video note with id '.$video->id,
                    'data' => $video
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Failed uploading data in database.'
                ], 500);
            }
        }
    }

    /** ----------------------------------------------------
     * UpdateVideo
     * - updates video with the correct id in the videos table
     *
     * @param $request
     * @param $videoId
     * @return string
     */
    public function updateVideo(Request $request, $videoId) {

        $validator = Validator::make($request->all(), [
            'project_id' => 'required|int',
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Did not pass validator.'
            ], 400);
        } else {

            if (intval($videoId) === 0) {
                return response()->json([
                    'message' => 'Invalid argument.'
                ], 400);
            } else {

                $video = Video::find($videoId);

                if(!empty($video)){
                    $video->project_id = $request->get('project_id');
                    $video->name = $request->get('name');

                    $video->save();

                    return response()->json([
                        'message' => 'Successfully updated video with id '.$video->id,
                        'data' => $video
                    ], 201);
                } else {
                    return response()->json([
                        'message' => 'Video with ID ' . $videoId . ' not found.'
                    ], 404);
                }
            }
        }
    }

    /** ----------------------------------------------------
     * deleteVideo
     * - deletes video with the given id
     *
     * @param $videoId
     * @return string
     */
    public function deleteVideo($videoId) {
        if(intval($videoId) === 0) {
            return response()->json([
                'message' => 'Invalid argument.'
            ], 400);
        } else {
            $video = Video::find($videoId);

            if(!empty($video)){
                $video->delete();
                return response()->json([
                    'message' => 'Succesfully removed video with id ' . $video->id
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Video with ID ' . $videoId . ' not found.'
                ], 404);
            }

        }
    }
}
