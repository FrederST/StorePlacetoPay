<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['name'=> 'Freder', 'surname'=> 'Hernandez', 'email' => 'rimubiddik-5999@yopmail.com', 'mobile' => '310440664', 'password'=> bcrypt('laravel'), 'remember_token' => Str::random(10)],
            ['name'=> 'Andres', 'surname'=> 'Mosquera', 'email' => 'fredersteven399@hotmail.com', 'mobile' => '310440664', 'password'=> bcrypt('laravel'), 'remember_token' => Str::random(10)],
        ]);
    }
}
