<?php

// Memberitahu PHP di mana file ini berada dalam struktur direktori proyek.
namespace App\Models;

// Pada Laravel, HasFactory adalah trait yang disediakan oleh framework untuk model Eloquent.
// Eloquent adalah ORM (Object-Relational Mapping) yang digunakan dalam Laravel 
// untuk berinteraksi dengan basis data menggunakan objek PHP.
// Factory pada Laravel adalah cara untuk mendefinisikan blueprint (kerangka dasar) data model 
// untuk keperluan pengujian atau penyuntikan data awal ke basis data.
// Pada kasus model Eloquent, factory dapat digunakan untuk membuat instance model 
// dengan data palsu yang sesuai dengan struktur basis data.
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Ini mengimpor kelas Model dari namespace Illuminate\Database\Eloquent. 
use Illuminate\Database\Eloquent\Model;

// Ini mengimpor kelas HasMany dari namespace Illuminate\Database\Eloquent\Relations. 
// Kelas HasMany adalah bagian dari sistem relasi Eloquent ORM 
// dan digunakan untuk mendefinisikan hubungan "one-to-many" antara dua model. 
// Dalam konteks Province model yang telah disediakan sebelumnya, 
// ini digunakan untuk mendefinisikan relasi bahwa satu provinsi dapat memiliki banyak kota.
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    // Menggunakan trait HasFactory untuk memudahkan pembuatan data dengan factory.
    use HasFactory;

    // Mendefinisikan atribut yang dapat diisi secara massal (guarded)
    // Tanpa menyebut setiap kolomnya
    protected $guarded = [];

    // Mendefinisikan relasi "hasMany" dengan model City.
    public function cities(): HasMany
    {
        // Mengembalikan relasi "HasMany" dengan model City, 
        // dimana setiap provinsi memiliki banyak kota.
        return $this->hasMany(City::class);
    }
}
