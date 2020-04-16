$(function(){
    $('#eleccionTipoBusqueda').hide();
    $('#opcionesAlquiler').hide();

    if(document.referrer){
        var url = document.referrer;
        url = url.split('8000/');
        console.log(url);
        if(url[1] == 'register'){
            console.log('entra')
            $('#login').trigger('click');
        }
    }


    $('.tipoBusqueda').click(function(){
        $('#opcionesAlquiler').hide();
        $('#eleccionTipoBusqueda').show();
        if('comprar' == $(this).val()){
            $('#elegidoEnTipoDeBusqueda').html('¿Quieres que la compra sea de Obra Nueva?')
        }else{
            $('#opcionesAlquiler').show();
            $('#elegidoEnTipoDeBusqueda').html('¿El alquiler es Vacacional?')
        }
    });

    $('#imagenFiltros').click(function(){
        if($('#panelFiltros').hasClass('d-none')){
            $('#panelFiltros').removeClass('d-none')
            $('#panelFiltros').fadeIn('slow');

        }else{
            $('#panelFiltros').fadeOut('slow');
            $('#panelFiltros').addClass('d-none')
        }
    })
    $('.btn-light').click(function(){
        if($('.botonPulsado') != null){
            $('.botonPulsado').removeClass('botonPulsado')
        }
        $(this).addClass('botonPulsado');
    })

})