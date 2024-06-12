$(function(){
    $('.operator_select2_custom').select2({
    placeholder: "Select an option",
    minimumResultsForSearch: Infinity,
    templateSelection: optionFormat,
    templateResult: optionFormat
    });
})

function tambah_form_rekening(element,ex='') {
    if (ex) {
         $('#form_tambah_rekening_'+ex).removeClass('hidin');
        $('#form_tambah_rekening_'+ex).addClass('showin');
    }else{
         $('#form_tambah_rekening').removeClass('hidin');
        $('#form_tambah_rekening').addClass('showin');
    }
   
    $(element).addClass('hidin');
    $(element).removeClass('showin');
    if (ex) {
        $('#btn_simpan_form_rekening_'+ex).removeClass('hidin');
        $('#btn_simpan_form_rekening_'+ex).addClass('showin');
        $('#btn_hapus_form_rekening_'+ex).removeClass('hidin');
        $('#btn_hapus_form_rekening_'+ex).addClass('showin');
    }else{
         $('#btn_simpan_form_rekening').removeClass('hidin');
        $('#btn_simpan_form_rekening').addClass('showin');
        $('#btn_hapus_form_rekening').removeClass('hidin');
        $('#btn_hapus_form_rekening').addClass('showin');
    }
}

function hapus_form_rekening(element,ex='') {
    if (ex) {
         $('#form_tambah_rekening_'+ex).removeClass('showin');
        $('#form_tambah_rekening_'+ex).addClass('hidin');
    }else{
         $('#form_tambah_rekening').removeClass('showin');
        $('#form_tambah_rekening').addClass('hidin');
    }
   
    $(element).addClass('hidin');
    $(element).removeClass('showin');
    if (ex) {
        $('#btn_simpan_form_rekening_'+ex).addClass('hidin');
        $('#btn_simpan_form_rekening_'+ex).removeClass('showin');
        $('#btn_tambah_form_rekening_'+ex).removeClass('hidin');
        $('#btn_tambah_form_rekening_'+ex).addClass('showin');
    }else{
        $('#btn_simpan_form_rekening').addClass('hidin');
        $('#btn_simpan_form_rekening').removeClass('showin');
        $('#btn_tambah_form_rekening').removeClass('hidin');
        $('#btn_tambah_form_rekening').addClass('showin');
    }
    
}

function set_tujuan(id,fee) {
    $('input[name="id_user_rekening"]').val(id);
    $('input[name="nominal_fee"]').val(fee);
    var rate = $('input[name="rate"]').val();

    var nominal_convert = $('input[name="nominal_convert"]').val();
    nominal_convert = Number(nominal_convert);

    var total = 0;
    if (nominal_convert) {
        var total = (nominal_convert * rate) - fee;
    }
    total = Number(total);
    total = total.toFixed();
    $('input[name="nominal_diterima"]').val(total);
    
    total = (total).toString();
    var cetak = 'Rp. '+format_uang(total);         
    $('#uang_diterima').html(cetak);

    $('.card_tujuan .card.bg-light-primary').removeClass('bg-light-primary');
    $('#card_tujuan_'+id).addClass('bg-light-primary');
}

function set_tujuan_wd(element, id,fee) {
    $('input[name="id_rekening"].withdraw').val(id);
    $('input[name="fee"].withdraw').val(fee);

    $('#wd_tujuan .bg-light-primary').removeClass('bg-light-primary');
    $(element).addClass('bg-light-primary');
}


