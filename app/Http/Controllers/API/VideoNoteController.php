<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class VideoNoteController extends Controller
{
    /** ----------------------------------------------------
     * Index
     *  - returns welcome view
     *
     * @return view
     */
    public function videoView() {

//        $tags = App\Project::find(1)->Tags;
        $projects = App\Tag::find(1)->Projects;

        dd($projects);

        return view('welcome');
    }
}
