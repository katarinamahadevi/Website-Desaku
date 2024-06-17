function modal_berita(id) {
    $.ajax({
        url: BASE_URL + 'user_function/get_single_berita',
        method: 'POST',
        data: { id: id },
        cache : false,
        success: function (msg) {
            $('#display_detail_berita').html(msg)
        }
    });
}

function modal_tiket(id,offcanvas = false,idc,action) {
    if (offcanvas == true) {
         $('#'+idc).offcanvas(action);
    }
    $.ajax({
        url: BASE_URL + 'user_function/get_single_tiket',
        method: 'POST',
        data: { id: id },
        cache : false,
        success: function (msg) {
            $('#display_detail_ticket').html(msg)
        }
    });
}

function modal_pesan(id) {
    $('#modalDetailTiket').modal('hide');
    $.ajax({
        url: BASE_URL + 'user_function/pesiapan_order',
        method: 'POST',
        data: { id: id },
        cache : false,
        success: function (msg) {
            $('#display_order').html(msg)
        }
    });
}


function get_harga(element) {
    var harga = $(element).find(':selected').data('harga');
    var tiket = $(element).find(':selected').data('tiket');
    $('#display_price').val(harga);
    $('#display_tiket').val(tiket);

    var value = $('#nama_pengunjung').val();
    var select = $(element).val()
    if (value && select) {
        $('#btn_tambah_pengunjung').attr('disabled', false);
    }else{
        $('#btn_tambah_pengunjung').attr('disabled', true);
    }
}


function tambah_pengunjung(element) {
    var child = $('#parent_pengunjung').children('div').length
    var nama_pengunjung = $('#nama_pengunjung').val();
    child = child + 1;
    var total_harga = $('#total_harga').val();
    var tiket = $('#display_tiket').val();
    var harga = $('#display_price').val();
    total_harga = Number(total_harga) + Number(harga);
    $('#total_harga').val(total_harga);
    var id_tiket = $('#select_id_tiket').val();
    var nama_pengunjung = $('#nama_pengunjung').val();
    $('#parent_pengunjung').append('<div id="tiket_'+child+'" class="card mb-3 me-2" style="width: 18rem; border-radius: 10px;">\
                    <div class="card-header bg-transparent d-flex justify-content-between align-items-center border-0 my-0 mx-0">\
                        <p class="mb-0 fst-italic">Pengunjung '+tiket+'</p>\
                        <button type="button" onclick="hapus_row('+child+','+harga+')" class="btn btn-sm btn-danger">Hapus</button>\
                    </div>\
                    <input type="hidden" name="pengunjung[]" value="'+nama_pengunjung+'">\
                    <input type="hidden" name="id_tiket[]" value="'+id_tiket+'">\
                    <div class="card-body p-2">\
                        <ol class="list-group">\
                            <li class="list-group-item d-flex justify-content-between align-items-start border-0">\
                                <div class="ms-2 me-auto">\
                                <div class="fw-bold">Rp. '+format_uang(harga.toString())+'</div>\
                                    '+nama_pengunjung+'\
                                </div>\
                            </li>\
                        </ol>\
                    </div>\
                </div>');
    $('#display_form_pengunjung').removeClass('col-xl-12');
    $('#display_form_pengunjung').addClass('col-xl-7');
    $('#display_pengunjung').removeClass('hidin');
    $('#display_pengunjung').addClass('showin');

    $(element).attr('disabled',true);
    $('#form_indi input.hapus').val('');
    $('#form_indi select.hapus').val('');
    $('#display_total').text('Rp. '+format_uang(total_harga.toString()));
}

function hapus_row(row, min_harga) {
    $('#tiket_'+row).remove();
    var total_harga = $('#total_harga').val();
    total_harga = Number(total_harga) - Number(min_harga);
    $('#display_total').text('Rp. '+format_uang(total_harga.toString()));
    $('#total_harga').val(total_harga);
}



function cek_button(element) {
    var value = $(element).val();
    var select = $('#display_price').val();

    if (value && select) {
        $('#btn_tambah_pengunjung').attr('disabled', false);
    }else{
        $('#btn_tambah_pengunjung').attr('disabled', true);
    }
}   


function off_canvas(id, action) {
    $('#'+id).offcanvas(action);
}

function set_fav(element) {
    var id = $(element).val();
    var action = '';
    if ($(element).is(':checked')) {
        $('.home-like-'+id).html('<i class="bx bxs-heart fs-3" style="color: #f52e4b;"></i>');
        action = 'Y';
    } else {
        $('.home-like-'+id).html('<i class="bx bx-heart fs-3" style="color: #757575;"></i>');
        action = 'N';
    }

    $.ajax({
        url: BASE_URL + 'user_function/set_fav',
        method: 'POST',
        data: { id: id ,action: action},
        cache : false,
        dataType : 'json',
        success: function (data) {
            $('#parent_favorit').load(BASE_URL+'beranda/ #reload_favorit');
        }
    });

}