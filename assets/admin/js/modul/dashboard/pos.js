$("#tanggal").flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    mode: "range",
    minDate: "today",
    defaultDate: [date_start, date_end]
});

$("#kt_datepicker_8").flatpickr({
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    minDate: "today",
    mode: "range"
});

function see_day(element, id) {
    $('#jumlah_hari button.active').removeClass('active');
    $(element).addClass('active');

    $('#display_breakfast table.showin').addClass('hidin');
     $('#display_breakfast table.showin').removeClass('showin');
     
    $('#pane_'+id).addClass('showin');
    $('#pane_'+id).removeClass('hidin');
}
function set_harga(element) {
    var value = $(element).val();
    var harga = $(element).data('harga');
    var breakfast = $('input[name="total_breakfast"]').val();
    $('label.cecep.active').removeClass('active');
    $('label[for="id_product_'+value+'"]').addClass('active');
    $('input[name="id_product"]').val(value);
    $('input[name="harga_product"]').val(harga);
    
    var tm = $('input[name="tanggal_mulai"]').val();
    var ts = $('input[name="tanggal_selesai"]').val();
    // LAMA HARI
    var lama_sewa = selisih_hari(tm,ts);
    $('input[name="lama_sewa"]').val(lama_sewa);
    $('#lama_sewa').text(lama_sewa+' Hari');
    // TOTAL VILLA
    var harga_villa = parseInt(harga) * parseInt(lama_sewa);
    var total = harga_villa + parseInt(breakfast);
    // console.log(total);
     $('input[name="total_product"]').val(harga_villa);
    $('#harga_villa').text(format_uang(harga.toString()));
    $('#total_villa').text(format_uang(harga_villa.toString()));
    // TOTAL HARGA
    $('input[name="total_bayar"]').val(total);
    $('#total_bayar').text(format_uang(total.toString()));


    // FILTER
    $('#bapack .cfc').addClass('hidin');
    $('#bapack .cfc').removeClass('showin');

    // TOTAL BAYAR
    $('#layout_total_bayar').removeClass('hidin');
    $('#layout_total_bayar').addClass('showin');

    

    var get = url_get();
    console.log(get);
    var params = '';
    if (get.length > 0) {
        if (get[0].split('=')[0] != 'id_product') {
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'id_product') {
                    if (i == 0) {
                        params += '?' + get[i];
                    } else {
                        params += '&' + get[i];
                    }
                }

            }
            params += '&id_product=' + value;
        } else {
            params += '?id_product=' + value;
            for (var i = 0; i < get.length; i++) {
                if (get[i].split('=')[0] != 'id_product') {

                    params += '&' + get[i];
                }
            }
        }
    } else {

        params = '?id_product=' + value;
    }
    var uri = BASE_URL + page + params;
    uri = encodeURI(uri);
    window.history.pushState('', '', uri);
}


function cancel_order() {
    location.href = BASE_URL + 'pos';
}

function tambah_produk() {
    var lama_sewa = $('input[name="lama_sewa"]').val();
    var btn = '<button type="button" onclick="see_day(this,1)" class="btn btn-outline-primary active">Hari 1</button>';
    if (lama_sewa > 1) {
        for (let i = 2; i <= lama_sewa; i++) {
            btn += '<button type="button" onclick="see_day(this,'+i+')" class="btn btn-outline-primary">Hari '+i+'</button>';
        }
    }
    $('#jumlah_hari').html(btn);
    // TOTAL BAYAR
     $('#bapack .cfc').addClass('hidin');
    $('#bapack .cfc').removeClass('showin');

    // FILTER
    $('#layout_tambah_produk').addClass('showin');
    $('#layout_tambah_produk').removeClass('hidin');

    var params = $('input[name="val_params"]').val();
    $.ajax({
        url: BASE_URL + 'dashboard/product_sub'+params,
        method: 'POST',
        data: { hari: lama_sewa },
        cache : false,
        success: function (msg) {
            $('#myTabContent').html(msg);
        }
    })
}


