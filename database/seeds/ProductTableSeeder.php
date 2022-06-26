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
        DB::table('produk')->insert([
            [
                'name'                 =>  'product1',
                'id_kategori'          =>  '1',
                'status'               =>  true,
                'foto'                 =>  'images/product1.jpg',
                'link_shopee'          =>  '',
                'link_tokopedia'       =>  ''
            ],
            [
                'name'                 =>  'product2',
                'id_kategori'          =>  '2',
                'status'               =>  true,
                'foto'                 =>  'images/product2.jpg',
                'link_shopee'          =>  '',
                'link_tokopedia'       =>  ''
            ],
            [
                'name'                 =>  'product3',
                'id_kategori'          =>  '3',
                'status'               =>  true,
                'foto'                 =>  'images/product3.jpg',
                'link_shopee'          =>  '',
                'link_tokopedia'       =>  ''
            ],
            [
                'name'                 =>  'product4',
                'id_kategori'          =>  '4',
                'status'               =>  true,
                'foto'                 =>  'images/product4.jpg',
                'link_shopee'          =>  '',
                'link_tokopedia'       =>  ''
            ],
            [
                'name'                 =>  'product5',
                'id_kategori'          =>  '5',
                'status'               =>  true,
                'foto'                 =>  'images/product5.jpg',
                'link_shopee'          =>  '',
                'link_tokopedia'       =>  ''
            ],
            [
                'name'                 =>  'product6',
                'id_kategori'          =>  '6',
                'status'               =>  true,
                'foto'                 =>  'images/product6.jpg',
                'link_shopee'          =>  '',
                'link_tokopedia'       =>  ''
            ]
        ]);
    }
}
