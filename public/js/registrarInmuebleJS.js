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
        if($(this).val() == "" && $(this).attr('id') != 'nPiso' && $(this).attr('id') != 'nPatio'){
            $('#mensaje'+$(this).attr('id')).html('Este campo es obligatorio');
        }else{
            if($(this).attr('id') == 'provincia' || $(this).attr('id') == 'localidad' || $(this).attr('id') == 'nombreDir'){
                validarProvinciaLocalidadNombre($(this).attr('id'), $(this).val());
            }
            /*if($(this).attr('id') == 'nPatio'){
                validarPatioPiso($(this).attr('id'), $(this).val());
            }*/
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
    });

});


