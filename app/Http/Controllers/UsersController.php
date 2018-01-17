<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Status;

use Session;
use Mail;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth',[
            'except'=>['show','create','store','index','confirmEmail']
        ]);

        // $this->middleware('guest',['only'=>['create']]);


    }
    public function index()
    {
        // $user = User::all();
        $user = User::paginate(5);

        return view('users.index',compact('user'));
    }

    public function show(User $user)
    {
    		
           
            $statuses = $user->statuses()
                            ->orderBy('created_at','desc')
                            ->paginate(30);

                            // dd($statuses);

            return view('users.show',compact('user','statuses'));
    }

    public function create()
    {

            return view('users.create');
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

        $this->sendEmailConfirmationTon($user);

     
        session()->flash('success','验证邮件已发送至你的邮箱,请注意查收');
        // session()->flash('danger','添加dange');
        // session()->flash('warning','添加warning');
        // session()->flash('info','添加info');
        return redirect()->route('users.index',[$user]);

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

    public function sendEmailConfirmationTon($user)
    {

        $view = 'emails.confirm';
        $data = compact('user');
        $from = '18810448544@163.com';
        $name = "hello";
        $to = $user->email;
        $subject = '感谢注册sample应用!请确认你的邮箱.';

        Mail::send($view,$data,function($message) use ($from,$name,$to,$subject){
            $message->from($from,$name)->to($to)->subject($subject);
        });
    }

    /*
    *
    *判断是否激活
    */
    public function confirmEmail($token)
    {

        $user = User::where('activation_token',$token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();
        Auth::login($user);
        session()->flash('success','恭喜你,激活成功');
        return redirect('/users',[$user]);
    }

    
}

