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
     * @return Video[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllVideos() {
        $videos = Video::all();

        return $videos;
    }

    /** ----------------------------------------------------
     * addVideo
     * - Adds video to the videos table
     *
     * @param Request $request
     * @return string
     */
    public function addVideo(Request $request) {

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
                    'message' => 'Successfully added video note with id '.$video->id,
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
     * @param Request $request
     * @param $video_id
     * @return string
     */
    public function updateVideo(Request $request, $video_id) {

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

            if (intval($video_id) === 0) {
                return response()->json([
                    'message' => 'Invalid argument.'
                ], 400);
            } else {
                $video = Video::find($video_id);

                $video->project_id = $request->get('project_id');
                $video->name = $request->get('name');
                $video->link = $request->get('link');

                $video->save();

                return response()->json([
                    'message' => 'Successfully updated video with id '.$video->id,
                    'data' => $video
                ], 201);
            }
        }
    }

    /** ----------------------------------------------------
     * deleteVideo
     * - deletes video with the given id
     *
     * @param $video_id
     * @return string
     */
    public function deleteVideo($video_id) {
        if(intval($video_id) === 0) {
            return response()->json([
                'message' => 'Invalid argument.'
            ], 400);
        } else {
            //check if record exists
            $video = Video::find($video_id);

            if(!empty($video)){
                Video::find($video_id)->delete();
                return response()->json([
                    'message' => 'Succesfully removed video with id ' . $video->id
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Video with ID ' . $video_id . ' not found.'
                ], 404);
            }

        }
    }
}
