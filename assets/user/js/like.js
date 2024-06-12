$(document).ready(function () { 
    let lv = 0; 
    $("#like").on("click", function () { 

        if (lv == 0) { 
            $('#like').html( 
                '<i class="bx bx-heart fs-3" style="color: #757575;"></i>'); 
            lv = 1; 
        } else { 
            $('#like').html( 
                '<i class="bx bxs-heart fs-3" style="color: #f52e4b;"></i>'); 
            lv = 0 
        } 
    }); 
}); 