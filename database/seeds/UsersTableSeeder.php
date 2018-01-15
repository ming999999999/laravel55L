<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        // 	'name'=>str_random(10),
        // 	'email'=>str_random(10).'@163.com',
        // 	'password'=>bcrypt('password'),
        // ]);

        $users = factory(User::class)->times(50)->make();

        User::insert($users->makeVisible(['password','remember_token'])->toArray());

        $user = User::find(1);
        $user->name = 'helloworld';
        $user->email = 'helloworld@163.com';
        $user->password = bcrypt('password');
        $user->is_admin = true;
        $user->save();
    }
}
