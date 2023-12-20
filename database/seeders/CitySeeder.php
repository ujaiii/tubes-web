<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{

    // Menjalankan seeder untuk menambahkan data kota ke database.

    public function run(): void
    {
        // Mengambil semua data provinsi.
        $provinces = Province::all();

        
        // Iterasi melalui setiap provinsi.
        foreach ($provinces as $province) {

            // Mengambil data kota dari API RajaOngkir berdasarkan provinsi.
            // Menggunakan HTTP client untuk mengambil data kota dari API RajaOngkir 
            // berdasarkan ID provinsi.
            $cities = Http::withOptions(['verify' => false,])->withHeaders([
                'key' => env('RAJAONGKIR_API_KEY')
            ])->get('https://api.rajaongkir.com/starter/city?province=' . $province->id)->json()['rajaongkir']['results'];

            // Array untuk menyimpan data kota yang akan disisipkan.
            $insert_city = [];

            // Iterasi melalui setiap kota dari API.
            foreach ($cities as $city) {

                // Menyiapkan data untuk setiap kota.
                $data = [
                    'province_id'   => $province->id,
                    'type'          => $city['type'],
                    'name'          => $city['type'] . ' ' . $city['city_name'],
                    'postal_code'   => $city['postal_code'],
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];

                // Menambahkan data kota ke dalam array untuk proses pengecekan berkelompok.
                $insert_city[] = $data;
            }

            // Mengubah array data kota menjadi koleksi.
            $insert_city = collect($insert_city);

            // Membagi data kota ke dalam kelompok berukuran 100 untuk menghindari batasan SQL.
            $city_chunks = $insert_city->chunk(100);

            // Iterasi melalui setiap kelompok data kota dan menyisipkannya ke dalam database.
            foreach ($city_chunks as $chunk) {
                City::insert($chunk->toArray());
            }
        }
    }
}