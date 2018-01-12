<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function home()
    {

    	return view('home.home');
    }

    public function help()
    {

    	return view('home.help');
    }
    
    public function about()
    {

    	return view('home.about');
    }
}
