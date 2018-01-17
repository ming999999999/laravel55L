<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Auth;
use App\Models\Status;
use App\Models\User;

class StatusesController extends Controller
{
	/**
	*调用auth中间件判断是否为当前用户
	*/
	public function __construct()
	{
			
		$this->middleware('auth');

	}

	public function index()
	{

		return view('static.home');
	}

	/**
	*微博内容的存储
	*/
    public function store(Request $request)
    {

    	

    	$this->validate($request,[
    		'content'=>'required|max:140'
    	]);

    	Auth::user()->statuses()->create([
    		'content'=>$request->content
    	]);

    	session()->flash('success','已经发布成功');

    	return redirect()->back();
    }

    public function destroy(Status $status)
    {

    	$this->authorize('destroy',$status);
    	$status->delete();
    	session()->flash('success','微博已经删除');
    	return redirect()->back();
    }
}
