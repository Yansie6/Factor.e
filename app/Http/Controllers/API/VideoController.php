<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Video;
use App\Video_note;

class VideoController extends Controller
{
    public function addVideo(Request $request) {

        $validator = Validator::make($request->all(), [
            'project_id' => 'required|int',
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255'
        ]);

        if($validator->fails()) {
            return http_response_code(400).': Did not pass validator, missing project_id, name or link.';
        } else {
            $video = Video::create($request->all());

            if(!empty($video->id)) {
                return http_response_code(200);
            } else {
                return http_response_code(400).': failed uploading data in database.';
            }
        }
    }

    public function deleteVideo(Request $request) {

    }
}
