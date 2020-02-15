<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
           'name' => 'Manjeet Bargoti',
           'email' => 'msb.2905@gmail.com',
           'phone' => '9411447236',
           'type' => 'admin',
           'bio' => "I'm a Developer",
           'photo' => 'profile.jpg',
           'password' => Hash::make('Admin@007')
        ]);
    }
}
