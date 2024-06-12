var mytentang_kami;
var mylanding_text;
    
    ClassicEditor.create( document.querySelector( '#tentang_kami' ), {
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
        mytentang_kami = editor;
    } )
    .catch( error => {
        console.error( 'Oops, something went wrong!' );
        console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
        console.warn( 'Build id: vd7qnogyyu6n-nohdljl880ze' );
        console.error( error );
    } );

    ClassicEditor.create( document.querySelector( '#landing_text' ), {
        toolbar: {
			items: ["heading", "|","fontColor", "bold", "italic", "bulletedList", "numberedList", "alignment","|", "outdent", "indent", "|", "blockQuote", "insertTable", "mediaEmbed","htmlEmbed", "undo", "redo"]
		},
		table: {
			contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"]
		},
		language: "en",
        licenseKey: ''
        
        
    } )
    .then( editor => {
        //window.editor = editor;
        mylanding_text = editor;
    } )
    .catch( error => {
        console.error( 'Oops, something went wrong!' );
        console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
        console.warn( 'Build id: vd7qnogyyu6n-nohdljl880ze' );
        console.error( error );
    } );
    



function cek_link_yt(element,input, tujuan) {
    var first_text = $(element).html();
    $(element).html('<div class="spinner-border text-light" role="status"></div>');
    var url = $(input).val();
    url = embed_youtube(url);

    setTimeout(() => {
        $(element).html(first_text);
         if (url != '') {
            $(tujuan+' iframe').prop('src',url);
            $(tujuan).removeClass('hidin');
            $(tujuan).addClass('showin');
        }else{
            $(tujuan).removeClass('showin');
            $(tujuan).addClass('hidin');
        }
    
    }, "1000");
   
}

ClassicEditor
    .create(document.querySelector('#text_cs'),
    {
        toolbar: {
			items: ["heading", "|", "bold", "italic", "bulletedList", "numberedList", "|", "outdent", "indent", "|", "blockQuote", "insertTable", "mediaEmbed","htmlEmbed", "undo", "redo"]
		},
		table: {
			contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"]
		},
		language: "en",
        licenseKey: ''
        
        
    } )
    .then( editor => {
        //window.editor = editor;
        mytext_cs = editor;
    } )
    .catch( error => {
        console.error( 'Oops, something went wrong!' );
        console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
        console.warn( 'Build id: vd7qnogyyu6n-nohdljl880ze' );
        console.error( error );
    } );




function insert_banner(element,id,id_form,num) {
    const defaultBtn = document.querySelector(id);
    var text_button = document.getElementById(element.id).innerHTML;
    var url = BASE_URL + 'setting_function/upload_banner';
    var method = $(id_form).attr('method');
    var form = $('form')[num];
    var form_data = new FormData(form);

    defaultBtn.click();
    defaultBtn.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                const result = reader.result;
            }
            reader.readAsDataURL(file);
             $.ajax({
                url: url,
                method: method,
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                beforeSend: function () {
                    $('#' + element.id).html('Tunggu Sebentar...');
                },
                success: function (data) {
                    if (data.load != null) {
                        for (var a = 0; a < data.load.length; a++) {
                            $(data.load[a].parent).load(data.load[a].reload);
                        }
                    }
                    $('#' + element.id).prop('disabled', false);
                    $('#' + element.id).html(text_button);

                    if (data.status == 200 || data.status == true) {
                        var icon = 'success';
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
                        });
                    }
                }
            });
        }
    });

}


function switch_block(element, e, id, two = false) {
    // console.log(two);

    e.preventDefault();
    const icon = 'question';
    if ($(element).is(':checked')) {
        var value = 'Y';
        var type = false;
        var message = 'Anda yakin akan membuka status pada bank ini? Selanjutnya bank akan bisa mengakses sistem';
        
    } else {
        var value = 'N';
        var type = "textarea";
        var message = 'Anda yakin akan melakukan blockir pada bank ini? bank tidak akan bisa mengakses sistem';
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
                url: BASE_URL + 'master_function/switch_bank',
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