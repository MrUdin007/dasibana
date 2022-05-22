<?php

use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile')->insert([
            [
                'address'           =>  'jl.kaliurang',
                'year'              =>  '2018',
                'business_name'     =>  'konveksi',
                'owner'             =>  'Farhan Albana',
                'description'       =>  'bla bla bla',
                'slug'              =>  'kontak'
            ]
        ]);
    }
}
