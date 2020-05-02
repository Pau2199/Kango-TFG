$(function(){        
    $('#botonModificacion').click(function(){
        if($(this).html() == 'Activar Edición'){
            $(location).attr('href','/inmuebles/modificarInmuebleVista/A-42/true');
        }else{
        }
    })
})