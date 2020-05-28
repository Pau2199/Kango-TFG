$(function(){
    $('.btn-danger').click(function(){
        var id = $(this).parent().parent().children(':nth-child(2)').attr('id');
        console.log(id);
        if($('#notificacion').length > 0){
            $.ajax({
                url: '/favoritos/agregarFavoritos',
                method: 'POST',
                data: {eliminarFav: 1, idInmueble: id, "_token": $('#token').val()},
                success: function(data){
                    $('#'+id).parent().remove();
                }
            });
        }else{
            if(getCookie('favoritos') != ""){
                var inmuebles = "";
                var array = getCookie('favoritos').split(',');
                for(var i = 0 ; i<array.length; i++){
                    if(array[i] != id){
                        console.log('entra');
                        if(i == 0){
                            inmuebles = array[i];
                        }else{
                            if(inmuebles == ""){
                                inmuebles += array[i];   
                            }else{
                                inmuebles += ',' + array[i];   
                            }
                        }
                    }
                }
                if(inmuebles == ""){
                    deleteCookie('favoritos');
                }else{
                    setCookie('favoritos', inmuebles, 999999999);
                }
                $('#'+id).parent().remove()
            }
        }
    });
});

function setCookie(cname, cvalue, exdays){
    var d = new Date(); d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function deleteCookie(cname) {
    var valor = cname+'=; expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/';
    document.cookie = valor; 
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');

    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' '){
            c = c.substring(1); 
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length); 
        }
    } return "";
}