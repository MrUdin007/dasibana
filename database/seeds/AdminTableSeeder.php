<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name'      =>  'incess bala-bala',
                'username'  =>  'risna',
                'email'     =>  'risna@gmail.com',
                'password'  =>  Hash::make('superadmin1'),
                'slug'      =>  'admin1',
                'remember_token' => Str::random(10)
            ],
            [
                'name'      =>  'iki bala-bala',
                'username'  =>  'rifki',
                'email'     =>  'rifki@gmail.com',
                'password'  =>  Hash::make('superadmin2'),
                'slug'      =>  'admin2',
                'remember_token' => Str::random(10)
            ],
            [
                'name'      =>  'piti bala-bala',
                'username'  =>  'fitri',
                'email'     =>  'fitri@gmail.com',
                'password'  =>  Hash::make('superadmin3'),
                'slug'      =>  'admin3',
                'remember_token' => Str::random(10)
            ]
        ]);
    }
}
