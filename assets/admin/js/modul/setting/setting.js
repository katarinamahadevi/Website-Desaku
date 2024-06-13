var mytentang_kami;
var mytext_cs;
    
    ClassicEditor.create( document.querySelector( '#tentang_kami' ), {
        plugins: [ Image, ImageToolbar, ImageCaption, ImageStyle, ImageResize, LinkImage ],
        toolbar: {
			items: ["heading", "|", "bold", "italic", "bulletedList", "numberedList", "|", "outdent", "indent", "|", "blockQuote", "insertTable", "mediaEmbed","insertImage","htmlEmbed", "undo", "redo"]
		},
		table: {
			contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"]
		},
        image: {
            toolbar: [ 'toggleImageCaption', 'imageTextAlternative', 'ckboxImageEdit' ]
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


