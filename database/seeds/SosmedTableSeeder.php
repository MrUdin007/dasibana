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
                'ikon'    =>  'images/icons/shopee.png',
                'status'  =>  true,
                'slug'    =>  'https://shopee.co.id/albana16'
            ],
            [
                'name'    =>  'dasibanaFacebook',
                'ikon'    =>  'images/icons/facebook.png',
                'status'  =>  true,
                'slug'    =>  'https://web.facebook.com/grosirsarungdansajadah'
            ],
            [
                'name'    =>  'dasibanaInstagram',
                'ikon'    =>  'images/icons/instagram.png',
                'status'  =>  true,
                'slug'    =>  'https://www.instagram.com/jogjadasibana/'
            ],
            [
                'name'    =>  'dasibanaTokopedia',
                'ikon'    =>  'images/icons/tokopedia.png',
                'status'  =>  true,
                'slug'    =>  'https://www.tokopedia.com/konveksibana'
            ],
        ]);
    }
}