function filter_cashier(element, name = []) {
    $('label.cecep.active').removeClass('active');
    $('input[name="id_product"]').val('');
    var text = $(element).html();
    $(element).html('<div class="spinner-border text-light" role="status"></div>');
    $('#loading_add').removeClass('hidin');
    $('#loading_add').addClass('showin');
    $('#reload_table').html('');
    var get = url_get();
    // console.log(get);
  
    var params = '';
    
    if (name.length > 0) {
        if (get.length > 0) {
            params += '?';
            // fruits.includes("Mango");
            for (var i = 0; i < get.length; i++) {
                if (get[i].split('=')[0] != 'id_product') {
                    if (!name.includes(get[i].split('=')[0])) {
                        params += get[i] + '&';
                    }
                }
                
            }
            for (var i = 0; i < name.length; i++) {
                params += name[i] + '=' + $('.filter_mekanik .filter-input[name=' + name[i] + ']').val().split(" ").join("") + '&';
            }
        } else {
            for (var i = 0; i < name.length; i++) {
                if (i == 0) {
                    params += '?' + name[i] + '=' + $('.filter_mekanik .filter-input[name=' + name[i] + ']').val().split(" ").join("");
                } else {
                    params += '&' + name[i] + '=' + $('.filter_mekanik .filter-input[name=' + name[i] + ']').val().split(" ").join("");
                }

            }
        }
        var uri = BASE_URL + page + params;
        uri = encodeURI(uri);
        var delayInMilliseconds = 1000; //1 second

        setTimeout(function() {
            $(element).html(text);
            window.history.pushState('', '', uri);
            // $('#base_table').load(uri + ' #reload_table');
            location.reload();
        }, delayInMilliseconds);
      
    }
}


function simpan_tambahan(element, num = 0) {
    // console.log(url);
    var form = $('form')[num];
    var form_data = new FormData(form);
    var text_button = $(element).html();

    $.ajax({
        url: BASE_URL + 'dashboard/get_params',
        method: 'POST',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            $('#' + element.id).prop('disabled', true);
            $('#' + element.id).html('<div class="spinner-border text-light" role="status"></div>');
        },
        success: function (data) {
            // console.log(data);
            $('#' + element.id).prop('disabled', false);
            $('#' + element.id).html(text_button);
            if (data.status == 200 || data.status == true) {
                $('.list_tambahan').remove();
                var icon = 'success';
                var uri = data.url;
                uri = encodeURI(uri);
                window.history.pushState('', '', uri);

                var simpan_url = encodeURI(data.val_params);
                $('input[name="val_params"]').val(simpan_url);
                

                $('#bapack .cfc').addClass('hidin');
                $('#bapack .cfc').removeClass('showin');

                // TOTAL BAYAR
                $('#layout_total_bayar').removeClass('hidin');
                $('#layout_total_bayar').addClass('showin');
                var villa = $('input[name="total_product"]').val();

                var total = parseInt(villa) + parseInt(data.harga_breakfast) + parseInt(data.harga_tambahan);
                if (data.show_b == true) {
                    $('#pane_breakfast').removeClass('hidin');
                    $('#pane_breakfast').addClass('showin');
                    $('#parent_harga').append(data.harga);
                    $('#parent_list').append(data.list);

                    $('#total_breakfast').text(format_uang(data.harga_breakfast.toString()));
                    $('input[name="total_breakfast"]').val(data.harga_breakfast);
                }else{
                    $('#pane_breakfast').addClass('hidin');
                    $('#pane_breakfast').removeClass('showin');
                    $('#total_breakfast').text('');
                    $('input[name="total_breakfast"]').val(0);
                  
                }


                if (data.show_s == true) {
                    $('#pane_tambahan').removeClass('hidin');
                    $('#pane_tambahan').addClass('showin');

                     $('#parent_harga').append(data.t_harga);
                    $('#parent_list').append(data.t_list);

                      $('#total_product_tambahan').text(format_uang(data.harga_tambahan.toString()));
                    $('input[name="total_product_tambahan"]').val(data.harga_tambahan);
                }else{
                    $('#pane_tambahan').addClass('hidin');
                    $('#pane_tambahan').removeClass('showin');
                      $('#total_product_tambahan').text('');
                    $('input[name="total_product_tambahan"]').val(0);
                  
                }

                $('#total_bayar').text(format_uang(total.toString()));
                $('input[name="total_bayar"]').val(total);
            } else {
                var icon = 'warning';
                console.log('gangguan');
            }
        }
    });
}


function bayar() {
    // FILTER
    $('#bapack .cfc').addClass('hidin');
    $('#bapack .cfc').removeClass('showin');

    // TOTAL BAYAR
    $('#payment_page').removeClass('hidin');
    $('#payment_page').addClass('showin');
}

