<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminTableSeeder::class,
            SosmedTableSeeder::class,
            ProdukTableSeeder::class,
            KontakTableSeeder::class,
            ProdukKategoriTableSeeder::class
        ]);
    }
}
