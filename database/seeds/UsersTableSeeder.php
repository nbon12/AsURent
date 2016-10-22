<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'name' => 'happy',
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('squalid'),
        ]);
        DB::table('users')->insert([
                'name' => 'nick',
                'email' => 'nick@nick.nick',
                'password' => bcrypt(env('NICK_PASSWORD', 'password')),
        ]);
        
    }
}