function matauang_convert(element = null,rep = null){
    $('.text-alert-sementara').remove();
    var id_kategori = $('input[name="id_kategori_produk"].transaksi').val();
    var min_tf = $('input[name="min_tf"].transaksi').val();
    var max_tf = $('input[name="max_tf"].transaksi').val();
    var angka = $(element).val();
    var id_produk = $('input[name="id_produk"]').val();
    
    
    var rupiah = format_uang(angka);
    
    $(element).val(rupiah);
    if (rep != null) {
        var asli = angka.replaceAll(".", "");
        $(rep).val(asli);
    }

    // GET VALUE
    var value = $('#nominal_convert').val();
    var fee = $('input[name="nominal_fee"]').val();
    fee = Number(fee);

    if (value.length >= 4) {
        $.ajax({
            url: BASE_URL + 'fungsi_user/get_rate_price',
            method: 'POST',
            data: { id: id_produk, price: value },
            dataType: 'json',
            success: function (data) {
                var rate = data.rate;
                var uang_diterima = (value * rate);
                uang_diterima = uang_diterima.toFixed();
                
                $('.text-alert-jmlh').remove();
                var text = '<span class="text-muted text-alert-sementara text-alert-jmlh">Terima <b>Rp.'+format_uang(uang_diterima.toString())+'</b> dengan rate <b>'+rate+'</b></span>';
                $('#req_transaksi_nominal_convert').append(text);
            
                $('input[name="rate"]').val(rate);
                $('#rate_diterima').html('Rate : '+rate)
                
                var total = uang_diterima - fee;
                total = total.toFixed();
                $('input[name="nominal_diterima"]').val(total);
                total = (total).toString();
                var cetak = 'Rp. '+format_uang(total);
                $('#uang_diterima').html(cetak);
                
            }
        })
        
    }
    
    
    if (Number(value) < Number(min_tf)) {
        $('#req_transaksi_nominal_convert').append('<span class="text-danger text-alert-sementara">Minimal convert Rp.'+format_uang(min_tf)+'</span>');
    }
    if (Number(value) > Number(max_tf)) {
        $('#req_transaksi_nominal_convert').append('<span class="text-danger text-alert-sementara">Maximal convert Rp.'+format_uang(max_tf)+'</span>');
    }
    
    if (Number(value) >= Number(min_tf) && Number(value) <= Number(max_tf)) {
        // console.log('on track')
            $('#foot_transaksi').removeClass('hidin');
            $('#foot_transaksi').addClass('showin');
            if (id_kategori == 2) {
                $('#btn_submit_convert').attr('disabled',false);
            }
    }else{
        // console.log('off track')
        $('#foot_transaksi').removeClass('showin');
         $('#foot_transaksi').addClass('hidin');
         if (id_kategori == 2) {
                $('#btn_submit_convert').attr('disabled',true);
            }
    }

    
    // console.log(total);
    
       
}


function get_detail_transaksi(id_transaksi) {
    $.ajax({
        url: BASE_URL + 'fungsi_user/get_detail_transaksi',
        method: 'POST',
        data: { id: id_transaksi},
        cache : false,
        success: function (msg) {
            $('#transaksi_display_canvas').html(msg);
            $('#offcanvasDetailConvert').offcanvas('show');
        }
    })
}


function insert_bukti_bayar(id) {
    const defaultBtn = document.querySelector(id);
    defaultBtn.click();
    defaultBtn.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                const result = reader.result;
                $('#display_bukti_bayar').html('<img src="'+result+'" width="200px">');
               
            }
            reader.readAsDataURL(file);
        }
    });
}

function set_number(element) {
    var value = $(element).val();
    if (value.length > 4 && value.length <= 5) {
       $.ajax({
            url: BASE_URL + 'fungsi_user/get_number_kode',
            method: 'POST',
            data: { number: value},
            cache : false,
            dataType : 'json',
            success: function (data) {
            if (data.status == true) {
                    $('input[name="id_produk"].transaksi').val(data.id_produk);
                    $('input[name="min_tf"].transaksi').val(data.min_tf);
                    $('input[name="max_tf"].transaksi').val(data.max_tf);
                    $("#nomor_pengirim_ornamen").css("background-image", "");
                    document.getElementById('nomor_pengirim_ornamen').style.backgroundImage="url("+BASE_URL+"data/produk/"+data.gambar+")";
            }
            }
        }) 
    }
    $('#btn_submit_convert').attr('data-message','<h1>'+value+'</h1></br>Apakah nomor telpon yang dimasukan sudah sesuai?');
    if (value == '') {
        $('#btn_submit_convert').attr('disabled',true);
    }else{
        $('#btn_submit_convert').attr('disabled',false);
    }
    
}

