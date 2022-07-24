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
                'name'      =>  'incess bala-bala',
                'username'  =>  'risna',
                'email'     =>  'risna@gmail.com',
                'password'  =>  Hash::make('superadmin1'),
                'slug'      =>  'admin1',
                'remember_token' => Str::random(10),
                'created_at'    =>  Carbon::now()
            ]
        ]);
    }
}
