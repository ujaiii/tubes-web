@extends('layouts.app')

@section('content')
    <div class="container">

<!------------------------------------ Bagian Header ------------------------------------>
        <div class="ongkir-header">
            <h1>CodeOngkir</h1>
            <p class="lead">
                Project Cek Ongkir ke Seluruh Koda dan Kabupaten di Indonesia
            </p>
        </div>

<!-------------------- Bagian Pilihan Layanan (Free, Pro, Enterprise) ------------------->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100 text-center">
                    <div class="
            card-header">
                        <h4 class="my-0 font-weight-normal text-center">Free</h4>
                    </div>
                    <div class="card-body">
                        <i class="fas fa-truck" style="font-size:80px"></i>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Cek Ongkir Lebih Mudah</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
                    </div>
                </div>
            </div>

<!------------------------------------- Layanan Pro ------------------------------------->
            <div class="col">
                <div class="card h-100 text-center">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal text-center">Pro</h4>
                    </div>
                    <div class="card-body">
                        <i class="fas fa-box" style="font-size:80px"></i>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Lacak lokasi paket</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
                    </div>
                </div>
            </div>

<!--------------------------------- Layanan Enterprise ----------------------------------->
            <div class="col">
                <div class="card h-100 text-center">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal text-center">Enterprise</h4>
                    </div>
                    <div class="card-body">
                        <i class="fas fa-plane-departure" style="font-size:80px"></i>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Cek Ongkir Pengiriman Internasional</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
                    </div>
                </div>
            </div>
        </div>

<!-------------------------- Bagian Formulir Cek Ongkir ----------------------------------->
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Formulir Cek Ongkir</h4>
            </div>
            <div class="card-body">

                <!-- Formulir untuk mengirim data -->
                <form action="{{ route('store') }}" method="POST">

                    <!-- Menambahkan token CSRF untuk keamanan formulir -->
                    @csrf

                    <!-- Baris formulir yang dibagi menjadi dua kolom -->
                    <div class="form-row">

                        <!-- Kolom pertama -->
                        <div class="col">

                            <!-- Bagian Asal Pengirim -->
                            <h5 class="text-muted">Asal Pengirim:</h5>

                            <!-- Pilihan Provinsi Asal -->
                            <div class="form-group">
                                <label for="">Provinsi</label>
                                <select name="origin_province" id="" class="form-control">
                                    <option value="#">-</option>

                                    <!-- Menampilkan daftar provinsi dari variabel $province -->
                                    @foreach ($province as $code => $title)
                                        <option value="{{ $code }}">{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilihan Kota/Kabupaten Asal -->
                            <div class="form-group">
                                <label for="">Kota/Kabupaten</label>
                                <select name="origin_city" id="" class="form-control">
                                    <option value="#">-</option>
                                </select>
                            </div>

                            <!-- Bagian Tujuan Pengirim -->
                            <h5 class="text-muted">Tujuan Pengirim:</h5>

                            <!-- Pilihan Kota/Kabupaten Tujuan -->
                            <div class="form-group">

                                <!-- Menampilkan daftar kota dari variabel $cities -->
                                <label for="">Kota/Kabupaten</label>
                                <select name="destination_city" id="destination_city" class="form-control">
                                    <option value="#">-</option>
                                    @foreach ($cities as $code => $title)
                                        <option value="{{ $code }}">{{ $title }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <!-- Kolom kedua -->
                        <div class="col">

                            <!-- Bagian Pilih Expedisi -->
                            <h5 class="text-muted">Pilih Expedisi:</h5>

                            <!-- Pilihan Kurir -->
                            @foreach ($couriers as $key => $value)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="couriers-{{ $key }}"
                                        name="couriers[]" value="{{ $value->code }}">
                                    <label class="form-check-label"
                                        for="couriers-{{ $key }}">{{ $value->title }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="form-row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection