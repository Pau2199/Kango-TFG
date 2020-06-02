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
        var url = window.location.href.split('/')[4];
        var idSolicitud = $(this).parent().parent().attr('id');
        console.log(idSolicitud)
        var idUsuarioSolicitante = "";
        if(url == 'solicitudesAlquiler'){
            idUsuarioSolicitante = $(this).parent().siblings(':nth-child(4)').attr('class');   
        }else{
            idUsuarioSolicitante = $(this).parent().siblings(':nth-child(3)').attr('class');   
        }
        console.log(idUsuarioSolicitante);
        $.ajax({
            url: '/perfil/accionSol',
            method: 'POST',
            data: {accion: 'danger', idSolicitud: idSolicitud, idUsuarioSolicitante: idUsuarioSolicitante, _token: $('#token').val()},
            success: function(data){
                $('.botonesForm').children().remove();
                if(url == 'solicitudesVisita'){
                    $('#'+idSolicitud).children(':nth-child(5)').html('Declinada');
                }
            }
        });
    });
    $('.btn-success').click(function(){
        var url = window.location.href.split('/')[4];
        var idSolicitud = $(this).parent().parent().attr('id');
        var idUsuarioSolicitante = "";
        if(url == 'solicitudesAlquiler'){
            idUsuarioSolicitante = $(this).parent().siblings(':nth-child(4)').attr('class');   
        }else{
            idUsuarioSolicitante = $(this).parent().siblings(':nth-child(3)').attr('class');   
        }
        console.log(idUsuarioSolicitante);
        $.ajax({
            url: '/perfil/accionSol',
            method: 'POST',
            data: {accion: 'success', idSolicitud: idSolicitud, idUsuarioSolicitante: idUsuarioSolicitante, _token: $('#token').val()},
            success: function(data){
                console.log(data);
                $('.botonesForm').children().remove();
                if(url == 'solicitudesVisita'){
                    $('#'+idSolicitud).children(':nth-child(5)').html('Aceptada');
                }
            }
        });
    });
});