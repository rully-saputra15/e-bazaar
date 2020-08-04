$(document).ready(function(){
    $("form").on("submit",function(){
        if($('#modal').val() > $('#jual').val()){
            $('#message').show();
            return false;
        }else{
            $('#message').hide();
        }
    });
})
