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

function modal_tiket(id) {
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