<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Session;

class UsersController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth',[
            'except'=>['show','create','store','index']
        ]);

        $this->middleware('guest',['only'=>['create']]);


    }
    public function index()
    {
        // $user = User::all();
        $user = User::paginate(5);

        return view('users.index',compact('user'));
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

     
        session()->flash('success','添加成功');
        // session()->flash('danger','添加dange');
        // session()->flash('warning','添加warning');
        // session()->flash('info','添加info');
        return redirect()->route('users.show',[$user]);

    }

    public function edit($id)
    {
       

        $user = User::find($id);

         $this->authorize('update',$user);

        return view('users.edit',compact('user'));
    }

    public function update(User $user, Request $request)
    {

        // $this->validate($request,[
        //     'name'=>'required|max:50',
        //     'password'=>'required|confirmed|min:6'
        // ]);

        // $user->update([
        //     'name'=>$request->name,
        //     'password'=>bcrypt($request->password),
        // ]);

        $this->validate($request,[
            'name'=>'required|max:50',
            'password'=>'nullable|confirmed|min:6'
        ]);


        $this->authorize('update',$user);

        $data = [];

        $data['name'] = $request->name;

        if($request->password)
        {

            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success','个人资料修改成功');

        return redirect()->route('users.show',$user->id);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy',$user);

        $user->delete();

        session()->flash('success','用户成功删除');

        return back();

    }

    
}

