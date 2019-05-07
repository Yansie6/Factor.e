<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** ----------------------------------------------------
     * __Construct
     * - Always execute this functions if this class is used
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** ----------------------------------------------------
     * Index
     * - Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
