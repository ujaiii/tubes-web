<?php

// Memberitahu PHP di mana file ini berada dalam struktur direktori proyek.
namespace Database\Seeders;

// Mengimpor model Province yang terletak di namespace App\Models. 
// Ini dibutuhkan agar kita dapat menggunakan model Province untuk berinteraksi 
// dengan tabel provinsi dalam database.
use App\Models\Province;

// Mengimpor kelas Seeder dari Laravel. 
// Seeder adalah kelas dasar yang digunakan untuk menentukan logika untuk 
// mengisi data ke dalam tabel database pada saat pembuatan database awal 
// atau melalui proses seeding.
use Illuminate\Database\Seeder;

// Mengimpor fasad HTTP dari Laravel. 
// Fasad ini menyediakan antarmuka untuk melakukan HTTP requests. 
// Dalam konteks ini, kita menggunakannya untuk melakukan HTTP request 
// ke API RajaOngkir dan mengambil data provinsinya.
use Illuminate\Support\Facades\Http;

// Kelas ini digunakan untuk menonaktifkan model events ketika seeder dijalankan. 
// Model events adalah event yang terkait dengan model, seperti creating, created, 
// updating, dan sebagainya. Dengan menonaktifkan model events, kita dapat 
// mengisi tabel tanpa memicu event-event tersebut, 
// yang dapat meningkatkan kinerja saat proses seeding.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    // Menjalankan seeder untuk mengisi data provinsi.
    // metode bernama run yang dapat diakses dari luar kelas, 
    // dan metode ini tidak mengembalikan nilai (void).
    public function run(): void
    {
        // Mengambil daftar provinsi dari API RajaOngkir menggunakan HTTP request.
        // Sebagai catatan, penggunaan 'verify' => false pada opsi HTTP 
        // digunakan untuk menonaktifkan verifikasi SSL pada saat pengambilan data dari API
        $provinces = Http::withOptions(['verify' => false,])->withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get('https://api.rajaongkir.com/starter/province')->json()['rajaongkir']['results'];

        // Melakukan iterasi untuk setiap provinsi yang diperoleh.
        foreach ($provinces as $province) {
            // Membuat entri baru di tabel 'provinces' menggunakan model Province.
            Province::create([

                // Menyimpan nama provinsi.
                'name'        => $province['province'],

                // Menyimpan waktu pembuatan entri.
                'created_at'  => now(),

                // Menyimpan waktu pembaruan terakhir.
                'updated_at'  => now(),
            ]);
        }
    }
}