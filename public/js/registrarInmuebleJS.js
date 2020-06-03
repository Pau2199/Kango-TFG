$(function(){
    $('#fianza').hide();
    $('#extraAlquiler').hide();

    $('#perfil').change(function(){
        $('#labelImagenPefil').html($(this).val().split('\\')[2]);
    })
    $('#masImagenes').change(function(){
        $('#labelmasImagenes').html($('#masImagenes')[0].files.length + ' Elementos Selecionados'); 
    })

    $.ajax({
        url: '/inmueble/cargarProvinciasInm',
        method: 'GET',
        success: function(data){
            for (var i = 0 ; i<data.length ; i++){
                var option = $('<option>').attr('value', data[i]['nombre']).html(data[i]['nombre']);
                $('#provincia').append(option);   
            }
        }
    });

    $('#provincia').change(function(){
        if($(this).val() != '-'){
            var selecionada = $(this).val().trim();
            $.ajax({
                url: '/inmueble/cargarLocalidadesInm/'+selecionada,
                method: 'GET',
                success: function(data){
                    $('#localidad option').remove();
                    var option = $('<option>').attr({
                        value: '-',
                        selected: true
                    });
                    option.html('-');
                    $('#localidad').append(option);
                    for(var i = 0 ; i<data.length ; i++){
                        option = $('<option>').attr('value', data[i].nombre);
                        option.html(data[i].nombre);
                        $('#localidad').append(option);
                    }
                }
            });
        }
    });


    $('#tipoCompra').change(function(){
        if($('#tipoCompra').val() == 'A'){
            $('#fianza').show();
            $('#extraAlquiler').show();
        }else{
            $('#fianza').hide();
            $('#extraAlquiler').hide();
        }
    })

    $('input').blur(function(){
        $('#mensaje'+$(this).attr('id')).html('');
        if($(this).val() == "" && $(this).attr('id') != 'nPiso' && $(this).attr('id') != 'nPatio' && $(this).attr('id') != 'masImagenes'){
            $('#mensaje'+$(this).attr('id')).html('Este campo es obligatorio');
        }else{
            if($(this).attr('id') == 'provincia' || $(this).attr('id') == 'localidad' || $(this).attr('id') == 'nombreDir'){
                validarProvinciaLocalidadNombre($(this).attr('id'), $(this).val());
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
            if($(this).attr('id') == 'masImagenes'){
                var array = $('#masImagenes')[0].files;
                validarArchivos($(this).attr('id'), array);
            }
            if($(this).attr('id') == 'perfil'){
                validarArchivos($(this).attr('id'), $(this).val());
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
            if($(this).attr('id') == 'masImagenes'){
                var array = $('#masImagenes')[0].files;
                validarArchivos($(this).attr('id'), array);
            }
            if($(this).attr('id') == 'perfil'){
                validarArchivos($(this).attr('id'), $(this).val());
            }
        })

        $('select').each(function(){
            validarSelect($(this).attr('id'), $(this).val());
        })

        if($('#tipoCompra').val() == 'A'){
            validarFianza('fianza', $('#fianzaInput').val());
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


