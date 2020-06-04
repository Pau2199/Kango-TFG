$(function(){
    var cocokie = '';
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

    $('#alquilarInmueble').click(function(){
        setCookie('alquila', true, 1);
    });
    $(window).bind("beforeunload", function() {
        var url = window.location.href.split('/')[4];
        console.log(url)
        if(url != 'vistaInmueble'){
            if(getCookie('alquila')!=""){
                deleteCookie('alquila');
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
    }
}

function validarPrecio(campo, mensaje){
    $('#mensaje'+campo).html('');
    if(mensaje < 300){
        $('#mensaje'+campo).html('El número de este campo debe ser superior a 200.');
    }
}

function validarMetrosCuadrados(campo , mensaje){
    $('#mensaje'+campo).html('');
    if(mensaje < 30){
        $('#mensaje'+campo).html('El número minimo que debes poner es de 30 metros cuadrados.');
    }
}

function validarArchivos(campo, archivos){
    if(campo == 'masImagenes'){
        if(archivos.length > 3){
            $('#mensaje'+campo).html('Como máximo puedes selecionar tres imagenes');
        }else{
            for(var i = 0 ; i<archivos.length ; i++){
                var nombre = archivos[i]['name'];
                nombre = nombre.split('.');
                if(nombre[nombre.length-1] != 'jpg' && nombre[nombre.length-1] != 'png'){
                    $('#mensaje'+campo).html('La extensión del archivo debe ser .jpg o .png');
                    break;
                }
            }
        }

    }else{
        var extension = archivos.split('.');
        if(extension[extension.length-1] != 'jpg' && extension[extension.length-1] != 'png'){
            $('#mensaje'+campo).html('La extensión del archivo debe ser .jpg o .png');
        }
    }
}

function validarFianza(campo, mensaje){
    $('#mensaje'+campo).html('');
    var minimo = parseInt($('#precio').val())*2;
    var maximo = parseInt($('#precio').val())*4;
    if(parseInt(mensaje) < minimo){
        $('#mensaje'+campo).html('La fianza debe ser como mínimo 2 meses');
    }else if(parseInt(mensaje) > maximo){
        $('#mensaje'+campo).html('La fianza debe ser como máximo 4 meses');
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

function escribirFechaFormato(fecha){
    var arrayFecha = fecha.split('-');
    return arrayFecha[2] + '/' + arrayFecha[1] + '/' + arrayFecha[0]
}


function comprobarLogintudTexto(campo, valor){
    $('#mensaje'+campo).html('');
    if(valor.length > 40){
        $('#mensaje'+campo).html('Este campo no puede tener mas de 40 caracteres');
    }
}
function comprobarDniNie(campo, valor){
    $('#mensaje'+campo).html('');
    if(valor.length == 9){
        var dni = valor.toUpperCase();
        var letra = dni[8];
        var numeros = "";
        for (var i = 0 ;i<dni.length-1; i++){
            if(i == 0 ){
                numeros = dni[i]; 
            }else{
                numeros += dni[i];
            }
        }
        if(numeros[0] == 'X'){
            numeros[0] = 0
        }else if (numeros[0] == 'Y'){
            numeros[0] = 1
        }else{
            numeros[0] = 2
        }

        var modulo = parseInt(numeros) % 23;
        var letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
        var letra_correcta = letras[modulo];
        if(letra != letra_correcta){
            $('#mensaje'+campo).html('DNI o NIE incorrecto');
        }

    }else{
        $('#mensaje'+campo).html('Este campo debe tener 9 caracteres');

    }
}

function comprobarTelefono(campo, valor){
    $('#mensaje'+campo).html('');
    if(valor.length == 9){
        if(valor[0] != 6 && valor[0] != 7){
            $('#mensaje'+campo).html('El número empieza incorrectamente');
        }
    }else{
        $('#mensaje'+campo).html('Logitud del telefono incorrecta');
    }
}

function comprobarFecha(campo, valor){
    $('#mensaje'+campo).html('');
    var fechaSis = new Date();
    var fechaElegida = new Date(valor);

    if(fechaElegida > fechaSis){
        $('#mensaje'+campo).html('La fecha elegida no puede ser mayor a la que te encuentras');
    }else{
        if(fechaSis.getFullYear() - fechaElegida.getFullYear() < 18){
            $('#mensaje'+campo).html('Debes ser mayor de edad para registrarte');
        }else if(fechaSis.getFullYear() - fechaElegida.getFullYear() == 18){
            if(fechaSis.getMonth()+1 == fechaElegida.getMonth()+1){
                if(fechaSis.getMonth()+1 > fechaElegida.getMonth()+1){
                    $('#mensaje'+campo).html('Debes ser mayor de edad para registrarte');
                }
            }else if(fechaSis.getMonth()+1 > fechaElegida.getMonth()+1){
                $('#mensaje'+campo).html('Debes ser mayor de edad para registrarte');
            }
        }
    }
}

function comprobarCorreoElectronico(campo, valor){
    $('#mensaje'+campo).html('');
    var expresionRegular = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
    if(!expresionRegular.test(valor)){
        $('#mensaje'+campo).html('Formato de email incorrecto');
    }
}

function comprobarContrasenya(campo, valor){
    $('#mensaje'+campo).html('');
    if(campo == 'passwordRegister'){
        if(valor.length < 8){
            $('#mensaje'+campo).html('La contraseña debe tener 8 caracteres, un número y una letra');
        }else{
            var expresionRegular = new RegExp('[^0-9]+');
            if(!expresionRegular.test(valor)){
                $('#mensaje'+campo).html('La contraseña debe tener 8 caracteres, un número y una letra');
            }
            var letraMayus = false
            for(var i = 0 ; i<valor.length; i++){
                if(valor[i] == valor[i].toUpperCase() && isNaN(valor[i])){
                    letraMayus = true;
                    break;
                }
            }
            if(letraMayus == false){
                $('#mensaje'+campo).html('La contraseña debe tener 8 caracteres, un número y una letra');
            }

        }
    }else{
        if(valor != $('#passwordRegister').val()){
            $('#mensaje'+campo).html('La contraseña debe ser igual a la del campo anterior');
        }
    }
}

