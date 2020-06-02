$(function(){
    $('#mensajeInfo').hide();
    var fecha = $('.fecha').each(function(){
        $(this).html(escribirFechaFormato($(this).html()));
    });
    var click ="";
    $('.border').click(function(){
        $('#mensajeTexto').html('Cargando datos... Por favor Espere!')
        click = $(this);
        $('#mensajeInfo').hide();
        var idSol = $(this).attr('id').split('/')[1].split('-')[1];
        var idNoti = $(this).attr('id').split('/')[0].split('-')[1];
        console.log(idSol);
        console.log(idNoti);
        var via = {A: 'Avenida', C: 'Calle', P: 'Plaza'};
        $(this).removeClass('border-success');
        $(this).addClass('border-info');
        $.ajax({
            url: '/notificaciones/obtenerInformaciónNotificacion',
            method: 'POST',
            data:   {idSol: idSol, idNoti: idNoti, _token: $('#token').val()},
            success: function(data){
                console.log(data);
                $('#mensaje').children().remove();
                data = JSON.parse(data);
                console.log(data['tipoNoti']);
                var pSaludo = $('<p>').attr('class', 'font-weight-bold').html('Hola ' + data['nombreUserLogin'] + ',');
                var pTexto = "";
                var pClick = "";
                if(data['tipoNoti'].trim() == 'Recibida'){
                    console.log(data);
                    console.log('entra');
                    pTexto = $('<p>').html('El usuario ' + data['infoUser']['nombre'] + ' ' + data['infoUser']['primer_apellido'] + ' ' + data['infoUser']['segundo_apellido'] + ' te ha solicitado una visita el dia ' + '<span class="font-weight-bold">' + escribirFechaFormato(data['infoSolicitud']['fecha_solicitada'])+ '</span>' + ' de ' + '<span class="font-weight-bold">' + data['infoSolicitud']['hora'] + '</span> en el inmueble situado en la ' + '<span class="font-weight-bold"> ' + via[data['direccionInmuebleSolicitado']['tipo_de_via']] + ' ' + data['direccionInmuebleSolicitado']['nombre_de_la_direccion'] + ', ' + data['direccionInmuebleSolicitado']['idProvincia'][0]['nombre'] + '</span>');
                    pClick  = $('<p>').html('Haz <a href="/perfil/solicitudesVisita">click aquí </a> para gestionar la solicitud');

                }else if(data['tipoNoti'].trim() == 'Declinado'){
                    pTexto = $('<p>').html('El usuario ' + data['infoUser']['nombre'] + ' ' + data['infoUser']['primer_apellido'] + ' ' + data['infoUser']['segundo_apellido'] + ' te ha ' + data['tipoNoti'].toLowerCase() + ' tu solicitud de visita para el dia ' + '<span class="font-weight-bold">' + escribirFechaFormato(data['infoSolicitud']['fecha_solicitada'])+ '</span>' + ' de ' + '<span class="font-weight-bold">' + data['infoSolicitud']['hora'] + '</span> en el inmueble situado en la ' + '<span class="font-weight-bold"> ' + via[data['direccionInmuebleSolicitado']['tipo_de_via']] + ' ' + data['direccionInmuebleSolicitado']['nombre_de_la_direccion'] + ', ' + data['direccionInmuebleSolicitado']['idProvincia'][0]['nombre'] + '</span> <br> Lo sentimos :(');
                }else if(data['tipoNoti'].trim() == 'Aceptada'){
                    pTexto = $('<p>').html('El usuario ' + data['infoUser']['nombre'] + ' ' + data['infoUser']['primer_apellido'] + ' ' + data['infoUser']['segundo_apellido'] + ' te ha ' + data['tipoNoti'].toLowerCase() + ' tu solicitud de visita para el dia ' + '<span class="font-weight-bold">' + escribirFechaFormato(data['infoSolicitud']['fecha_solicitada'])+ '</span>' + ' de ' + '<span class="font-weight-bold">' + data['infoSolicitud']['hora'] + '</span> en el inmueble situado en la ' + '<span class="font-weight-bold"> ' + via[data['direccionInmuebleSolicitado']['tipo_de_via']] + ' ' + data['direccionInmuebleSolicitado']['nombre_de_la_direccion'] + ', ' + data['direccionInmuebleSolicitado']['idProvincia'][0]['nombre'] + '</span>');
                }else if(data['tipoNoti'] == 'Petición'){
                    pTexto = $('<p>').html('El usuario ' + data['infoUser']['nombre'] + ' ' + data['infoUser']['primer_apellido'] + ' ' + data['infoUser']['segundo_apellido'] + ' quiere alquilar el inmueble situado en la ' + via[data['direccionInmuebleSolicitado']['tipo_de_via']] + ' ' + data['direccionInmuebleSolicitado']['nombre_de_la_direccion'] + ', ' + data['direccionInmuebleSolicitado']['idProvincia'][0]['nombre'] + 'de manera indefinida por un precio de ' + data['precio']['precio'] + ' al mes <br> Ten en cuenta que el pago de la fianza solo se realizara cuando aceptes el alquiler');
                    pClick  = $('<p>').html('Haz <a href="/perfil/solicitudesAlquiler">click aquí </a> para gestionar la solicitud de alquiler');

                }else if(data['tipoNoti'] == 'Admitida'){
                    pTexto = $('<p>').html('El usuario ' + data['infoUser']['nombre'] + ' ' + data['infoUser']['primer_apellido'] + ' ' + data['infoUser']['segundo_apellido'] + ' <span class="font-weight-bold"> ha aceptado </span> tu petición de alquiler para el inmueble situado en la <span class="font-weight-bold">' + via[data['direccionInmuebleSolicitado']['tipo_de_via']] + ' ' + data['direccionInmuebleSolicitado']['nombre_de_la_direccion'] + ', ' + data['direccionInmuebleSolicitado']['idProvincia'][0]['nombre'] + '</span> <br> El alquiler comenzara el dia <span class="font-weight-bold">' + escribirFechaFormato(data['datosAlquiler'][0]['fecha_inicio']) + ' </span> por una mensualidad de <span class="font-weight-bold">' + data['precio']['precio'] +' € al mes </span> que se cobrara en el siguiente <span class="font-weight-bold">Nº de Cuenta: ' + data['datosAlquiler'][0]['numero_de_cuenta'] + '</span> <p>Puedes ponerte en contacto con tu arrendador vía email ' + data['infoUser']['email'] + '<br> Sí tienes algún problema no dudes en ponerte en contacto con nosotros en nuestro telefono (+54) 643 81 21 30 o por correco electronico info@kangooHome.com </p>');
                }else{
                    pTexto = $('<p>').html('El usuario ' + data['infoUser']['nombre'] + ' ' + data['infoUser']['primer_apellido'] + ' ' + data['infoUser']['segundo_apellido'] + 'ha rechazado tu petición de alquiler para el inmueble situado en la ' + via[data['direccionInmuebleSolicitado']['tipo_de_via']] + ' ' + data['direccionInmuebleSolicitado']['nombre_de_la_direccion'] + ', ' + data['direccionInmuebleSolicitado']['idProvincia'][0]['nombre'] + '<br> Lo sentimos :(');
                }
                var span = $('<span>').html('Un Saludo!');

                var div = $('<div>').attr('class', 'text-center');
                var spanButton = $('<span>').attr({
                    class: 'btn btn-danger',
                    id: 'N-' + data['idNotificacion'],
                }).html('Eliminar Notificación');
                div.append(spanButton);

                $('#mensaje').append(pSaludo);
                $('#mensaje').append(pTexto);
                if(pClick != ""){
                    $('#mensaje').append(pClick);
                }
                $('#mensaje').append(span);
                $('#mensaje').append(div);
            }
        });
    });

    $('#mensaje').on('click', 'span.btn-danger', function(){
        $('#mensaje').children().remove();
        click.remove();
        var id = $(this).attr('id').split('-')[1];
        $.ajax({
            url: '/notificaciones/borrarNotificación/'+id,
            methos: 'GET',
            success: function(){
                $('#texto').html('Notificación Borrada correctamente');
                $('#mensajeInfo').show();
                $('#mensaje').children().remove();
                click.remove();
                $('#mensaje').html('Haz click sobre una notificación');

            }
        })
    })
});

function escribirFechaFormato(fecha){
    var arrayFecha = fecha.split('-');
    return arrayFecha[2] + '/' + arrayFecha[1] + '/' + arrayFecha[0]
}