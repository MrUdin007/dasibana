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
                'name'    =>  'dasibanaIG',
                'slug'    =>  'admin1'
            ],
            [
                'name'    =>  'dasibanaTwitter',
                'slug'    =>  'admin2'
            ],
            [
                'name'    =>  'dasibanaFB',
                'slug'    =>  'admin3'
            ],
        ]);
    }
}
