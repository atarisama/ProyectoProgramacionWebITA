<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectorController extends Controller
{
      public function index()
    {
        //dd('DirectorController funcionando');
        return view('director.dashboard');
    }
}
