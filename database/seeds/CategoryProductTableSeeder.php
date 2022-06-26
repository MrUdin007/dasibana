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
        DB::table('kategori_product')->insert([
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
            ]
        ]);
    }
}
