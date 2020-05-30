$(function(){
    $('.textoLogin').each(function(){
        if($(this).html() != ""){
            $('#login').trigger('click');
        }
    });
    
    $.ajax({
        url: '/obtenerNotificaciones',
        method: 'GET',
        success: function(data){
            if(data.length > 0){
                var sup = $('<sup>').addClass('font-weight-bold colorNoti tamanyoTexto').html(data.length);
                $('#notificacion').append(sup);
            }
        }
    });
});

function validarProvinciaLocalidadNombre(campo, mensaje){
    $('#mensaje'+campo).html('');
    if(campo  == 'nombreDir'){
        if(mensaje.length < 5){
            $('#mensaje'+campo).html('Este campo debe tener como minimo 10 caracteres');
        }
        if(mensaje.length > 100){
            $('#mensaje'+campo).html('Este campo debe tener como máximo 100 caracteres');
        }
    }else{
        if(mensaje.length < 4){
            $('#mensaje'+campo).html('Este campo debe tener como minimo 4 caracteres');
        }
        if(mensaje.length > 20){
            $('#mensaje'+campo).html('Este campo debe tener como máximo 20 caracteres');
        }
    }

}

function validarPatioPiso(campo, mensaje){
    $('#mensaje'+campo).html('');
    var correcto = true;
    if(mensaje <= 0){
        $('#mensaje'+campo).html('Este campo no puede ser menor o igual a 0');
    }
}

function validarHabitaciones(campo, mensaje){
    $('#mensaje'+campo).html('');
    if(mensaje <= 0){
        $('#mensaje'+campo).html('El número debe ser mayor o igual a 1');
    }
    if(mensaje > 5){
        $('#mensaje'+campo).html('Solo se permite poner hasta el número 5');
    }
}

function validarCuartosBanyo(campo, mensaje ){
    if(mensaje <= 0){
        $('#mensaje'+campo).html('El número debe ser mayor o igual a 1');
    }
    if(mensaje > 3){
        $('#mensaje'+campo).html('Solo se permite poner hasta el número 3');
    }
}

function validarSelect(campo, mensaje){
    $('#mensaje'+campo).html('');
    if(mensaje == '-'){
        $('#mensaje'+campo).html('Debes selecionar una opción');
    }else{
        if(mensaje != 'A' && mensaje != 'AQ' && mensaje != 'C' && mensaje != 'P' && mensaje != 'D' && mensaje != 'C' && mensaje != 'B'){
            $('#mensaje'+campo).html('Opción elegida incorrecta');
        }
    }
}

function validarPrecio(campo, mensaje){
    $('#mensaje'+campo).html('');
    if(mensaje <= 200){
        $('#mensaje'+campo).html('El número de este campo debe ser superior a 200.');
    }
}

function validarMetrosCuadrados(campo , mensaje){
    $('#mensaje'+campo).html('');
    if(mensaje < 30){
        $('#mensaje'+campo).html('El número minimo que debes poner es de 30 metros cuadrados.');
    }
}

function validarFianza(campo, mensaje){
    $('#mensaje'+campo).html('');
    var minimo = $('#precio').val()*2;
    var maximo =$('#precio').val()*4;
    if(mensaje < minimo && mensaje > maximo){
        $('#mensaje'+campo).html('La fianza debe ser como mínimo 2 meses y como máximo 4 meses.');
    }
}

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

function clickFavoritosLogeado(eliminar, idInmueble){
    $.ajax({
        url: '/favoritos/agregarFavoritos',
        method: 'POST',
        data: {eliminarFav: eliminar, idInmueble: idInmueble, "_token": $('#token').val()}
    });
}

function clickFavoritosCookie(eliminar, idInmueble){
    if(eliminar == 1){
        if(getCookie('favoritos') != ""){
            var inmuebles = "";
            var array = getCookie('favoritos').split(',');
            for(var i = 0 ; i<array.length; i++){
                if(array[i] != idInmueble){
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
        }
    }else{
        var error = false
        if(getCookie('favoritos') != ""){
            var favoritos = getCookie('favoritos').split(',');
            for(var i = 0; i<favoritos.length ; i++){
                if(favoritos[i] == idInmueble){
                    error = true;
                    break;
                }
            }
            if(error == false){
                setCookie('favoritos', getCookie('favoritos') + ',' + idInmueble ,999999999);
            }
        }else{
            setCookie('favoritos', idInmueble ,999999999);

        } 
    }
}