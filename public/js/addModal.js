$(document).ready(function(){
    var wrapper = $(".wrapper");
    var add_modal = $(".add_modal");

    $(add_modal).click(function(e){
        e.preventDefault();
        $(wrapper).append('<div class="row"><div class="col"><label for="">Nama Modal</label><input type="text" class="form-control" name="modal[]"></div> <div class="col"><label for="">Harga Modal</label><input type="text" class="form-control" name="harga[]"></div></div>');
    });
})
