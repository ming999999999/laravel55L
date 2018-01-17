<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Session;

class SessionsController extends Controller
{
    
    public function __construct()
    {

        // $this->middleware('guest',['only'=>['create']]);
    }

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
    			// session()->flash('success','登录成功');
       //          return redirect()->route('users',[Auth::user()]);

            if(Auth::user()->activated)
                {

                    session()->flash('success','欢迎回来');
                    return redirect()->intended(route('users.show',[Auth::user()]));
                }else
                {

                    Auth::logout();
                    session()->flash('warning','你的账号未激活');
                    return redirect()->route('users.index');
                }

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


   public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}

