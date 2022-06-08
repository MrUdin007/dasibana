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
                'foto'          =>  '',
                'slug'          =>  'admin1'
            ],
            [
                'name'          =>  'product2',
                'category_id'   =>  '2',
                'status'        =>  true,
                'foto'          =>  '',
                'slug'          =>  'admin2'
            ],
            [
                'name'          =>  'product3',
                'category_id'   =>  '3',
                'status'        =>  true,
                'foto'          =>  '',
                'slug'          =>  'admin3'
            ],
            [
                'name'          =>  'product4',
                'category_id'   =>  '1',
                'status'        =>  true,
                'foto'          =>  '',
                'slug'          =>  'admin4'
            ],
            [
                'name'          =>  'product5',
                'category_id'   =>  '2',
                'status'        =>  true,
                'foto'          =>  '',
                'slug'          =>  'admin5'
            ],
            [
                'name'          =>  'product6',
                'category_id'   =>  '3',
                'status'        =>  false,
                'foto'          =>  '',
                'slug'          =>  'admin6'
            ],
            [
                'name'          =>  'product7',
                'category_id'   =>  '1',
                'status'        =>  false,
                'foto'          =>  '',
                'slug'          =>  'admin7'
            ],
            [
                'name'          =>  'product8',
                'category_id'   =>  '2',
                'status'        =>  false,
                'foto'          =>  '',
                'slug'          =>  'admin8'
            ],
            [
                'name'          =>  'product9',
                'category_id'   =>  '3',
                'status'        =>  false,
                'foto'          =>  '',
                'slug'          =>  'admin9'
            ],
            [
                'name'          =>  'product10',
                'category_id'   =>  '1',
                'status'        =>  false,
                'foto'          =>  '',
                'slug'          =>  'admin10'
            ]
        ]);
    }
}
