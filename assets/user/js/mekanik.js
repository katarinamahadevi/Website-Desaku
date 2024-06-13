function auth_path(tujuan) {
    $('#auth_path .showin').addClass('hidin');
    $('#auth_path .showin').removeClass('showin');
    if (tujuan == 'regis') {
        $('#modalAuthLabel').text('Daftar Sekarang');
        $('#modal_size').addClass('modal-lg');    
    }else{
        $('#modalAuthLabel').text('Masuk Sekarang');
        $('#modal_size').removeClass('modal-lg');    
    }
    
    $('#'+tujuan).addClass('showin');
    $('#'+tujuan).removeClass('hidin');
}