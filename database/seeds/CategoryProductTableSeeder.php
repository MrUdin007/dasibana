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
        DB::table('product_category')->insert([
            [
                'category_name'     =>  'Perlengkapan sholat',
                'status'            =>  '',
                'slug'              =>  'ProdukKategori1'
            ],
            [
                'category_name'     =>  'Perlengkapan kantor',
                'status'            =>  '',
                'slug'              =>  'ProdukKategori2'
            ],
            [
                'category_name'     =>  'Perlengkapan kuliah',
                'status'            =>  '',
                'slug'              =>  'ProdukKategori3'
            ]
        ]);
    }
}
