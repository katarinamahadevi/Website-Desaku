var mydeskripsi;
    
    ClassicEditor.create( document.querySelector( '#deskripsi' ), {
        toolbar: {
			items: ["heading", "|","fontColor", "bold", "italic", "bulletedList", "numberedList", "alignment", "|", "outdent", "indent", "|", "blockQuote", "insertTable", "mediaEmbed","htmlEmbed", "undo", "redo"]
		},
		table: {
			contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"]
		},
		language: "en",
        licenseKey: ''
        
        
    } )
    .then( editor => {
        //window.editor = editor;
        mydeskripsi = editor;
    } )
    .catch( error => {
        console.error( 'Oops, something went wrong!' );
        console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
        console.warn( 'Build id: vd7qnogyyu6n-nohdljl880ze' );
        console.error( error );
    } );
var image = document.getElementById('display_gambar');
$(function () {

    $('.hps_gambar').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_gambar]').val("");
    });

});


function edit_wisata(element, id) {
    
    var gambar = $(element).data('image');
    var form = document.getElementById('form_wisata');
    $('#title_modal').text('Ubah Data Wisata');
    form.setAttribute('action', BASE_URL + 'wisata_function/ubah_wisata');
    $.ajax({
        url: BASE_URL + 'wisata/get_single_wisata',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (data) {
            image.style.backgroundImage = "url('" + gambar + "')";
            var reason = '';
            if (data.wisata.block_reason) {
                reason = '</br>Alasan : ' + data.wisata.block_reason;
            }
            if (data.wisata.status == 'N') {
                $('#lead').html('<div class="alert alert-danger d-flex justify-content-between" role="alert"><div class="col-6">\
                    wisata telah di block!'+ reason + '</div><div class="col-6 d-flex justify-content-end"><div class="form-check form-switch">\
                    <input class="form-check-input cursor-pointer" type="checkbox" role="switch" onchange ="switch_block(this,event,'+ id + ',true)" id="switch-on-' + id + '" checked ></div></div>\
                        </div>');
            } else {
                $('#lead').html('');
            }
            $('input[name="id_wisata"]').val(data.wisata.id_wisata);
            $('input[name="nama"]').val(data.wisata.nama);
            $('input[name="nama_gambar"]').val(data.wisata.gambar);
            $('textarea[name="alamat"]').val(data.wisata.alamat);
            $('#select_tiket').val(data.tiket);
            $('#select_tiket').trigger('change');
            $('#select_fasilitas').val(data.fasilitas);
            $('#select_fasilitas').trigger('change');
            if (data.wisata.deskripsi) {
                mydeskripsi.setData(data.wisata.deskripsi);
            }
        }
    })
}

function tambah_wisata() {
    var form = document.getElementById('form_wisata');
    form.setAttribute('action', BASE_URL + 'wisata_function/tambah_wisata');
    $('#title_modal').text('Tambah Wisata');
    $('#form_wisata input').val('');
    $('#form_wisata select').val('');
    $('#form_wisata select').trigger('change');
    image.style.backgroundImage = "url('" + image_default + "')";
}


function switch_block(element, e, id, two = false) {
    // console.log(two);

    e.preventDefault();
    const gambar = 'question';
    if ($(element).is(':checked')) {
        var value = 'Y';
        var type = false;
        var message = 'Anda yakin akan membuka blockir pada wisata ini? Selanjutnya wisata akan bisa mengakses sistem';
    } else {
        var value = 'N';
        var type = "textarea";
        var message = 'Anda yakin akan melakukan blockir pada wisata ini? wisata tidak akan bisa mengakses sistem';
        
    }
    Swal.fire({
        text: message,
        gambar: gambar,
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
                url: BASE_URL + 'wisata_function/block_wisata/wisata',
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
                                gambar: data.alert.gambar,
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
                            gambar: data.alert.gambar,
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