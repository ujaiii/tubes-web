<?php

// Menggunakan controller check ongkir
use App\Http\Controllers\CheckOngkirController;

// Menyediakan metode untuk mendifinisikan rute dalam aplikasi laravel
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ini adalah definisi rute untuk URL root atau /. 
// Saat diakses, rute ini akan memanggil fungsi penutup (closure) 
// yang mengembalikan tampilan welcome.blade.php.
Route::get('/', function () {
    return view('welcome');
});

// Ini adalah definisi rute untuk URL /provinces. Saat diakses dengan metode HTTP GET, 
// rute ini akan memanggil metode province dari controller CheckOngkirController. 
// Nama rute disetel sebagai 'provinces'.
Route::get('provinces', [CheckOngkirController::class, 'province'])->name('provinces');

// Ini adalah definisi rute untuk URL /cities. Saat diakses dengan metode HTTP GET, 
// rute ini akan memanggil metode city dari controller CheckOngkirController. 
// Nama rute disetel sebagai 'cities'.
Route::get('cities', [CheckOngkirController::class, 'city'])->name('cities');

// Ini adalah definisi rute untuk URL /check-ongkir. Saat diakses dengan metode HTTP POST, 
// rute ini akan memanggil metode checkOngkir dari controller CheckOngkirController. 
// Nama rute disetel sebagai 'check-ongkir'.
Route::post('check-ongkir', [CheckOngkirController::class, 'checkOngkir'])->name('check-ongkir');