function cek_email(element) {
    var value = $(element).val();
    var def = $('#def_email').val();
    if (value != def) {
        $('label.cek_kondisi').addClass('required');
    }else{
        $('label.cek_kondisi').removeClass('required');
    }
}

function cek_notelp(element) {
    var value = $(element).val();
    var def = $('#def_notelp').val();
    if (value != def) {
        $('label.cek_kondisi').addClass('required');
    }else{
        $('label.cek_kondisi').removeClass('required');
    }
}