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
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product1'
            ],
            [
                'name'                 =>  'product2',
                'id_kategori'          =>  '2',
                'status'               =>  true,
                'foto'                 =>  'images/product3.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product2'
            ],
            [
                'name'                 =>  'product3',
                'id_kategori'          =>  '3',
                'status'               =>  true,
                'foto'                 =>  'images/product3.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product3'
            ],
            [
                'name'                 =>  'product4',
                'id_kategori'          =>  '4',
                'status'               =>  true,
                'foto'                 =>  'images/product4.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product4'
            ],
            [
                'name'                 =>  'product5',
                'id_kategori'          =>  '5',
                'status'               =>  true,
                'foto'                 =>  'images/product5.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product5'
            ],
            [
                'name'                 =>  'product6',
                'id_kategori'          =>  '6',
                'status'               =>  true,
                'foto'                 =>  'images/product6.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product6'
            ],
            [
                'name'                 =>  'product7',
                'id_kategori'          =>  '7',
                'status'               =>  true,
                'foto'                 =>  'images/product1.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product7'
            ],
            [
                'name'                 =>  'product8',
                'id_kategori'          =>  '8',
                'status'               =>  true,
                'foto'                 =>  'images/product3.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product8'
            ],
            [
                'name'                 =>  'product9',
                'id_kategori'          =>  '9',
                'status'               =>  true,
                'foto'                 =>  'images/product3.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product9'
            ],
            [
                'name'                 =>  'product10',
                'id_kategori'          =>  '1',
                'status'               =>  true,
                'foto'                 =>  'images/product4.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product10'
            ],
            [
                'name'                 =>  'product11',
                'id_kategori'          =>  '2',
                'status'               =>  true,
                'foto'                 =>  'images/product5.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product11'
            ],
            [
                'name'                 =>  'product12',
                'id_kategori'          =>  '3',
                'status'               =>  true,
                'foto'                 =>  'images/product6.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product12'
            ],
            [
                'name'                 =>  'product13',
                'id_kategori'          =>  '4',
                'status'               =>  true,
                'foto'                 =>  'images/product1.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product13'
            ],
            [
                'name'                 =>  'product14',
                'id_kategori'          =>  '5',
                'status'               =>  true,
                'foto'                 =>  'images/product3.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product14'
            ],
            [
                'name'                 =>  'product15',
                'id_kategori'          =>  '6',
                'status'               =>  true,
                'foto'                 =>  'images/product3.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product15'
            ],
            [
                'name'                 =>  'product16',
                'id_kategori'          =>  '7',
                'status'               =>  true,
                'foto'                 =>  'images/product4.jpg',
                'link_shopee'          =>  'https://shopee.co.id/Dasii-Kupu-kupu-Hitam-Polos-Mengkilap-TOP-QUALITY-i.35300544.592150122?sp_atk=301a5d17-6012-4ad1-af69-f937d8c0244a&xptdk=301a5d17-6012-4ad1-af69-f937d8c0244a',
                'link_tokopedia'       =>  'https://www.tokopedia.com/konveksibana/dasi-panjang-import-lurik',
                'slug'                 =>  'product16'
            ]
        ]);
    }
}
