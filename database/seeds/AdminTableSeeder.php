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
                'foto'      =>  '',
                'slug'      =>  'admin1',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10)
            ],
            [
                'name'      =>  'iki bala-bala',
                'username'  =>  'rifki',
                'email'     =>  'rifki@gmail.com',
                'password'  =>  Hash::make('superadmin2'),
                'foto'      =>  '',
                'slug'      =>  'admin2',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10)
            ],
            [
                'name'      =>  'piti bala-bala',
                'username'  =>  'fitri',
                'email'     =>  'fitri@gmail.com',
                'password'  =>  Hash::make('superadmin3'),
                'foto'      =>  '',
                'slug'      =>  'admin3',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10)
            ]
        ]);
    }
}
