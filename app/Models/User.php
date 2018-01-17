<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

// use App\Models\Status;

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

    public function feed()
    {

        return $this->statuses()
                    ->orderBy('created_at','desc');

    }




}
