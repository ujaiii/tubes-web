<?php

namespace Database\Seeders;

// Mengimpor kelas Seeder yang diperlukan dari Laravel.
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Memanggil seeder untuk Province dan City.
        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
        ]);

        // Seeder bertanggung jawab untuk mengisi basis data 
        // dengan data awal yang dibutuhkan oleh aplikasi. 
        // Seeding biasanya melibatkan pengisian tabel database 
        // dengan data contoh untuk pengembangan dan pengujian.
    }
}