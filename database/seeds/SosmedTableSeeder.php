<?php

use Illuminate\Database\Seeder;

class SosmedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sosmed')->insert([
            [
                'name'    =>  'dasibanaShopee',
                'icon'    =>  'images/icons/shopee.png',
                'slug'    =>  'shopee'
            ],
            [
                'name'    =>  'dasibanaFacebook',
                'icon'    =>  'images/icons/facebook.png',
                'slug'    =>  'facebook'
            ],
            [
                'name'    =>  'dasibanaInstagram',
                'icon'    =>  'images/icons/instagram.png',
                'slug'    =>  'instagram'
            ],
            [
                'name'    =>  'dasibanaTokopedia',
                'icon'    =>  'images/icons/tokopedia.png',
                'slug'    =>  'tokopedia'
            ],
        ]);
    }
}
