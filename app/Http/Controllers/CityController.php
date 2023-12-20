<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function getCities($province_id)
    {
        $cities = City::where('province_code', $province_id)->pluck('title', 'code');

        return response()->json($cities);
    }
}

// Mengembalikan daftar kota berdasarkan kode provinsi.
// Menggunakan model City untuk mengambil data kota berdasarkan kode provinsi.
// Data yang diambil hanya kolom 'title' dan 'code', kemudian disusun menjadi array.
// Mengembalikan data kota dalam format JSON sebagai respons.
        

