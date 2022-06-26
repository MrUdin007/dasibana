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
        DB::table('profil')->insert([
            [
                'alamat'           =>  'jl.kaliurang',
                'tahun'              =>  '2018',
                'nama_bisnis'     =>  'konveksi',
                'pemilik'             =>  'Farhan Albana',
                'deskripsi'       =>  'bla bla bla',
                'slug'              =>  'konveksi'
            ],
            [
                'alamat'           =>  'jl.kaliurang',
                'tahun'              =>  '2018',
                'nama_bisnis'     =>  'konveksi1',
                'pemilik'             =>  'Farhan Albana1',
                'deskripsi'       =>  'bla bla bla1',
                'slug'              =>  'konveksi1'
            ],
            [
                'alamat'           =>  'jl.kaliurang',
                'tahun'              =>  '2018',
                'nama_bisnis'     =>  'konveksi2',
                'pemilik'             =>  'Farhan Albana',
                'deskripsi'       =>  'bla bla bla',
                'slug'              =>  'konveksi2'
            ],
            [
                'alamat'           =>  'jl.kaliurang',
                'tahun'              =>  '2018',
                'nama_bisnis'     =>  'konveksi3',
                'pemilik'             =>  'Farhan Albana',
                'deskripsi'       =>  'bla bla bla',
                'slug'              =>  'konveksi3'
            ],
            [
                'alamat'           =>  'jl.kaliurang',
                'tahun'              =>  '2018',
                'nama_bisnis'     =>  'konveksi4',
                'pemilik'             =>  'Farhan Albana',
                'deskripsi'       =>  'bla bla bla',
                'slug'              =>  'konveksi4'
            ]
        ]);
    }
}
