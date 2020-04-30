$(function(){
    $('#fianza').hide();
    $('#extraAlquiler').hide();

    $('#perfil').change(function(){
        $('#labelImagenPefil').html($(this).val().split('\\')[2]);
    })
    $('#masImagenes').change(function(){
        $('#labelmasImagenes').html($('#masImagenes')[0].files.length + ' Elementos Selecionados'); 
    })




    $('#tipoCompra').change(function(){
        console.log($('#opcionAlquiler option:selected').text());

        if($('#tipoCompra').val() == 'A' || $('#tipoCompra').val() == 'AQ'){
            $('#fianza').show();
            $('#extraAlquiler').show();
        }else{
            $('#fianza').hide();
            $('#extraAlquiler').hide();
        }
    })

    $('input').blur(function(){
        $('#mensaje'+$(this).attr('id')).html('');
        if($(this).val() == "" && $(this).attr('id') != 'nPiso'){
            $('#mensaje'+$(this).attr('id')).html('Este campo es obligatorio');
        }else{
            if($(this).attr('id') == 'provincia' || $(this).attr('id') == 'localidad' || $(this).attr('id') == 'nombreDir'){
                validarProvinciaLocalidadNombre($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'nPatio'){
                validarPatioPiso($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'nHabitaciones'){
                validarHabitaciones($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'nCuartosBanyo'){
                validarCuartosBanyo($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'precio' || $(this).attr('id') == 'fianza'){
                validarPrecio($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'nMetrosCuadrados'){
                validarMetrosCuadrados($(this).attr('id'), $(this).val());
            }
        }

    });

    $('select').blur(function(){
        validarSelect($(this).attr('id'), $(this).val());
    })


    $('#botonRegistro').click(function(){
        event.preventDefault();
        var errorEncontrado = false;
        $('input').each(function(){
            if($(this).attr('id') == 'provincia' || $(this).attr('id') == 'localidad' || $(this).attr('id') == 'nombreDir'){
                validarProvinciaLocalidadNombre($(this).attr('id'), $(this).val());
            }

            if($(this).attr('id') == 'nPatio'){
                validarPatioPiso($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'nHabitaciones'){
                validarHabitaciones($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'nCuartosBanyo'){
                validarCuartosBanyo($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'precio'){
                validarPrecio($(this).attr('id'), $(this).val());
            }
            if($(this).attr('id') == 'nMetrosCuadrados'){
                validarMetrosCuadrados($(this).attr('id'), $(this).val());
            }


        })

        $('select').each(function(){
            validarSelect($(this).attr('id'), $(this).val());
        })

        if($('#tipoCompra').val() == 'A' ||  $('#tipoCompra').val() == 'AQ'){
            validarFianza('fianza', $('#fianza').val());
        }

        $('#mensajeperfil').html('');
        if($('#perfil').val == ""){
            $('#mensajeperfil').html('Este campo no puede estar vacio');
        }

        $('strong').each(function(){
            if($(this).html() != ""){
                errorEncontrado = true;
            }
        })
        if(errorEncontrado == false){
            formAgregarInmueble.submit();
        }
        console.log(errorEncontrado);
    })

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



})


