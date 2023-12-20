<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

// Menggunakan tiga trait yang disediakan oleh Laravel.
// Trait-trait ini menyediakan fungsi tambahan untuk kelas pengontrol.
// Trait AuthorizesRequests memberikan metode otorisasi untuk mengelola hak akses.
// Trait DispatchesJobs memberikan metode untuk mengelola pekerjaan (jobs), misalnya, dispatching job pada antrian.
// Trait ValidatesRequests memberikan metode untuk melakukan validasi permintaan HTTP.
    
