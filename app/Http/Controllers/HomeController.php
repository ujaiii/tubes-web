<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\Courier;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Membuat instance kontroler baru.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Menampilkan dashboard aplikasi.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mendapatkan daftar provinsi, kota, dan kurir.
        $province = $this->getProvince();
        $cities = $this->getCities(); 
        $couriers = $this->getCourier(); 

        // Mengembalikan tampilan 'home' dengan data yang diperoleh.
        return view('home', compact('province', 'cities', 'couriers'));
    }

    public function store(Request $request)
    {
        // Metode untuk menangani penyimpanan data dari formulir.
        // Dump and die: mencetak semua data permintaan untuk debugging.
        dd($request->all());
    }

    public function getCities()
    {
        // Mendapatkan daftar kota dalam format yang sesuai.
        // Mengembalikan daftar kota dalam bentuk Collection (title, code).
        return City::pluck('title', 'code');
    }

    public function getCourier()
    {
        // Mendapatkan semua data kurir.
        // Mengembalikan semua data kurir.
        return Courier::all();
    }

    public function getProvince()
    {
        // Mendapatkan daftar provinsi dalam format yang sesuai.
        // Mengembalikan daftar provinsi dalam bentuk Collection (title, code).
        return Province::pluck('title', 'code');
    }
}