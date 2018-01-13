<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        

        return view('users.create');

    }

    public function show()
    {

            return view('home.show');
    }

    public function create()
    {

            return view('home.create');
    }

    public function store(Request $request)
    {

        
        $this->validate($request,[
                'name'=>'required|max:50',
                'email'=>'required|email|unique:max:255',
                'password'=>'required|confirmed|min:6'
        ]);

        return;
    }

    public function edit()
    {


    }

    public function update()
    {


    }

    public function destroy(){


    }

    
}
