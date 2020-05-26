$(function(){
    var direccion = {A: 'Avenida', P: 'Plaza', C: 'Calle'}
    $('.direccion').each(function(){
        var split = $(this).html().split(' ');
        var letra = split[0];

        $(this).html(direccion[letra] + ' ');
        for(var i = 1 ; i<split.length ; i++){
            $(this).append(split[i] + ' ');
        }  
    });

    $('.fecha').each(function(){
        var fecha = $(this).html();
        $(this).html(escribirFechaFormato(fecha));
    });

    $('.btn-danger').click(function(){
        var idSolicitud = $(this).parent().parent().attr('id');
        var idUsuarioSolicitante = $(this).parent().siblings(':nth-child(3)').attr('class');
        $.ajax({
            url: '/perfil/accionSol',
            method: 'POST',
            data: {accion: 'danger', idSolicitud: idSolicitud, idUsuarioSolicitante: idUsuarioSolicitante, _token: $('#token').val()},
            success: function(data){
                $('#'+idSolicitud).children(':nth-child(6)').children().remove();
            }
        });
    });
    $('.btn-success').click(function(){
        var idSolicitud = $(this).parent().parent().attr('id');
        var idUsuarioSolicitante = $(this).parent().siblings(':nth-child(3)').attr('class');
        $.ajax({
            url: '/perfil/accionSol',
            method: 'POST',
            data: {accion: 'success', idSolicitud: idSolicitud, idUsuarioSolicitante: idUsuarioSolicitante, _token: $('#token').val()},
            success: function(data){
                $('#'+idSolicitud).children(':nth-child(6)').children().remove();YY
            }
        });
    });
});

function escribirFechaFormato(fecha){
    var arrayFecha = fecha.split('-');
    return arrayFecha[2] + '/' + arrayFecha[1] + '/' + arrayFecha[0]
}