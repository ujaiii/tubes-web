<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token untuk keamanan formulir -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        
        <!-- Judul halaman -->
        <title>Integrasi RajaOngkir dengan Laravel</title>

        <!-- Pautan ke stylesheet Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        
        <!-- Pautan ke stylesheet Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>

    <body>

        <!-- Konten utama -->
        <main class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <!-- Judul halaman -->
                        <h2 class="fs-5 py-4 text-center">
                            Integrasi RajaOngkir dengan Laravel
                        </h2>

                        <!-- Formulir Cek Ongkir -->
                        <div class="card border rounded shadow">
                            <div class="card-body">
                                <form id="form">

                                    <!-- Bagian Asal dan Tujuan -->
                                    <div class="row mb-3">
                                        <strong>Origin</strong>

                                        <!-- Dropdown Provinsi Asal -->
                                        <div class="col-md-6">
                                            <label for="origin_province" class="form-label">Province</label>
                                            <select name="origin_province" id="origin_province" class="form-select">
                                                <option>Choose Province</option>
                                            </select>
                                        </div>

                                        <!-- Dropdown Kota/Kabupaten Asal -->
                                        <div class="col-md-6">
                                            <label for="origin_city" class="form-label">City</label>
                                            <select name="origin_city" id="origin_city" class="form-select">
                                                <option>Choose City</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Dropdown Provinsi Tujuan -->
                                    <div class="row mb-3">
                                        <strong>Destination</strong>
                                        <div class="col-md-6">
                                            <label for="destination_province" class="form-label">Province</label>
                                            <select name="destination_province" id="destination_province" class="form-select">
                                                <option>Choose Province</option>
                                            </select>
                                        </div>

                                        <!-- Dropdown Kota/Kabupaten Tujuan -->
                                        <div class="col-md-6">
                                            <label for="destination_city" class="form-label">City</label>
                                            <select name="destination_city" id="destination_city" class="form-select">
                                                <option>Choose City</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Dropdown Pilihan Kurir -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="courier" class="form-label">Courier</label>
                                            <select name="courier" id="courier" class="form-select">
                                                <option>Choose Courier</option>
                                                <option value="jne">JNE</option>
                                                <option value="pos">POS</option>
                                                <option value="tiki">TIKI</option>
                                            </select>
                                        </div>

                                        <!-- Input Berat Paket -->
                                        <div class="col-md-6">
                                            <label for="weight" class="form-label">Weight (Gram)</label>
                                            <input type="number" name="weight" id="weight" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Tombol Cek Ongkir -->
                                    <div class="col-12">
                                        <button class="btn btn-primary" id="checkBtn">Check</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Hasil Cek Ongkir -->
                        <div id="result" class="mt-3 d-none"></div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Pautan ke script JavaScript -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
        <!-- Script JavaScript untuk meng-handle form dan AJAX -->
        <script>

            // Memastikan dokumen HTML telah selesai dimuat sebelum menjalankan skrip
            $(document).ready(function(){
                $('#origin_province, #destination_province').select2({
                    ajax: {

                        // Mengatur endpoint URL untuk mengambil data provinsi
                        url: "<?php echo e(route('provinces')); ?>",
                        type: 'GET',
                        dataType: 'json',
                        delay: 250,

                        // Mengirim parameter pencarian berdasarkan input pengguna
                        data: function(params){
                            return {
                                keyword: params.term
                            }
                        },

                        // Memproses hasil data provinsi untuk ditampilkan dalam dropdown
                        processResults: function(response){
                            return {
                                results: response
                            }
                        },
                    }
                });
            
                // Mengaktifkan Select2 untuk dropdown kota/kabupaten asal dan tujuan tanpa AJAX
                $('#origin_city, #destination_city').select2();
            
                // Meng-handle perubahan dropdown provinsi asal untuk meng-update dropdown kota asal
                $('#origin_province').on('change', function(){
                    $('#origin_city').empty();
                    $('#origin_city').append('<option>Choose City</option>');
                    $('#origin_city').select2('close');
                    
                    // Mengaktifkan Select2 untuk dropdown kota asal berdasarkan provinsi yang dipilih
                    $('#origin_city').select2({
                        ajax: {
                            url: "<?php echo e(route('cities')); ?>",
                            type: 'GET',
                            dataType: 'json',
                            delay: 250,

                            // Mengirim parameter pencarian dan ID provinsi
                            data: function(params){
                                return {
                                    keyword: params.term,
                                    province_id: $('#origin_province').val()
                                }
                            },
                            
                            // Memproses hasil data kota untuk ditampilkan dalam dropdown
                            processResults: function(response){
                                return {
                                    results: response
                                }
                            },
                        }
                    });
                });
            
                // Meng-handle perubahan dropdown provinsi tujuan untuk meng-update dropdown kota tujuan
                $('#destination_province').on('change', function(){
                    $('#destination_city').empty();
                    $('#destination_city').append('<option>Choose City</option>');
                    $('#destination_city').select2('close');
                    
                    // Mengaktifkan Select2 untuk dropdown kota tujuan berdasarkan provinsi yang dipilih
                    $('#destination_city').select2({
                        ajax: {
                            url: "<?php echo e(route('cities')); ?>",
                            type: 'GET',
                            dataType: 'json',
                            delay: 250,

                            // Mengirim parameter pencarian dan ID provinsi
                            data: function(params){
                                return {
                                    keyword: params.term,
                                    province_id: $('#destination_province').val()
                                }
                            },

                            // Memproses hasil data kota untuk ditampilkan dalam dropdown
                            processResults: function(response){
                                return {
                                    results: response
                                }
                            },
                        }
                    });
                });
            
                // Meng-handle klik tombol "Check" untuk melakukan pengiriman data melalui AJAX
                $('#checkBtn').on('click', function(e){
                    e.preventDefault();
                    let origin = $('#origin_city').val();
                    let destination = $('#destination_city').val();
                    let courier = $('#courier').val();
                    let weight = $('#weight').val();
                    
                    // Menggunakan AJAX untuk mengirim data ke endpoint check-ongkir
                    $.ajax({
                        url: "<?php echo e(route('check-ongkir')); ?>",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            origin: origin,
                            destination: destination,
                            courier: courier,
                            weight: weight
                        },
                        
                        // Sebelum pengiriman, mengubah tampilan tombol dan menonaktifkannya
                        beforeSend: function(){
                            $('#checkBtn').html('Loading...');
                            $('#checkBtn').attr('disabled', true);
                        },
                        
                        // Jika pengiriman berhasil, menampilkan hasil cek ongkir
                        success: function(response){
                            $('#result').removeClass('d-none');
                            $('#checkBtn').html('Submit');
                            $('#checkBtn').attr('disabled', false);
                            $('#result').empty();

                            // Menampilkan hasil cek ongkir dalam tabel
                            $('#result').append(`
                                <div class="col-12">
                                    <div class="card border rounded shadow">
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Service</th>
                                                        <th>Description</th>
                                                        <th>Cost</th>
                                                        <th>ETD</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="resultBody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            `);

                            // Menampilkan detail hasil cek ongkir dalam tabel
                            $.each(response, function(i, val){
                                $('#resultBody').append(`
                                    <tr>
                                        <td>${val.service}</td>
                                        <td>${val.description}</td>
                                        <td>${val.cost[0].value}</td>
                                        <td>${val.cost[0].etd}</td>
                                    </tr>
                                `);
                            });
                        },

                        // Jika terjadi kesalahan, menampilkan pesan error di konsol
                        error: function(xhr){
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    </body>
</html><?php /**PATH C:\Users\dinda\laravel\project\web\resources\views/welcome.blade.php ENDPATH**/ ?>