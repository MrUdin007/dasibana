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
                'Nama_Sosmed'    =>  'dasibanaIG',
                'slug'           =>  'admin1'
            ],
            [
                'Nama_Sosmed'    =>  'dasibanaTwitter',
                'slug'           =>  'admin2'
            ],
            [
                'Nama_Sosmed'    =>  'dasibanaFB',
                'slug'           =>  'admin3'
            ],
        ]);
    }
}
