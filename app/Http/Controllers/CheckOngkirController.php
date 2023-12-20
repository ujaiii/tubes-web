<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckOngkirController extends Controller
{

    // Mendapatkan daftar provinsi berdasarkan kata kunci
    // Mengambil parameter dari metode request
    // Nanti akan mengembalikan objek berupa JsonRespon
    public function province(Request $request){

        // Ini adalah blok try-catch untuk menangani pengecualian (exceptions) 
        // yang mungkin terjadi selama eksekusi fungsi. Jika ada pengecualian, 
        // kode dalam blok catch akan dieksekusi.
        try {
            
            // Ini adalah bagian utama yang melakukan pencarian provinsi berdasarkan kata kunci 
            // menggunakan model Province. Metode get() mengembalikan kumpulan objek provinsi.
            $provinces = Province::where('name', 'like', '%'.$request->keyword.'%')->select('id', 'name')->get();
            
            // Membuat array kosong yang akan digunakan untuk menyimpan data provinsi dalam format yang sesuai.
            $data = [];

            // Looping melalui setiap objek provinsi dalam hasil pencarian untuk mengonversinya ke dalam format yang diinginkan.
            foreach ($provinces as $province) {

                //  Menambahkan setiap objek provinsi ke dalam array $data dengan format yang diinginkan.
                $data[] = [
                    'id'    => $province->id,
                    'text'  => $province->name
                ];
            }

            // Mengembalikan hasil dalam format JSON.
            return response()->json($data);

        } catch (\Throwable $th) {
            // Jika terjadi pengecualian (kesalahan), fungsi ini akan mengembalikan respons JSON yang 
            // memberikan informasi bahwa pengambilan data gagal dengan memberikan pesan kesalahan.
            return response()->json([
                'success' => false,
                'message' => 'Data Fetch Failed',
                'data'    => []
            ]);
        }
    }

    public function city(Request $request){
        try {
            $cities = Province::find($request->province_id)->cities()
                        ->where('name', 'like', '%'.$request->keyword.'%')            
                        ->select('id', 'name')->get();

            $data = [];
            foreach ($cities as $city) {
                $data[] = [
                    'id'    => $city->id,
                    'text'  => $city->name
                ];
            }

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Data Fetch Failed',
                'data'    => []
            ]);
        }
    }

    // Memeriksa ongkir pengiriman berdasarkan origin, destination, berat, dan kurir.
    public function checkOngkir(Request $request){

        try {
            // Mengirim permintaan HTTP ke API RajaOngkir untuk memeriksa ongkir.
            // Ini adalah bagian utama metode yang mengirim permintaan HTTP ke 
            // API RajaOngkir untuk memeriksa ongkir berdasarkan data yang diberikan 
            // dalam objek $request. Opsi ['verify' => false] digunakan untuk menonaktifkan verifikasi SSL. 
            // Data hasil JSON dari API diambil dan disimpan dalam variabel $response.
            $response = Http::withOptions(['verify' => false,])->withHeaders([
                'key' => env('RAJAONGKIR_API_KEY')
            ])->post('https://api.rajaongkir.com/starter/cost',[
                'origin'        => $request->origin,
                'destination'   => $request->destination,
                'weight'        => $request->weight,
                'courier'       => $request->courier
            ])
            ->json()['rajaongkir']['results'][0]['costs'];

            // Mengembalikan hasil periksa ongkir dalam format JSON.
            return response()->json($response);
        } catch (\Throwable $th) {
            // Mengembalikan respons JSON jika terjadi kesalahan.
        return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'data'    => []
            ]);
        }
    }
}
