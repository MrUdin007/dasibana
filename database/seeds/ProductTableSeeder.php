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
                'name'          =>  'dasi',
                'category_id'   =>  '001',
                'status'        =>  '',
                'foto'          =>  '',
                'slug'          =>  'admin1'
            ],
            [
                'name'          =>  'celana',
                'category_id'   =>  '002',
                'status'        =>  '',
                'foto'          =>  '',
                'slug'          =>  'admin2'
            ],
            [
                'name'          =>  'sarung',
                'category_id'   =>  '003',
                'status'        =>  '',
                'foto'          =>  '',
                'slug'          =>  'admin3'
            ]
        ]);
    }
}
