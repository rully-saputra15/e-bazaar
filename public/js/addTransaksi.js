$(document).ready(function(){
    //$('.uang').mask('000.000.000', {reverse: true});
    var wrapper = $(".wrapper");
    var add_button = $(".add_menu");
    var add_modal = $(".add_modal");
    $(add_button).click(function(e){
        e.preventDefault();
        var data = document.getElementById('select_menu').options;
        var txt2;
        for(i=0 ; i < data.length ; i++){
            txt2 += '<option value="'+data[i].value+'">'+data[i].value+'</option>';
        }
        var txt1 = '<div class="row"><div class="col"><label for="">Menu</label><select class="custom-select"name="pesanan[]">'+ txt2+'</select></div></div><br><div class="row"><div class="col"><input type="number" class="form-control" name="jumlah[]"placeholder="jumlah"></div></div><br>'
        $(wrapper).append(
            txt1);
    });
    $(add_modal).click(function(e){
        e.preventDefault();
        $(wrapper).append('<div class="row"><div class="col"><label for="">Nama Modal</label><input type="text" class="form-control" name="modal[]"></div> <div class="col"><label for="">Harga Modal</label><input type="text" class="form-control" name="harga[]"></div></div>');
    });
})
