function status_transaksi(id_transaksi,status,baru) {
    Swal.fire({
        html: 'Anda yakin akan merubah status pemesanan dari <b>"'+status_payment(status)+'"</b> menjadi <b>"'+status_payment(baru)+'"</b>',
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
            url: BASE_URL + 'dashboard/ubah_status_transaksi',
            method: 'POST',
            data: { id_transaksi: id_transaksi,status: status,baru: baru },
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