<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    // Menjalankan migrasi untuk membuat tabel 'cities'.
    public function up(): void
    {

        // Membuat tabel 'cities' dengan menggunakan Blueprint.
        Schema::create('cities', function (Blueprint $table) {

            // Kolom id sebagai primary key.
            $table->id();

            // Kolom foreign key untuk menghubungkan dengan tabel 'provinces'.
            $table->foreignId('province_id');

            // Kolom untuk tipe kota (misalnya: kota, kabupaten)
            $table->string('type');

             // Kolom untuk nama kota.
            $table->string('name');

            // Kolom untuk kode pos.
            $table->string('postal_code');

            // Timestamps untuk melacak waktu pembuatan dan pembaruan.
            $table->timestamps();
        });
    }

    // Membatalkan migrasi dengan menghapus tabel 'cities'.
    public function down()
    {
        // Menghapus tabel 'cities' jika ada.
        Schema::dropIfExists('cities');
    }
};