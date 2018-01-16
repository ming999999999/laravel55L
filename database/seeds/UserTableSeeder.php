<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = factory(User::class)->times(50)->make() ;

      User::insert($user->makeVisible(['password','remember_token'])->toArray());

      $user = User::find(1);
      $user->name = 'hello';
      $user->email = 'hello@163.com';
      $user->password = bcrypt('hello');
      $user->is_admin = true;
      $user->activated = true;
      $user->save();
    }
}