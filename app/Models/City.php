<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// BelongsTo adalah salah satu jenis relasi Eloquent yang digunakan 
// dalam model Eloquent di Laravel. Relasi ini menggambarkan 
// hubungan "belongs to" (milik satu)
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class City extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function province(): BelongsTo
{
    return $this->belongsTo(Province::class);
}
}

// Selanjutnya melakukan 'php artisan migrate:reset dan php artisan migrate:fresh --seed'
// reset maksudnya membatalkan (rollback) seluruh migrasi basis data yang telah dilakukan sebelumnya.
// Dan menghapus table data yang ada
// sedangkan fresh --seed artinya melakukan dua tindakan sekaligus, yaitu mereset dan 
// mengulang migrasi basis data dari awal, serta mengisi basis data dengan data seeder.
// Semua tabel dalam basis data akan dihapus.
// Selanjutnya, semua migrasi yang telah didefinisikan akan dijalankan kembali, membangun kembali struktur basis data.
// Opsi --seed akan menambahkan langkah pengisian data awal menggunakan seeder setelah proses migrasi selesai.
