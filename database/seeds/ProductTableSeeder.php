<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            [
                'name'          =>  'product1',
                'category_id'   =>  '1',
                'status'        =>  true,
                'foto'          =>  'images/product1.jpg',
                'slug'          =>  'admin1'
            ],
            [
                'name'          =>  'product2',
                'category_id'   =>  '2',
                'status'        =>  true,
                'foto'          =>  'images/product2.jpg',
                'slug'          =>  'admin2'
            ],
            [
                'name'          =>  'product3',
                'category_id'   =>  '3',
                'status'        =>  true,
                'foto'          =>  'images/product3.jpg',
                'slug'          =>  'admin3'
            ],
            [
                'name'          =>  'product4',
                'category_id'   =>  '1',
                'status'        =>  true,
                'foto'          =>  'images/product4.jpg',
                'slug'          =>  'admin4'
            ],
            [
                'name'          =>  'product5',
                'category_id'   =>  '2',
                'status'        =>  true,
                'foto'          =>  'images/product5.jpg',
                'slug'          =>  'admin5'
            ],
            [
                'name'          =>  'product6',
                'category_id'   =>  '3',
                'status'        =>  false,
                'foto'          =>  'images/product6.jpg',
                'slug'          =>  'admin6'
            ],
            [
                'name'          =>  'product7',
                'category_id'   =>  '1',
                'status'        =>  false,
                'foto'          =>  'images/product7.jpg',
                'slug'          =>  'admin7'
            ],
            [
                'name'          =>  'product8',
                'category_id'   =>  '2',
                'status'        =>  false,
                'foto'          =>  'images/product8.jpg',
                'slug'          =>  'admin8'
            ],
            [
                'name'          =>  'product9',
                'category_id'   =>  '3',
                'status'        =>  false,
                'foto'          =>  'images/product9.jpg',
                'slug'          =>  'admin9'
            ],
            [
                'name'          =>  'product10',
                'category_id'   =>  '1',
                'status'        =>  false,
                'foto'          =>  'images/product10.jpg',
                'slug'          =>  'admin10'
            ]
        ]);
    }
}
