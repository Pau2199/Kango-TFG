$(function(){
    var ANYOPrin = 20;
    $(window).bind("beforeunload", function() {
        if(getCookie('alquila')!=""){
            deleteCookie('alquila');
        }   
    });
    deleteCookie('alquila');

    $('#fechaDuracionDiv').hide();
    $('#mensajeInfo').hide();

    $('.nav-tab-datosPer').addClass('bg-warning');
    $('button').click(function(){
        if($(this).attr('href') != null){
            $('li').each(function(){
                $(this).removeClass('bg-warning')
            })
            var clase = $(this).attr('href').split('#');
            $('.'+clase[1]).addClass('bg-warning'); 
        }
        $('button').each(function(){
            $(this).removeClass('active');
        });
    });

    $('input').blur(function(){
        var fechaSis = new Date();
        if($(this).val() == ""){
            $('#mensaje'+$(this).attr('id')).html('El campo no puede estar vacio');
        }else{
            if($(this).attr('id') == 'numeroCuenta'){
                $(this).val($(this).val().toUpperCase());
                var separacion = "";
                var numero = $(this).val().replace(/ /g, "");
                for(var i = 0 ; i<numero.length; i++){
                    if(i != 0 && i%4 == 0){
                        separacion += " ";
                    }
                    separacion += numero[i];
                }
                $(this).val(separacion);
                comprobarNumeroCuenta($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'username'){
                comprobarUserName($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'numeroTarjeta'){
                var numeroTarjeta = $(this).val().replace(/ /g, "");
                var numeroTarjetaEspacio = "";
                for (var i = 0 ; i<numeroTarjeta.length ; i++){
                    if(i != 0 && i%4 == 0){
                        numeroTarjetaEspacio += " ";
                    }
                    numeroTarjetaEspacio += numeroTarjeta[i];
                }
                $(this).val(numeroTarjetaEspacio);
                comprobarTarjeta($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'cvv'){
                comprobarCvv($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'mes'){
                var mes = "";
                if($(this).val().length == 2 && $(this).val()[0] == 0){
                    mes = $(this).val()[1];
                    console.log(mes);
                }else{
                    mes = $(this).val();
                }
                fechaAlquiler($(this).attr('id'), mes);
                if($(this).val().length == 1){
                    $(this).val(0+$(this).val());
                }
            }
            if($(this).attr('id') == 'anyo'){
                fechaAlquiler($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'fechaInicio'){
                fechaAlquiler($(this).attr('id'), $(this).val());
            } 

        }
    });

    $('select').blur(function(){
        validarSelect($(this).attr('id'), $(this).val());
    });

    $('#segundoPaso').click(function(){
        var error = false;
        $('input').each(function(){
            if($(this).attr('id') != 'fechaDuracion' &&  $(this).val() == ""){
                $('#mensaje'+$(this).attr('id')).html('El campo no puede estar vacio');
            }else{
                if($(this).attr('id') == 'numeroCuenta'){
                    comprobarNumeroCuenta($(this).attr('id'), $(this).val());
                }
                if($(this).attr('id') == 'username'){
                    comprobarUserName($(this).attr('id'), $(this).val());
                }
                if($(this).attr('id') == 'numeroTarjeta'){
                    comprobarTarjeta($(this).attr('id'), $(this).val());
                }
                if($(this).attr('id') == 'cvv'){
                    comprobarCvv($(this).attr('id'), $(this).val());
                }
                if($(this).attr('id') == 'mes'){
                    var mes = "";
                    if($(this).val().length == 2 && $(this).val()[0] == 0){
                        mes = $(this).val()[1];
                    }
                    fechaAlquiler($(this).attr('id'), mes);
                }
                if($(this).attr('id') == 'anyo'){
                    fechaAlquiler($(this).attr('id'), $(this).val());

                }

                if($(this).attr('id') == 'fechaInicio'){
                    fechaAlquiler($(this).attr('id'), $(this).val());
                }  
            }
        });

        $('strong').each(function(){
            if($(this).html() != ''){
                error = true;
            }
        });
        if(error == false){
            if($('#segundoPaso').attr('href') == null){
                $('#segundoPaso').attr('href', '#nav-tab-continuar');
                $('#segundoPaso').trigger('click');   
            }else{
                var id = window.location.href.split('/')[5];
                $.ajax({
                    url: '/inmueble/obtenerDatos',
                    method: 'POST',
                    data:   {idInm: id, _token: $('#token').val()},
                    success: function(data){
                        $('#mensualidad').html('Mensualidad: ' + data['precio'][0]['precio'] + ' €');
                        $('#fianza').html('Importe a Pagar: ' + data['fianza'][0]['fianza'] + ' €');
                    }
                });   
                $('#cuenta').html('Nº Cuenta: ' + $('#numeroCuenta').val());
                if($('#duracion').val() == 'FechaConcreta'){
                    $('#tiempo').html('Tiempo de Alquiler: ' + $('#fechaDuracion').val());
                }else{
                    $('#tiempo').html('Tiempo de Alquiler: Indefinido');
                }
                $('#titular').html('Titular: ' + $('#username').val());
                $('#tarjeta').html('NºTarjeta: ' + $('#numeroTarjeta').val());
            }

        }else{
            $('#segundoPaso').removeClass('active');
            $('#texto').html('El formulario contiene errores, corrigelos para poder continuar');
            $('#mensajeInfo').addClass('bg-danger');
            $('#mensajeInfo').show();
        }
    });

    $('#pagar').click(function(){   
        var id = window.location.href.split('/')[5];
        $.ajax({
            url: '/inmueble/realizarPago/'+id,
            method: 'POST',
            data:  $('#formDatos').serialize(),
            success: function(data){
                console.log(data);
                if(data == ""){
                    $('#texto').html('Petición de alquiler enviada correctamente, proximamente recibiras una respuesta del propietario');
                    $('#mensajeInfo').addClass('bg-sucess');
                    $('#mensajeInfo').show();

                }else{
                    $('#texto').html(data);
                    $('#mensajeInfo').addClass('bg-danger');
                    $('#mensajeInfo').show();

                }
            }
        });
        var padre = $(this).parent();
        $(this).remove();
        var a = $('<a>').attr('href', '/');
        var span = $('<span>').attr('id', 'Volver').addClass('btn btn-warning shadow-sm rounded-pill').html('Volver a Inicio');
        a.append(span);
        padre.append(a)
    })


    function fechaAlquiler(campo, valor){
        $('#mensaje'+campo).html('');
        var fechaElegida = new Date(valor);
        var fechaSis = new Date();
        if(campo == 'fechaInicio'){
            if(fechaElegida < fechaSis){
                $('#mensaje'+campo).html('El alquiler debe ser para este año');                
            }
        }else if(campo == 'mes'){
            console.log('entra');
            console.log('Elegida ' + (fechaElegida.getMonth()+1))
            console.log('Sis ' + (fechaSis.getMonth()+1))
            if((fechaElegida.getMonth()+1) < (fechaSis.getMonth()+1) || (fechaElegida.getMonth()+1) > (fechaSis.getMonth()+1)){
                $('#mensaje'+campo).html('El mes introducido es incorrecto');                
            }
        }else{
            if( valor.length == 2){
                valor = ANYOPrin + valor;
            }
            if(parseInt(valor) < fechaSis.getFullYear() || valor > fechaSis.getFullYear()){
                $('#mensaje'+campo).html('El año introducido es incorrecto');                
            }
        }
    }

    function comprobarCvv(campo, valor){
        $('#mensaje'+campo).html('');
        if(valor.length > 3 || valor.length < 3){
            $('#mensaje'+campo).html('El CVV introducido es incorrecto');                
        }
    }

    function comprobarTarjeta(campo, valor){
        $('#mensaje'+campo).html('');
        if(valor.replace(/ /g, "").length > 16 || valor.replace(/ /g, "").length < 16){
            $('#mensaje'+campo).html('El número de la tarjeta es incorrecto');                
        }else{
            if(isNaN(valor.replace(/ /g, ""))){
                $('#mensaje'+campo).html('El número de la tarjeta no puede contener letras');                
            }
        }
    }

    function comprobarUserName(campo, valor){
        $('#mensaje'+campo).html('');
        if(valor.length > 50){
            $('#mensaje'+campo).html('El nombre introducido tiene demasiados caracteres');                
        }
    }

    function comprobarNumeroCuenta(campo, valor){
        $('#mensaje'+campo).html('');
        if(valor.replace(/ /g, "").length < 24 || valor.replace(/ /g, "").length > 24){
            $('#mensaje'+campo).html('El número de cuenta es incorrecto');                
        }else if(valor.replace(/ /g, "").indexOf('ES') == -1){
            $('#mensaje'+campo).html('El número de cuenta debe tener dos letras al principio');                
        }else{
            var numeroCuenta = valor.replace(/ /g, "");
            var numeroCuentaSinLetra = "";
            for(var i = 2 ; i<numeroCuenta.length; i++){
                numeroCuentaSinLetra+= numeroCuenta[i];
            }
            if(isNaN(numeroCuentaSinLetra)){
                $('#mensaje'+campo).html('El número de cuenta solo puede tener dos letras al principio');                
            }
        }
    }

    function validarSelect(campo, valor){
        $('#mensaje'+campo).html('');
        if(valor == '-'){
            $('#mensaje'+campo).html('Debes selecionar una opción correcta');                
        }
    }

});