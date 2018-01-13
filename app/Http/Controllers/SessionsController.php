<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Session;

class SessionsController extends Controller
{
    

    public function create()
    {

    	return view('sessions.create');
    }

    public function stroe(Request $request)
    {
    	$credentials = $this->validate($request,[
    				'email'=>'required|email|max:255',
    				'password'=>'required'
    	]);

    	// dd($request->all());

    	if(Auth::attempt($credentials,$request->has('remember')))
    	{
    			session()->flash('success','登录成功');
                return redirect()->route('show',[Auth::user()]);

    	}else
    	{

    		session()->flash('danger','密码或邮箱不正确');
            return redirect()->back();
    	}

    	
    	
    }

    public function show()
    {

    	return view('users.show');
    }


    public function destory()
    {

    	Auth::logout();

        session()->flash('success','你已经成功退出');

        return redirect('login');
    }
}
