<?php

use Illuminate\Database\Seeder;

class ProdukKategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ProdukKategori')->insert([
            [
                'nama_kategori'     =>  'Perlengkapan sholat',
                'status'            =>  '',
                'slug'              =>  'ProdukKategori1'
            ],
            [
                'nama_kategori'     =>  'Perlengkapan kantor',
                'status'            =>  '',
                'slug'              =>  'ProdukKategori2'
            ],
            [
                'nama_kategori'     =>  'Perlengkapan kuliah',
                'status'            =>  '',
                'slug'              =>  'ProdukKategori3'
            ]
        ]);
    }
}
