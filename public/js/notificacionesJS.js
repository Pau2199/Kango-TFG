$(function(){
    $.ajax({
        url: '/obtenerNotificaciones',
        method: 'GET',
        success: function(data){
            if(data.length > 0){
                var sup = $('<sup>').addClass('font-weight-bold text-danger tamanyoTexto').html(data.length);
                $('#notificacion').append(sup);
            }
        }
    })
})