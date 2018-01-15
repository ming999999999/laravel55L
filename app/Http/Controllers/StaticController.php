<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StaticController extends Controller
{
    public function home()
    {

        $user = new User;

        $data = $user->gravatar('200');

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

    public function share()
    {
        

        return view('shared.user_info',compact('user'));
    }

    public function show()
    {
        $user = User::find(3);
        return view('shared.show',compact('user'));
    }

}
