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
                'description'       =>  'bla bla bla',
                'address'           =>  'jl.kaliurang',
                'year'              =>  '2018',
                'business'          =>  'konveksi',
                'owner'             =>  'Farhan Albana',
                'slug'              =>  'kontak'
            ]
        ]);
    }
}