function place_number(place,value) {
    if (value.length > 4) {
       $.ajax({
            url: BASE_URL + 'fungsi_user/get_number_kode',
            method: 'POST',
            data: { number: value},
            cache : false,
            dataType : 'json',
            success: function (data) {
            if (data.status == true) {
                    $('input[name="id_produk"].transaksi').val(data.id_produk);
                    $('input[name="min_tf"].transaksi').val(data.min_tf);
                    $('input[name="max_tf"].transaksi').val(data.max_tf);
                    $("#nomor_pengirim_ornamen").css("background-image", "");

                    document.getElementById('nomor_pengirim_ornamen').style.backgroundImage="url("+BASE_URL+"data/produk/"+data.gambar+")";
            }
            }
        }) 
    }
    
    $(place).val(value);
    if (value == '') {
        $('#btn_submit_convert').attr('disabled',true);
    }else{
        $('#btn_submit_convert').attr('data-message','<h1>'+value+'</h1></br>Apakah nomor telpon yang dimasukan sudah sesuai?');
        $('#btn_submit_convert').attr('disabled',false);
    }
}


function hapus_nofav(element, id) {
    Swal.fire({
        html: 'Anda yakin akan menghapus nomor ini ?',
        icon: 'question',
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
            $.ajax({
                url: BASE_URL + 'fungsi_user/hapus_nomor_Favorit',
                method: 'POST',
                data: { id: id},
                cache : false,
                dataType : 'json',
                success: function (data) {
                    if (data.status == true) {
                        $('#nofav-'+id).remove();
                    }
                }
            })
        }
    }));
     
}


function get_end_text(element, terusan) {
    var aksi = $(element).data('action');
    if (aksi == 'open') {
        $(element).data('action','close');
        $(terusan).removeClass('d-none');
        $(element).html('Tampilkan lebih sedikit');
    }else{
        $(element).data('action','open');
         $(terusan).addClass('d-none');
         $(element).html('Tampilkan lebih banyak');
    }

   
}


function sandi_page(nama) {
    $('input[name=type_form]').val(nama);
    var nama = nama.charAt(0).toUpperCase() + nama.slice(1);
    $('#title_sandi').html(nama);
}



function upload_foto(id_form,num) {
    var url = BASE_URL + 'user_function/upload_foto';
    var method = $(id_form).attr('method');
    var form = $('form')[num];
    var form_data = new FormData(form);

    $.ajax({
        url: url,
        method: method,
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function(){
            KTApp.showPageLoading();
        },
        success: function (data) {
            KTApp.hidePageLoading();
            if (data.load != null) {
                for (var a = 0; a < data.load.length; a++) {
                    $(data.load[a].parent).load(data.load[a].reload);
                }
            }

            if (data.status == 200 || data.status == true) {
                var icon = 'success';
            } else {
                var icon = 'warning';
                document.getElementById('profil_display_foto').style.backgroundImage = 'url("'+foto_default+'")';
            }
            if (data.alert) {
                Swal.fire({
                    html: data.alert.message,
                    icon: icon,
                    buttonsStyling: !1,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: css_btn_confirm
                    }
                });
            }
        }
    });
}



function nominal_investasi(element = null,rep = null,profit = 0,min = 0,batas = 0){
    $('.fadedin').remove();
    
    var angka = $(element).val();
    var rupiah = format_uang(angka);
    
    var asli = 0;
    var keuntungan = 0;
    $(element).val(rupiah);
    if (rep != null) {
        if (angka == 0) {
            asli = min.toString();
        }else{
            asli = angka.replaceAll(".", "");
        }
        
        $(rep).val(asli);

    }
    if (angka == 0) {
        $('#req_investasi_modal_investasi').append('<span class="text-success text-center size-12 fadedin">Nominal investasi otomatis di setting ke minimal investasi</span>');
    }else{
        if (asli > batas) {
            $('#req_investasi_modal_investasi').append('<span class="text-danger text-center size-12 fadedin">Saldo tidak mencukupi</span>');
        }else{
            if (asli < min) {
                $('#req_investasi_modal_investasi').append('<span class="text-danger text-center size-12 fadedin">Minimal investasi senilai '+format_uang(min.toString())+'</span>');
            }
        }
    }
    
    keuntungan = (Number(asli) * profit) / 100;
    var ck = keuntungan.toString();
    ck = ck.split(".");
    if (ck.length <= 1 || Number(ck[1]) <= 0) {
        keuntungan = format_uang(keuntungan.toString());
    }else{
        keuntungan = 0;
    }
    
    var display_asli = format_uang(asli.toString());
    $('#jumlah_investasi').text(display_asli)
    $('#jumlah_keuntungan').text(keuntungan)
}
