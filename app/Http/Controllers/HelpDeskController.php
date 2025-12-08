<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index(){

        return view('help.dashboard');
    }
    public function vehicleList(){

        return view('help.pages.vehicleList');
    }


}
