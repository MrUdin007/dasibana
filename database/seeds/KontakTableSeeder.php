<?php

use Illuminate\Database\Seeder;

class KontakTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kontak')->insert([
            [
                'profile'           =>  'bla bla bla',
                'alamat'            =>  'jl.kaliurang',
                'tahun_berdiri'     =>  '2018',
                'bidang_bisnis'     =>  'konveksi',
                'nama_pemilik'      =>  'Farhan Albana',
                'slug'              =>  'kontak'
            ]
        ]);
    }
}
