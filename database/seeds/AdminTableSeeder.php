<?php

use Carbon\Carbon;
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
                'name'      =>  'rifki',
                'username'  =>  'rifki123',
                'email'     =>  'rifki@gmail.com',
                'password'  =>  Hash::make('rifki123'),
                'slug'      =>  'admin1',
                'remember_token' => Str::random(10),
                'created_at'    =>  Carbon::now()
            ]
        ]);
    }
}
