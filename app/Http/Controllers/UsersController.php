<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Session;

class UsersController extends Controller
{
    public function index()
    {
        

        return view('users.create');

    }

    public function show()
    {
    		$user = User::all();
            return view('users.show',compact('user'));
    }

    public function create()
    {

            return view('home.create');
    }

    public function store(Request $request)
    {

       
        $this->validate($request,[

                'name'=>'required|max:50',
                'email'=>'required|email|unique:users|max:255',
                'password'=>'required|confirmed|min:6'
        ]);



        $user = User::create([
        			'name'=>$request->name,
        			'email'=>$request->email,
        			'password'=>bcrypt($request->password),
        		]);

        Auth::login($user);
        session()->flash('success','添加成功');
        // session()->flash('danger','添加dange');
        // session()->flash('warning','添加warning');
        // session()->flash('info','添加info');
        return redirect()->route('users.show',[$user]);

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

