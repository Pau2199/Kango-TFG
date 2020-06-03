$(function(){
    $('.descripcion').click(function(){
        console.log('entra');
        var idinm = $(this).parent().parent().attr('id');
        console.log(idinm);
        $.ajax({
            url: '/admin/inmuebles/obtenerDescripcion/'+idinm,
            methos: 'GET',
            success: function(data){
                $('#introducirTexto').html(data[0]['descripcion']);
            }
        });
    });

    $('#eliminar').click(function(){
        var elemento = $(this).parent().parent();
        var idinm = $(this).parent().parent().attr('id');
        $.ajax({
            url: '/admin/inmuebles/borrarInm/'+idinm,
            methos: 'GET',
            success: function(){
                elemento.remove();
            }
        });
    });
});