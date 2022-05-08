<?php

use Illuminate\Database\Seeder;

class ProdukTableSeeder extends Seeder
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
                'nama'          =>  'dasi',
                'id_kategori'   =>  '001',
                'status'        =>  '',
                'foto'          =>  '',
                'slug'          =>  'admin1'
            ],
            [
                'nama'          =>  'celana',
                'id_kategori'   =>  '002',
                'status'        =>  '',
                'foto'          =>  '',
                'slug'          =>  'admin2'
            ],
            [
                'nama'          =>  'sarung',
                'id_kategori'   =>  '003',
                'status'        =>  '',
                'foto'          =>  '',
                'slug'          =>  'admin3'
            ]
        ]);
    }
}
