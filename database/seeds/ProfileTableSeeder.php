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
                'slug'              =>  'konveksi'
            ],
            [
                'address'           =>  'jl.kaliurang',
                'year'              =>  '2018',
                'business_name'     =>  'konveksi1',
                'owner'             =>  'Farhan Albana1',
                'description'       =>  'bla bla bla1',
                'slug'              =>  'konveksi1'
            ],
            [
                'address'           =>  'jl.kaliurang',
                'year'              =>  '2018',
                'business_name'     =>  'konveksi2',
                'owner'             =>  'Farhan Albana',
                'description'       =>  'bla bla bla',
                'slug'              =>  'konveksi2'
            ],
            [
                'address'           =>  'jl.kaliurang',
                'year'              =>  '2018',
                'business_name'     =>  'konveksi3',
                'owner'             =>  'Farhan Albana',
                'description'       =>  'bla bla bla',
                'slug'              =>  'konveksi3'
            ],
            [
                'address'           =>  'jl.kaliurang',
                'year'              =>  '2018',
                'business_name'     =>  'konveksi4',
                'owner'             =>  'Farhan Albana',
                'description'       =>  'bla bla bla',
                'slug'              =>  'konveksi4'
            ]
        ]);
    }
}
