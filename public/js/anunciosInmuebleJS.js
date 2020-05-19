$(function(){
    var idInmuebleUser = $('#idInmuebleUser').val();
    var idUser = $('#idUser').val();
    $('#idInmuebleUser').remove();
    $('#idUser').remove();
    $('#modificarInm').hide();
    $('#vertical').hide();
    $('#mensajeInfo').hide();

    $('#botonModificacion').click(function(){
        if($(this).html() == 'Activar Edición'){
            if(idInmuebleUser != idUser){
                alert('No eres el propietario de este inmueble, se va a recargar la página.')
                location.reload();
            }else{
                $('#datosInm').hide();
                $('#horizontal').hide();
                $('#vistaInmueble').hide();
                $('#modificarInm').show();
                $('#vertical').show();
                $('#masImg').hide();
                $('#perf').hide();
                $('#divButton').hide();

                var direccion = $('#direccion').html().split(' ');
                for(var i = 0; i<direccion.length ; i++){
                    if(direccion[i].trim() == 'Calle'){
                        $('#C').attr('selected', 'true');
                    }else if(direccion[i].trim() == 'Avenida'){
                        $('#A').attr('selected', 'true');
                    }else if(direccion[i].trim() == 'Plaza'){
                        $('#P').attr('selected', 'true');
                    }else{
                    }if(direccion[i] == 'Piso'){
                        $('#nPiso').val(parseInt(direccion[i+1]));
                    }else if(direccion[i].split('')[0] == ','){
                        var patio = '';
                        var arrayPatio = direccion[i].split('');
                        var cont = 0;
                        while(cont <= arrayPatio.length){
                            cont++
                            patio += arrayPatio[cont]
                        }
                    }else if(direccion[i].trim() == 'Bloque'){
                        $('#bloque').val(direccion[i+1]);
                    }else if(direccion[i].trim() == 'Escalera'){
                        $('#escalera').val(direccion[i+1]);
                    }
                }
            }

            var direccion = $('h2').html().split(' ');
            var opcion = direccion[32].trim();
            for(var i = 0 ; i<direccion.length ; i++){
                if(direccion[i] == 'Barrio' && direccion[i+1] == 'de'){
                    var cont = i+2;
                    var barrio = "";
                    while(direccion[cont] != ""){
                        barrio+= direccion[cont] + " ";
                        cont++;
                    }
                    $('#barrio').val(barrio.trim());
                }else if(direccion[i] == 'de'){
                    if(direccion[96].trim() == 'Piso'){
                        $('#Pi').attr('selected', 'true');
                    }else if(direccion[96].trim() == 'Duplex'){
                        $('#Du').attr('selected', 'true');
                    }else if(direccion[96].trim() == 'Adosado'){
                        $('#Ad').attr('selected', 'true');
                    }else if(direccion[96].trim() == 'Chalet'){
                        $('#Ch').attr('selected', 'true');
                    }else if(direccion[96].trim() == 'Bajo'){
                        $('#Ba').attr('selected', 'true');
                    }
                }
            }

            if($('#piscina').html().trim() == 'Sí'){
                $('#formPiscina').attr('checked', true);
            }
            if($('#garaje').html().trim() == 'Sí'){
                $('#formGaraje').attr('checked', true);
            }
            if($('#ascensor').html().trim() == 'Sí'){
                $('#formAscensor').attr('checked', true);
            }
            if(opcion == 'Alquiler'){
                if($('#calefaccion').html().trim() == 'Sí'){
                    $('#formCalefaccion').attr('checked', true);
                }
                if($('#animales').html().trim() == 'Sí'){
                    $('#formAnimales').attr('checked', true);
                }
                if($('#reformas').html().trim() == 'Sí'){
                    $('#formReformas').attr('checked', true);
                }
                if($('#internet').html().trim() == 'Sí'){
                    $('#formInternet').attr('checked', true);
                }
                if($('#aireAcondicionado').html().trim() == 'Sí'){
                    $('#formAire').attr('checked', true);
                }   
            }

            if(opcion == 'Alquiler'){
                $('#formFianza').val(parseInt($('#fianza').html().split('Fianza:')[1].split('€')[0]));
            }
            $('#descripcion').html($('#desc').html());
        }else{

        }
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.botonesImagenes').click(function(){
        var imagen = $(this).attr('id');
        console.log(imagen);
        var boton = $(this);
        $.ajax({
            url: '/inmuebles/vistaInmueble/borrarImagen/'+imagen,
            method: 'GET',
            success: function(data){
                boton.parent().parent().remove();
                $('#divButton').show();
                if(imagen.includes('perfil') == true){
                    $('#perf').show();    
                }else{
                    $('#masImg').show();
                }
            }
        })
    })

    $('input').blur(function(){
        $('#mensaje'+$(this).attr('id')).html('');
        if($(this).val() == "" && $(this).attr('id') != 'nPiso' && $(this).attr('id') != 'nPatio'){
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
        }
    })
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

        $('strong').each(function(){
            if($(this).html() != ""){
                console.log($(this).html())
                errorEncontrado = true;
            }
        })
        if(errorEncontrado == false){
            var id = window.location.href.split('/')[5];
            $.ajax({
                url: '/inmuebles/vistaInmueble/modificar/'+id,
                method: 'POST',
                data: $('#formEditar').serialize(),
                success: function(data){
                    console.log(data);
                    $('html, body').animate({scrollTop: 0},1000)
                    $('#mensajeInfo').show();
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000)
                }
            })
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
            if(mensaje != 'A' && mensaje != 'P' && mensaje != 'D' && mensaje != 'C' && mensaje != 'B' && mensaje != 'C' && mensaje != 'A' && mensaje != 'P'){
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



})