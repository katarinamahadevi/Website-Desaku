$("#waktu").flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
});
var mydeskripsi;

ClassicEditor.create( document.querySelector( '#deskripsi' ), {
    toolbar: {
        items: ["heading","source", "|", "bold", "italic", "bulletedList", "numberedList", "|", "outdent", "indent", "|", "blockQuote", "insertTable", "mediaEmbed","htmlEmbed", "undo", "redo"]
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
$(function () {

    $('.hps_foto').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_gambar]').val("");
    });

});

const parser = new DOMParser();


function edit_proyek(element, id) {
    var image = document.getElementById('display_foto');
    var form = document.getElementById('form_proyek');
    $('#title_modal').text('Ubah Data Proyek');
    form.setAttribute('action', BASE_URL + 'master_function/ubah_proyek');
    var foto = $(element).data('image');
    $.ajax({
        url: BASE_URL + 'master/get_single_proyek',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            mydeskripsi.setData('');
            image.style.backgroundImage = "url('" + foto + "')";
            $('input[name="id_investasi"]').val(data.id_investasi);
            $('input[name="nama"]').val(data.nama);
            $('input#display_skala_proyek').val(format_uang(data.skala_proyek));
            $('input[name="skala_proyek"]').val(data.skala_proyek);
            $('input#display_min_investasi').val(format_uang(data.min_investasi));
            $('input[name="min_investasi"]').val(data.min_investasi);
            $('input[name="profit"]').val(data.profit);
            $('input[name="waktu"]').val(data.waktu);
            $('input[name="durasi"]').val(data.durasi);
            
            if (data.deskripsi) {
                mydeskripsi.setData(data.deskripsi);
            }
            
            $('input[name="nama_gambar"]').val(data.gambar);
        }
    })
}

function tambah_proyek() {
    var image = document.getElementById('display_foto');
    var base_foto = BASE_URL + 'data/default/notfound.jpg';
    var form = document.getElementById('form_proyek');
    form.setAttribute('action', BASE_URL + 'master_function/tambah_proyek');
    $('#title_modal').text('Tambah Proyek');
    image.style.backgroundImage = "url('" + base_foto + "')";
    $('#form_proyek input').val('');
    $('#form_proyek select').val('');

    $('#form_proyek select').trigger('change');
    $('#form_proyek textarea').val('');
    $('#display_kode_provider').removeClass('showin');
    $('#display_kode_provider').addClass('hidin');
    mydeskripsi.setData('');
}

function switch_block(element, e, id, two = false) {
    // console.log(two);

    e.preventDefault();
    const icon = 'question';
    if ($(element).is(':checked')) {
        var value = 'Y';
        var type = false;
        var message = 'Anda yakin akan membuka blockir pada proyek ini? Selanjutnya proyek akan bisa mengakses sistem';
        
    } else {
        var value = 'N';
        var type = "textarea";
        var message = 'Anda yakin akan melakukan blockir pada proyek ini? proyek tidak akan bisa mengakses sistem';
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
                url: BASE_URL + 'master_function/switch_proyek',
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

function peserta_investasi(element,id_investasi) {
    $.ajax({
        url: BASE_URL + 'master/get_peserta_investasi',
        method: 'POST',
        data: { id: id_investasi},
        cache: false,
        success: function (msg) {
            $('#display_peserta_investasi').html(msg);
        }
    })  
}