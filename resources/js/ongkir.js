$(document).ready(function () {
    // Mengamati perubahan pada pilihan provinsi asal
    $('select[name="origin_province"]').on('change', function () {
        var provinceId = $(this).val();

        if (provinceId) {
            // Jika provinsi dipilih, lakukan permintaan AJAX
            $.ajax({
                // URL untuk mendapatkan kota berdasarkan provinsi
                url: '/get-cities/' + provinceId, type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Setelah mendapatkan data, kosongkan pilihan kota asal
                    $('select[name="origin_city"]').empty();
                    // Iterasi melalui data dan tambahkan pilihan kota asal
                    $.each(data, function (key, value) {
                        $('select[name="origin_city"]').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            // jika provinsi tidak dipilih, kosongkan pilihan kota asal
            $('select[name="origin_city"]').empty();
        }
    });
});

$(document).ready(function(){
     // Menginisialisasi Select2 pada pilihan kota tujuan
    $('#destination_city').select2();
});