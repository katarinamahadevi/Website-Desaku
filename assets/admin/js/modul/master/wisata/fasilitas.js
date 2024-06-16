
$(function () {

    $('.hps_icon').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_icon]').val("");
    });

});


function edit_fasilitas(element, id) {
    
    var icon = $(element).data('image');
    var form = document.getElementById('form_fasilitas');
    $('#title_modal').text('Ubah Data Fasilitas');
    form.setAttribute('action', BASE_URL + 'wisata_function/ubah_fasilitas');
    $.ajax({
        url: BASE_URL + 'wisata/get_single_fasilitas',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (data) {
            var reason = '';
            if (data.fasilitas.block_reason) {
                reason = '</br>Alasan : ' + data.fasilitas.block_reason;
            }
            if (data.fasilitas.status == 'N') {
                $('#lead').html('<div class="alert alert-danger d-flex justify-content-between" role="alert"><div class="col-6">\
                    fasilitas telah di block!'+ reason + '</div><div class="col-6 d-flex justify-content-end"><div class="form-check form-switch">\
                    <input class="form-check-input cursor-pointer" type="checkbox" role="switch" onchange ="switch_block(this,event,'+ id + ',true)" id="switch-on-' + id + '" checked ></div></div>\
                        </div>');
            } else {
                $('#lead').html('');
            }
            $('input[name="id_fasilitas"]').val(data.fasilitas.id_fasilitas);
            console.log(data.fasilitas.id_fasilitas);
            $('input[name="nama"]').val(data.fasilitas.nama);
            $('input[name="nama_icon"]').val(data.fasilitas.icon);
            $('select[name="id_jabatan"]').val(data.fasilitas.id_jabatan);
            $('select[name="id_jabatan"]').trigger('change');
        }
    })
}

function tambah_fasilitas() {
    var form = document.getElementById('form_fasilitas');
    form.setAttribute('action', BASE_URL + 'wisata_function/tambah_fasilitas');
    $('#title_modal').text('Tambah Fasilitas');
    $('#form_fasilitas input').val('');
    $('#form_fasilitas select').val('');
    $('#form_fasilitas select').trigger('change');
}


function switch_block(element, e, id, two = false) {
    // console.log(two);

    e.preventDefault();
    const icon = 'question';
    if ($(element).is(':checked')) {
        var value = 'Y';
        var type = false;
        var message = 'Anda yakin akan membuka blockir pada fasilitas ini? Selanjutnya fasilitas akan bisa mengakses sistem';
    } else {
        var value = 'N';
        var type = "textarea";
        var message = 'Anda yakin akan melakukan blockir pada fasilitas ini? fasilitas tidak akan bisa mengakses sistem';
        
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
                url: BASE_URL + 'wisata_function/block_fasilitas/fasilitas',
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