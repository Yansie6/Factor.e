<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class NoteController extends Controller
{
    /** ----------------------------------------------------
     * Index
     *  - returns welcome view
     *
     * @return view
     */
    public function index() {

        $notes = Project::find(1)->notes;

        dd($notes);

        die();
        return view('welcome');
    }
}
