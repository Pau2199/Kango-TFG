$(function(){
    var fecha = $('.fecha').each(function(){
        $(this).html(escribirFechaFormato($(this).html()));
    });

    $('.border').click(function(){
        $('#mensajeTexto').html('Cargando datos... Por favor Espere!')
        var idSol = $(this).attr('id').split('/')[1].split('-')[1];
        var idNoti = $(this).attr('id').split('/')[0].split('-')[1];
        console.log(idSol);
        console.log(idNoti);
        var via = {A: 'Avenida', C: 'Calle', Plaza: 'Plaza'};
        $(this).removeClass('border-success');
        $(this).addClass('border-info');
        $.ajax({
            url: '/notificaciones/obtenerInformaciónNotificacion',
            method: 'POST',
            data:   {idSol: idSol, idNoti: idNoti, _token: $('#token').val()},
            success: function(data){
                $('#mensaje').children().remove();
                data = JSON.parse(data);
                console.log(data['tipoNoti']);
                var pSaludo = $('<p>').attr('class', 'font-weight-bold').html('Hola ' + data['nombreUserLogin'] + ',');
                var pTexto = "";
                var pClick = "";
                if(data['tipoNoti'].trim() == 'Recibida'){
                    console.log('entra');
                    pTexto = $('<p>').html('El usuario ' + data['infoUser']['nombre'] + ' ' + data['infoUser']['primer_apellido'] + ' ' + data['infoUser']['segundo_apellido'] + ' te ha solicitado una visita el dia ' + '<span class="font-weight-bold">' + escribirFechaFormato(data['infoSolicitud']['fecha_solicitada'])+ '</span>' + ' de ' + '<span class="font-weight-bold">' + data['infoSolicitud']['hora'] + '</span> en el inmueble situado en la ' + '<span class="font-weight-bold"> ' + via[data['direccionInmuebleSolicitado']['tipo_de_via']] + ' ' + data['direccionInmuebleSolicitado']['nombre_de_la_direccion'] + ', ' + data['direccionInmuebleSolicitado']['provincia'] + '</span>');
                    pClick  = $('<p>').html('Haz <a href="/perfil/solicitudesVisita">click aquí </a> para gestionar la solicitud');
                }else{
                    pTexto = $('<p>').html('El usuario ' + data['infoUser']['nombre'] + ' ' + data['infoUser']['primer_apellido'] + ' ' + data['infoUser']['segundo_apellido'] + ' te ha ' + data['tipoNoti'].toLowerCase() + ' tu solicitud de visita para el dia ' + '<span class="font-weight-bold">' + escribirFechaFormato(data['infoSolicitud']['fecha_solicitada'])+ '</span>' + ' de ' + '<span class="font-weight-bold">' + data['infoSolicitud']['hora'] + '</span> en el inmueble situado en la ' + '<span class="font-weight-bold"> ' + via[data['direccionInmuebleSolicitado']['tipo_de_via']] + ' ' + data['direccionInmuebleSolicitado']['nombre_de_la_direccion'] + ', ' + data['direccionInmuebleSolicitado']['provincia'] + '</span>');
                }
                var span = $('<span>').html('Un Saludo!');

                var div = $('<div>').attr('class', 'text-center');
                var spanButton = $('<span>').attr({
                    class: 'btn btn-danger',
                    id: 'eliminarNotificacion'
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
});

function escribirFechaFormato(fecha){
    var arrayFecha = fecha.split('-');
    return arrayFecha[2] + '/' + arrayFecha[1] + '/' + arrayFecha[0]
}