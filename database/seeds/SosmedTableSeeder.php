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
                'slug'    =>  'https://shopee.co.id/albana16'
            ],
            [
                'name'    =>  'dasibanaFacebook',
                'icon'    =>  'images/icons/facebook.png',
                'slug'    =>  'https://web.facebook.com/grosirsarungdansajadah'
            ],
            [
                'name'    =>  'dasibanaInstagram',
                'icon'    =>  'images/icons/instagram.png',
                'slug'    =>  'https://www.instagram.com/jogjadasibana/'
            ],
            [
                'name'    =>  'dasibanaTokopedia',
                'icon'    =>  'images/icons/tokopedia.png',
                'slug'    =>  'https://www.tokopedia.com/konveksibana'
            ],
        ]);
    }
}
