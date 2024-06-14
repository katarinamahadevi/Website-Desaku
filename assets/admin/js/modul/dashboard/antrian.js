$(document).ready(function() {
  setInterval(function() {
    $('#kt_app_content_container').load(BASE_URL + page + ' #reload_all');
  }, 10000);
});

function nota(id) {
    $('#nota_name').text('-----');
    $('#nota_email').text('-----@gmail.com');
    $('#nota_order').text('#0000');
    $('#nota_tanggal_masuk').text('00-00-0000');
    $('#nota_tanggal_keluar').text('00-00-000');
    $('#nota_payment').text('#000000');
    $('#nota_metode').text('----');
    $('#status_booking').text('-----')
    $('#display_tabel').html('');
    $.ajax({
        url: BASE_URL + 'dashboard/get_nota',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (data) {
          if (data.status == true) {
              $('#nota_name').text(data.nama);
              $('#nota_email').text(data.email);
              $('#nota_order').text('#'+data.id_booking);
              $('#nota_tanggal_masuk').text(data.tanggal_mulai);
              $('#nota_tanggal_keluar').text(data.tanggal_selesai);
              $('#nota_payment').text('#'+data.id_payment);
              $('#nota_metode').text(data.metode);
              $('#status_booking').text(status_payment(data.status_booking));
              $('#display_tabel').html(data.table);
          }
           
        }
    })
}


function status_booking(id_booking,status,baru,id) {
    Swal.fire({
        html: 'Anda yakin akan merubah status pemesanan ID ORDER <b>"'+id+'"</b> dari <b>"'+status_payment(status)+'"</b> menjadi <b>"'+status_payment(baru)+'"</b>',
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
            url: BASE_URL + 'dashboard/ubah_status_booking',
            method: 'POST',
            data: { id_booking: id_booking,status: status,baru: baru },
            dataType: 'json',
            success: function (data) {
                if (data.status == true) {
                  var icon = 'success';
                }else{
                  var icon = 'warning';
                }

                Swal.fire({
                    html: data.message,
                    icon: icon,
                    buttonsStyling: !1,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: css_btn_confirm
                    }
                });

                $('#kt_app_content_container').load(BASE_URL + page + ' #reload_all');

            }
        })
        }
    }));
    
}