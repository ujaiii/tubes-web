<?php

// Mengimpor kelas-kelas yang diperlukan dari Laravel.
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Mendefinisikan migrasi baru sebagai kelas anonim yang mewarisi dari Migration.
return new class extends Migration
{
    
    // Menjalankan migrasi (up) yang tidak akan mengembalikan nilai
    // Pada dasarnya, ini adalah metode yang akan dijalankan ketika migrasi diterapkan. 
    // Dalam kasus ini, di dalam blok metode up, terdapat logika untuk membuat atau 
    // mengubah struktur database sesuai dengan kebutuhan migrasi yang didefinisikan. 
    // Metode ini menciptakan atau memperbarui tabel, kolom, atau indeks dalam database.
    public function up(): void
    {
        // Membuat tabel 'provinces' menggunakan Schema Builder.
        Schema::create('provinces', function (Blueprint $table) {
        // Parameter $table yang ada di dalam penutupan adalah instance dari kelas Blueprint.
        // Blueprint menyediakan antarmuka untuk mendefinisikan struktur tabel.

            // Menambahkan kolom 'id' sebagai primary key
            $table->id();

            // Menambahkan kolom 'name' sebagai kolom string.
            $table->string('name');

            $table->timestamps();
            // Fungsi $table->timestamps() menambahkan dua kolom, 
            // 'created_at' dan 'updated_at', yang digunakan oleh Laravel 
            // untuk mencatat waktu pembuatan dan waktu pembaruan 
            // (ketika suatu rekaman dibuat atau diperbarui).
        });
    }

    // Membatalkan migrasi (down). 
    // Metode ini akan dijalankan saat migrasi dibatalkan (down). 
    public function down()
    {
        // Menghapus tabel 'provinces' jika sudah ada.
        Schema::dropIfExists('provinces');
    }
};