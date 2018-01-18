<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;

use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    *定义用户和statuses之间的一对多模型
    */
    public function statuses()
    {

        return $this->hasMany(Status::class);
    }

    /*
    *用户激活
    */
    // protected $hidden = ['password','remember_token',];

     public function gravatar($size='100')
    {

       
        $hash = md5(strtolower(trim($this->attributes['email'])));

        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    /*
    *用户激活使用
    */
    public static function boot()
    {

        parent::boot();

        static::creating(function ($user){
            
            $user->activation_token = str_random(30);
        });

    }

    /*
    *用户修改密码
    */

    public function sendPasswordResetNotification($token)
    {

        $this->notify(new ResetPassword($token));
    }

    /*
    *当前用户的所有微博的动态
    */

    // public function feed()
    // {

    //     return $this->statuses()
    //                 ->orderBy('created_at','desc');

    // }


    /**
    *   一个user_id对应多个follower_id
    */
    public function followers()
    {
        // 一个user_id对应多个follower_id
        return $this->belongsToMany(User::Class,'followers','user_id','follower_id');
    }

    /**
    *   一个follower_id对应多个user_id--->
    */
    public function followings()
    {

        return $this->belongsToMany(User::Class,'followers','follower_id','user_id');
    }


    /**
    *  关注
    */
    public function follow($user_ids)
    {

        if(!is_array($user_ids))
        {
            $user_ids = compact('user_ids');
        }

        $this->followings()->sync($user_ids,false);
    }

    /**
    *   取消关注
    */
    public function unfollow($user_ids)
    {

        if(!is_array($user_ids))
        {
            $user_ids = compact('user_ids');
        }

        $this->followings()->detach($user_ids);
    }

    /**
    *   相互关注
    */
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }


    /**
    *设置动态流
    */
    public function feed()
    {
        $user_ids = Auth::user()->followings->pluck('id')->toArray();

        array_push($user_ids,Auth::user()->id);

        return Status::whereIn('user_id',$user_ids)
                                ->with('user')
                                ->orderBy('created_at','desc');
    }




}
