var image = document.getElementById('display_gambar');
$(function () {

    $('.hps_gambar').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_gambar]').val("");
    });

});


function edit_pengurus(element, id) {
    
    var gambar = $(element).data('image');
    var form = document.getElementById('form_pengurus');
    $('#title_modal').text('Ubah Data Pengurus');
    form.setAttribute('action', BASE_URL + 'pengurus_function/ubah_pengurus');
    $.ajax({
        url: BASE_URL + 'pengurus/get_single_pengurus',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (data) {
            image.style.backgroundImage = "url('" + gambar + "')";
            var reason = '';
            if (data.pengurus.block_reason) {
                reason = '</br>Alasan : ' + data.pengurus.block_reason;
            }
            if (data.pengurus.block == 'Y') {
                $('#lead').html('<div class="alert alert-danger d-flex justify-content-between" role="alert"><div class="col-6">\
                    pengurus telah di block!'+ reason + '</div><div class="col-6 d-flex justify-content-end"><div class="form-check form-switch">\
                    <input class="form-check-input cursor-pointer" type="checkbox" role="switch" onchange ="switch_block(this,event,'+ id + ',true)" id="switch-on-' + id + '" checked ></div></div>\
                        </div>');
            } else {
                $('#lead').html('');
            }
            $('input[name="id_pengurus"]').val(data.pengurus.id_pengurus);
            console.log(data.pengurus.id_pengurus);
            $('input[name="nama"]').val(data.pengurus.nama);
            $('input[name="nama_gambar"]').val(data.pengurus.gambar);
            $('select[name="id_jabatan"]').val(data.pengurus.id_jabatan);
            $('select[name="id_jabatan"]').trigger('change');
        }
    })
}

function tambah_pengurus() {
    var form = document.getElementById('form_pengurus');
    form.setAttribute('action', BASE_URL + 'pengurus_function/tambah_pengurus');
    $('#title_modal').text('Tambah Pengurus');
    $('#form_pengurus input').val('');
    $('#form_pengurus select').val('');
    $('#form_pengurus select').trigger('change');
    image.style.backgroundImage = "url('" + image_default + "')";
}


function switch_block(element, e, id, two = false) {
    // console.log(two);

    e.preventDefault();
    const icon = 'question';
    if ($(element).is(':checked')) {
        var value = 'Y';
        var type = false;
        var message = 'Anda yakin akan membuka blockir pada pengurus ini? Selanjutnya pengurus akan bisa mengakses sistem';
    } else {
        var value = 'N';
        var type = "textarea";
        var message = 'Anda yakin akan melakukan blockir pada pengurus ini? pengurus tidak akan bisa mengakses sistem';
        
    }
    Swal.fire({
        text: message,
        icon: icon,
        input: type,
        inputAttributes: {
            autocapitalize: 'off',
            name: 'block_reason'
        },
        inputPlaceholder: 'Cantumkan alasan blockir',
        showCancelButton: true,
        buttonsStyling: !1,
        confirmButtonText: "Lanjutkan",
        customClass: {
            confirmButton: css_btn_confirm,
            cancelButton: css_btn_cancel
        },
        reverseButtons: true
    }).then((function (t) {
        if (t.isConfirmed) {
            var reason = $('textarea[name=block_reason]').val();
            $.ajax({
                url: BASE_URL + 'pengurus_function/block_pengurus/pengurus',
                method: 'POST',
                data: { id: id, action: value, reason: reason },
                cache: false,
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    if (data.status == 200 || data.status == true) {

                        if (value == 'Y') {
                            $('#switch-' + id).prop('checked', true);
                        } else {
                            $('#switch-' + id).prop('checked', false);
                        }
                        if (two == true) {
                            if (value == 'Y') {
                                $('#switch-on-' + id).prop('checked', true);
                            } else {
                                $('#lead').html('');
                                $('#switch-on-' + id).prop('checked', false);
                            }
                        }

                        if (data.alert) {
                            Swal.fire({
                                html: data.alert.message,
                                icon: data.alert.icon,
                                buttonsStyling: !1,
                                confirmButtonText: 'Ok',
                                customClass: { confirmButton: css_btn_confirm }
                            });
                        }
                    } else {

                        if (value == 'Y') {
                            $('#switch-' + id).prop('checked', true);
                        } else {
                            $('#switch-' + id).prop('checked', false);
                        }
                        if (two == true) {
                            if (value == 'Y') {
                                $('#switch-on-' + id).prop('checked', true);
                            } else {
                                $('#lead').html('');
                                $('#switch-on-' + id).prop('checked', false);
                            }
                        }
                        Swal.fire({
                            html: data.alert.message,
                            icon: data.alert.icon,
                            buttonsStyling: !1,
                            confirmButtonText: 'Ok',
                            customClass: { confirmButton: css_btn_confirm }
                        });
                    }
                }
            })
        } else {

            if (value == 'Y') {
                $('#switch-' + id).prop('checked', false);
            } else {
                $('#switch-' + id).prop('checked', true);
            }
            if (two == true) {
                if (value == 'Y') {
                    $('#lead').html('');
                    $('#switch-' + id).prop('checked', false);
                } else {
                    $('#switch-' + id).prop('checked', true);
                }
            }

        }
    }));

}