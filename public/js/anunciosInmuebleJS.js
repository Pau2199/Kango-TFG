$(function(){
    var idInmuebleUser = $('#idInmuebleUser').val();
    var idUser = $('#idUser').val();
    $('#idInmuebleUser').remove();
    $('#idUser').remove();
    $('#modificarInm').hide();
    $('#vertical').hide();
    $('#mensajeInfo').hide();

    $('.favoritos').click(function(){
        var id = window.location.href.split('/')[5];
        var eliminar = 0;
        var boton = $(this);
        if($(this).html().trim() == 'Quitar de Favoritos'){
            eliminar = 1;
        }

        if(idUser != null){
            $.ajax({
                url: '/favoritos/agregarFavoritos',
                method: 'POST',
                data: {eliminarFav: eliminar, idUser: idUser, idInmueble: id, "_token": $('#token').val()},
                success: function(data){
                    if(eliminar == 0){
                        boton.html('Quitar de Favoritos');
                    }else{
                        boton.html('Añadir a Favoritos');
                    }
                }
            });
        }else{
            if(eliminar == 1){
                if(getCookie('favoritos') != ""){
                    var inmuebles = "";
                    var array = getCookie('favoritos').split(',');
                    for(var i = 0 ; i<array.length; i++){
                        if(array[i] != id){
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
                    boton.html('Añadir a Favoritos');
                    if(inmuebles == ""){
                        deleteCookie('favoritos');
                    }else{
                        setCookie('favoritos', inmuebles, 999999999);
                    }
                }
            }else{
                var error = false;
                if(getCookie('favoritos') != ""){
                    var favoritos = getCookie('favoritos').split(',');
                    console.log(favoritos);
                    for(var i = 0; i<favoritos.length ; i++){
                        if(favoritos[i] == id){
                            error = true;
                            break;
                        }
                    }
                    if(error == false){
                        boton.html('Quitar de Favoritos');
                        setCookie('favoritos', getCookie('favoritos') + ',' + id ,999999999);
                    }
                }else{
                    boton.html('Quitar de Favoritos');
                    setCookie('favoritos', id ,999999999);

                }   
            }
        }
    })
    $('#solicitar').click(function(){
        $('#botones').hide();
        var form = $('<form>').attr('id', 'formHorarioVisita');
        var divRow = $('<div>').attr('class', 'form-row');
        var divGroupDate = $('<div>').attr({
            class: 'form-group col-md-12',
            id: 'groupDate'});
        var label = $('<label>').attr({
            class: 'font-weight-bold',
            for: 'fecha'
        }).html('Fecha Deseada');
        divGroupDate.append(label);
        var dataPicker = $('<input>').attr({
            type: 'date',
            name: 'fecha',
            id: 'datapicker',
            class: 'form-control',
            value: '2020/05/21'
        });
        divGroupDate.append(dataPicker);
        var strong = $('<strong>').attr('id', 'mensajedatapicker');
        divGroupDate.append(strong);
        divRow.append(divGroupDate);
        var divGroupSelect = $('<div>').attr({class: 'form-group col-md-6',
                                              id: 'divSelect'});
        var labelSelect = $('<label>').attr({
            class: 'font-weight-bold',
            for: 'horas'
        }).html('Hora Deseada');
        divGroupSelect.append(labelSelect);
        var select = $('<select>').attr({
            name: 'hora',
            class: 'form-control',
            id: 'selectHoras'
        });
        divGroupSelect.append(select);
        strong = $('<strong>').attr('id', 'mensajeselectHoras');
        divGroupSelect.append(strong);
        divRow.append(divGroupSelect);
        form.append(divRow);

        var button = $('<span>').attr({
            class: 'btn bg-success',
            id: 'solVisita'
        }).html('Solicitar Visita');
        form.append(button);
        $('#agregarForm').append(form);
        $('#divSelect').hide();
    });
    $('#agregarForm').on('change', 'input#datapicker', function(){
        $('#selectHoras').children().remove();
        var dias = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
        console.log($(this).val());
        var date = new Date($(this).val());
        var dia = dias[date.getDay()]
        $.ajax({
            url: '/obtenerHorarioPropietario',
            method: 'POST',
            data: {idUser: idInmuebleUser, nombreDia: dia, "_token": $('#token').val()},
            success: function(data){
                var option = $('<option>').attr({value: '-',
                                                 selected: true}).html('-');
                $('#selectHoras').append(option);
                for (var i = 0 ; i<data.length ; i++){
                    option = $('<option>').attr('value', data[i]['inicio'] + '-' + data[i]['final']).html(data[i]['inicio'] + '-' + data[i]['final']);
                    $('#selectHoras').append(option);
                }
                $('#groupDate').removeClass('col-md-12');
                $('#groupDate').addClass('col-md-6');
                $('#divSelect').show();

            }
        });
    });

    $('#agregarForm').on('click', 'span#solVisita', function(){
        var error = false;
        $('#mensajedatapicker').html('');
        $('#mensajeselectHoras').html('');
        if($('#datapicker').val() == ""){
            error = true;
            $('#mensajedatapicker').html('Debes selecionar una fecha');
        }else{
            var fechaSis = new Date();
            var fechaElegida = new Date($('#datapicker').val());
            if(fechaSis.getFullYear() != fechaElegida.getFullYear()){
                error = true;
                $('#mensajedatapicker').html('La fecha que seleciones debe ser para el año ' + fechaSis.getFullYear());
            }else if((fechaElegida.getMonth()+1) - (fechaSis.getMonth()+1) >= 2){
                error = true;
                $('#mensajedatapicker').html('La fecha que seleciones no debe ser superior a dentro de 2 meses');
            }else if(fechaElegida.getDate() == fechaSis.getDate() ){
                error = true;
                $('#mensajedatapicker').html('La fecha que seleciones no puede ser para el mismo dia');
            }else if(fechaElegida.getDate() < fechaSis.getDate()){
                if((fechaElegida.getMonth()+1) <= (fechaSis.getMonth()+1)){
                    error = true;
                    $('#mensajedatapicker').html('No puedes elegir para una fecha menor a la que te encuentras');   
                }
            }
        }

        if($('#selectHoras').val() == '-'){
            $('#mensajeselectHoras').html('Debes selecionar una hora');
        }

        if(error == false){
            var idInmueble = window.location.href.split('/')[5].split('-')[1];
            console.log(idInmueble);
            $.ajax({
                url: '/enviarSolicitudVisita',
                method: 'POST',
                data: {inmueble:idInmueble, propietario: idInmuebleUser, usuarioSolicitante: idUser, fecha: $('#datapicker').val(), hora: $('#selectHoras').val(),"_token": $('#token').val()},
                success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    if(error = true){
                        $('#texto').html(data.mensaje);
                        $('#mensajeInfo').removeClass('bg-success');
                        $('#mensajeInfo').addClass('bg-danger');
                        $('#mensajeInfo').show();
                    }else{
                        $('#mensajeInfo').removeClass('bg-danger');
                        $('#texto').html('Solicitud de visita enviada correctamente!');
                    }
                    $('html, body').animate({scrollTop: 0},1000);
                    $('#formHorarioVisita').remove();
                    $('#botones').show();
                }
            });
        }


    });


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
        if(idInmuebleUser != idUser){
            alert('No eres el propietario de este inmueble, se va a recargar la página.')
            location.reload();
        }else{
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
