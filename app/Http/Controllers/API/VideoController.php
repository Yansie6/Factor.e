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
            http_response_code(400);
            return http_response_code().': Did not pass validator.';
        } else {
            $video = Video::create($request->all());

            if(!empty($video->id)) {
                http_response_code(201);
                return $video;
            } else {
                http_response_code(500);
                return http_response_code().': failed uploading data in database.';
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
            http_response_code(400);
            return http_response_code().': Did not pass validator.';
        } else {

            if (intval($video_id) === 0) {
                http_response_code(400);
                return http_response_code() . ': invalid argument';
            } else {
                $video = Video::find($video_id);

                $video->project_id = $request->get('project_id');
                $video->name = $request->get('name');
                $video->link = $request->get('link');

                $video->save();

                http_response_code(200);
                return http_response_code().': updated row with id '.$video->id;
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
            http_response_code(400);
            return http_response_code().': invalid argument';
        } else {
            //check if record exists
            $video = Video::find($video_id);

            if(!empty($video)){
                Video::find($video_id)->delete();
                http_response_code(200);
                return http_response_code().': Succesfully removed video with id '.$video->id;
            } else {
                http_response_code(404);
                return http_response_code().': Video not found';
            }

        }
    }
}