function to_book(tipe = 1) {
    if (tipe == 2) {
         $('#id_user').val('');
        $('#id_user').trigger('change');
        $('#button_bayar').prop('disabled',true);
    }

    if (tipe == 1) {
        $('input[name="id_booking_payment"]').prop('checked',false);
        var get = url_get();
        var params = '';
        if (get.length > 0) {
            if (get[0].split('=')[0] != 'id_booking_payment') {
                for (var i = 0; i < get.length; i++) {

                    if (get[i].split('=')[0] != 'id_booking_payment') {
                        if (i == 0) {
                            params += '?' + get[i];
                        } else {
                            params += '&' + get[i];
                        }
                    }

                }
            } else {
                for (var i = 0; i < get.length; i++) {
                    if (get[i].split('=')[0] != 'id_booking_payment') {

                        params += '&' + get[i];
                    }
                }
            }
        }

        var uri = BASE_URL + page + params;
        // uri = encodeURI(uri);
        window.history.pushState('', '', uri);
    }
   
    // FILTER
    $('#bapack .cfc').addClass('hidin');
    $('#bapack .cfc').removeClass('showin');

    // TOTAL BAYAR
    $('#layout_total_bayar').removeClass('hidin');
    $('#layout_total_bayar').addClass('showin');
}


function booking_form(element, id_form, num = 0, urlplus = '', draging = false) {
    var payment = $('input[name="id_booking_payment"]:checked').val();
    // console.log(payment);
    var loader = '<div class="spinner-border text-light" style="width : 20px;height : 20px;" role="status"></div>';
    var text_button = $('#'+element.id).html();
    var resultType = document.getElementById('result-type');
    var resultData = document.getElementById('result-data');


    // console.log(url);
    var form = $('form')[num];
    var form_data = new FormData(form);

    if (payment == 8) {
        $.ajax({
            url: BASE_URL + 'dashboard/validation',
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            beforeSend: function () {
                $('#' + element.id).prop('disabled', true);
                $('#' + element.id).html(loader);
            },
            success: function (data) {
                // console.log(data);
                $('#' + element.id).prop('disabled', false);
                $('#' + element.id).html(text_button);
                if (data.status == true) {
                    $.ajax({
                        url: BASE_URL + 'dashboard/token',
                        method : 'POST',
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data2) {
                            var resultType = document.getElementById('result-type');
                            var resultData = document.getElementById('result-data');

                            function changeResult(type,data2){
                                $("#result-type").val(type);
                                $("#result-data").val(JSON.stringify(data2));
                                //resultType.innerHTML = type;
                                //resultData.innerHTML = JSON.stringify(data);
                            }

                            snap.pay(data2, {
                                
                                onSuccess: function(result){
                                    changeResult('success', result);
                                    proses_form(element, id_form, num, urlplus, draging,loader)
                                },
                                onPending: function(result){
                                    changeResult('pending', result);
                                    proses_form(element, id_form, num, urlplus, draging,loader)
                                },
                                onError: function(result){
                                    changeResult('error', result);
                                    proses_form(element, id_form, num, urlplus, draging,loader)
                                }
                            });
                        }
                    });
                }else{
                    if (data.alert) {
                        Swal.fire({
                            html: data.alert.message,
                            icon: 'warning',
                            buttonsStyling: !1,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: css_btn_confirm
                            }
                        })
                    }
                }
            }
        });
    }else{
        proses_form(element, id_form, num, urlplus, draging,loader,BASE_URL + 'dashboard/booking');
    }
    
   
}

function plusminus(element,hari,id) {
    var action = $(element).data('action');
    var awal = $('#laman_'+hari+'_'+id).val();
    if (hari != 'a') {
        if ($('#terapkan_semua').is(':checked')) {
            var lapak = $('.food_'+id);
        }else{
            var lapak = $('#laman_'+hari+'_'+id);
        }
    }else{
        var lapak = $('#laman_'+hari+'_'+id);
    }
    
    if (action == 'plus') {
        lapak.val(parseInt(awal) + 1);
    }else{
        if (awal != 0) {
            lapak.val(parseInt(awal) - 1);
        }
    }
}
function to_tambah_customer(element) {
    var value = $(element).val();
    if (value == 'new') {
          // FILTER
        $('#bapack .cfc').addClass('hidin');
        $('#bapack .cfc').removeClass('showin');

        // TOTAL BAYAR
        $('#layout_tambah_customer').removeClass('hidin');
        $('#layout_tambah_customer').addClass('showin');
    }
    var get = url_get();
    var params = '';
    if (get.length > 0) {
        if (get[0].split('=')[0] != 'id_user') {
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'id_user') {
                    if (i == 0) {
                        params += '?' + get[i];
                    } else {
                        params += '&' + get[i];
                    }
                }

            }
            if (value != 'new') {
                params += '&id_user=' + value;
            }
        } else {
            if (value != 'new') {
                params += '?id_user=' + value;
            }
            for (var i = 0; i < get.length; i++) {
                if (get[i].split('=')[0] != 'id_user') {

                    params += '&' + get[i];
                }
            }
        }
    } else {
        if (value != 'new') {
            params = '?id_user=' + value;
        }
    }
    var uri = BASE_URL + page + params;
    // uri = encodeURI(uri);
    window.history.pushState('', '', uri);
    
    $('#button_bayar').prop('disabled',false);
   
}


