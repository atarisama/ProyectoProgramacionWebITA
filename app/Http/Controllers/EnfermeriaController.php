<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnfermeriaController extends Controller
{
    public function index()
    {
        return view('enfermeria.dashboard');
    }
}
