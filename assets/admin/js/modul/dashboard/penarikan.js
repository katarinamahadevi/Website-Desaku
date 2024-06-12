$(document).ready(function() {
  setInterval(function() {
    $('#kt_app_content_container').load(BASE_URL + page + ' #reload_all');
  }, 10000);
});


function status_penarikan(id_penarikan,status,baru,id) {
    var tipe = 'hidden';
    var label = '';
    var input_name = 'kosong';
     var reason = '';
     var func_lanjut = true;
     var plus = '';
    if (baru != 1) {
      tipe = 'textarea';
      label = 'Masukan alasan penolakan';
      input_name = 'reason';
    }else{
      plus += '<form id="form_upload_bukti_transfer" action="'+BASE_URL+'dashboard_function/upload_bukti_tf" method="POST" enctype="multipart/form-data">';
      plus += '<label for="bukti_tf" class="swal2-input-label">Upload Bukti Transfer</label>';
      plus += '<input type="file" id="bukti_tf" name="bukti_tf" class="swal2-file">';
      plus += '</form>';
    }
    Swal.fire({
        html: 'Anda yakin akan merubah status penarikan ID ORDER <b>"'+id+'"</b> dari <b>"'+sts_penarikan(status)+'"</b> menjadi <b>"'+sts_penarikan(baru)+'"</b></br>'+plus,
        icon: 'question',
        
        input: tipe,
        inputAttributes: {
            autocapitalize: 'off',
            name: input_name,
        },
        inputLabel : label,
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
            if (baru != 1) {
              reason = $('textarea[name=reason]').val();
            }else{
              var data = bukti_tf_submit(id_penarikan);
              // console.log(data);
              // if (data.status != true) {
              //   func_lanjut = false;
              //   Swal.fire({
              //       html: data.message,
              //       icon: 'warning',
              //       buttonsStyling: !1,
              //       confirmButtonText: "Ok",
              //       customClass: {
              //           confirmButton: css_btn_confirm
              //       }
              //   });
              // }
            }
            if (func_lanjut == true) {
              $.ajax({
                  url: BASE_URL + 'dashboard_function/ubah_status_penarikan',
                  method: 'POST',
                  data: { id_penarikan: id_penarikan,status: status,baru: baru,reason : reason },
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
            
        }
    }));
    
}

function bukti_tf_submit(id_penarikan) {
  // console.log('nyambung');
    var url = $('#form_upload_bukti_transfer').attr('action');
    var form = $('form')[0];
    var form_data = new FormData(form);
    form_data.append('id_penarikan', id_penarikan);
    var callback = true;
    $.ajax({
        url: url,
        method: 'POST',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function (data) {
            callback = data;
            
        }
    });

    return callback;
}
