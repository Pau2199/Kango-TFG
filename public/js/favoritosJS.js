$(function(){
    
    if($('#contenido').children().length == 0){
        var h1 = $('<h1>').html('No tienes ningún favorito!')
        $('#noticia').append(h1);
    }
    $('.btn-danger').click(function(){
        var id = $(this).parent().parent().children(':nth-child(2)').attr('id');
        if($('#notificacion').length > 0){
            clickFavoritosLogeado(1, id);
            $('#'+id).parent().remove();
        }else{
            clickFavoritosCookie(1, id);
            $('#'+id).parent().remove();
        }
    });
});