function tambah_customer(element, id_form, num = 0) {
    // console.log(url);
    var form = $('form')[num];
    var form_data = new FormData(form);
    var text_button = $(element).html();

    $.ajax({
        url: BASE_URL + 'dashboard/tambah_customer',
        method: 'POST',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            $('#' + element.id).prop('disabled', true);
            $('#' + element.id).html('<div class="spinner-border text-light" role="status"></div>');
        },
        success: function (data) {
            $('#' + element.id).prop('disabled', false);
            $('#' + element.id).html(text_button);
            if (data.status == 200 || data.status == true) {
                  
                $(id_form + ' input.hehei').val("");
                var icon = 'success';
                
                $('#id_user').append('<option value="'+data.id+'">'+data.nama+'</option>');
                $('#id_user').val(data.id);
                $('#button_bayar').prop('disabled',true);
                $('#id_user').trigger('change');

                $('#bapack .cfc').addClass('hidin');
                $('#bapack .cfc').removeClass('showin');

                // TOTAL BAYAR
                $('#layout_total_bayar').removeClass('hidin');
                $('#layout_total_bayar').addClass('showin');
            } else {
                var icon = 'warning';
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
                })
            } else {

                if (data.redirect) {
                    location.href = data.redirect;
                }
                if (data.modal != null) {
                    $(data.modal.id).modal(data.modal.action);
                }

                if (data.reload == true) {
                    location.reload();
                }
            }
        }
    });
}


function choose_payment(element) {
    var value = $(element).val();
    var midtrans = $(element).data('midtrans');
    if (midtrans == 'Y') {
        $('input[name="midtrans"]').prop('checked',true);
    }else{
        $('input[name="midtrans"]').prop('checked',false);
    }
    if (value != '') {
        $('#submit_form').prop('disabled',false);
        var get = url_get();
        var params = '';
        if (get.length > 0) {
            if (get[0].split('=')[0] != 'id_booking_payment' && get[0].split('=')[0] != 'midtrans') {
                for (var i = 0; i < get.length; i++) {

                    if (get[i].split('=')[0] != 'id_booking_payment' && get[i].split('=')[0] != 'midtrans') {
                        if (i == 0) {
                            params += '?' + get[i];
                        } else {
                            params += '&' + get[i];
                        }
                    }

                }
                params += '&id_booking_payment=' + value;
                params += '&midtrans=' + midtrans;
            } else {
                params += '?id_booking_payment=' + value;
                for (var i = 0; i < get.length; i++) {
                    if (get[i].split('=')[0] != 'id_booking_payment' && get[i].split('=')[0] != 'midtrans') {

                        params += '&' + get[i];
                    }
                }
            }
        } else {
            params = '?id_booking_payment=' + value;
             params += '&midtrans=' + midtrans;
        }
         var uri = BASE_URL + page + params;
        uri = encodeURI(uri);
        window.history.pushState('', '', uri);
    }
}





function alltheday(element,hari = 1,id = array()) {
    
    // console.log(id);
    if ($(element).is(':checked')) {
        var base = [];
        if (id.length > 0) {
            for (let i = 0; i < id.length; i++) {
                base.push($('#laman_1_'+id[i]).val() );  
            }
        }

        if (base.length > 0) {
            for (let a = 2; a <= hari; a++) {
                for (let b = 0; b < id.length; b++) {
                    $('#laman_'+a+'_'+id[b]).val(base[b]);
                }
                
            }
        }
    }else{
        $('.ress').val(0); 
    }
}