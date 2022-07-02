<?php

use Illuminate\Database\Seeder;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori_produk')->insert([
            [
                'name'              =>  'Perlengkapan sholat',
                'status'            =>  true,
                'slug'              =>  'ProdukKategori1'
            ],
            [
                'name'              =>  'Perlengkapan kantor',
                'status'            =>  true,
                'slug'              =>  'ProdukKategori2'
            ],
            [
                'name'              =>  'Perlengkapan kuliah',
                'status'            =>  true,
                'slug'              =>  'ProdukKategori3'
            ],
            [
                'name'              =>  'Perlengkapan kantor 1',
                'status'            =>  true,
                'slug'              =>  'ProdukKategori4'
            ],
            [
                'name'              =>  'Perlengkapan kuliah 2',
                'status'            =>  true,
                'slug'              =>  'ProdukKategori5'
            ],
            [
                'name'              =>  'Perlengkapan kantor 4',
                'status'            =>  true,
                'slug'              =>  'ProdukKategori6'
            ],
            [
                'name'              =>  'Perlengkapan kuliah 5',
                'status'            =>  true,
                'slug'              =>  'ProdukKategori7'
            ],
            [
                'name'              =>  'Perlengkapan kantor 6',
                'status'            =>  true,
                'slug'              =>  'ProdukKategori8'
            ],
            [
                'name'              =>  'Perlengkapan kuliah 7',
                'status'            =>  true,
                'slug'              =>  'ProdukKategori9'
            ]
        ]);
    }
}
