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
                'name'                 =>  'product1',
                'category_id'          =>  '1',
                'status'               =>  true,
                'foto'                 =>  'images/product1.jpg',
                'shopee_link'          =>  '',
                'tokopedia_link'       =>  ''
            ],
            [
                'name'                 =>  'product2',
                'category_id'          =>  '2',
                'status'               =>  true,
                'foto'                 =>  'images/product2.jpg',
                'shopee_link'          =>  '',
                'tokopedia_link'       =>  ''
            ],
            [
                'name'                 =>  'product3',
                'category_id'          =>  '3',
                'status'               =>  true,
                'foto'                 =>  'images/product3.jpg',
                'shopee_link'          =>  '',
                'tokopedia_link'       =>  ''
            ],
            [
                'name'                 =>  'product4',
                'category_id'          =>  '4',
                'status'               =>  true,
                'foto'                 =>  'images/product4.jpg',
                'shopee_link'          =>  '',
                'tokopedia_link'       =>  ''
            ],
            [
                'name'                 =>  'product5',
                'category_id'          =>  '5',
                'status'               =>  true,
                'foto'                 =>  'images/product5.jpg',
                'shopee_link'          =>  '',
                'tokopedia_link'       =>  ''
            ],
            [
                'name'                 =>  'product6',
                'category_id'          =>  '6',
                'status'               =>  true,
                'foto'                 =>  'images/product6.jpg',
                'shopee_link'          =>  '',
                'tokopedia_link'       =>  ''
            ]
        ]);
    }
}
