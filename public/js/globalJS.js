$(function(){
    $.ajax({
        url: '/obtenerNotificaciones',
        method: 'GET',
        success: function(data){
            if(data.length > 0){
                var sup = $('<sup>').addClass('font-weight-bold text-danger tamanyoTexto').html(data.length);
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
        console.log(campo)
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
    console.log(minimo);
    console.log(maximo);
    if(mensaje < minimo && mensaje > maximo){
        $('#mensaje'+campo).html('La fianza debe ser como mínimo 2 meses y como máximo 4 meses.');
    }

}