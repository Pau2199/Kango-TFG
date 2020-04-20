$(function(){
    $('#fianza').hide();
    $('#extraAlquiler').hide();


    $('#opcionAlquiler').change(function(){
        console.log($('#opcionAlquiler option:selected').text());

        if($('#opcionAlquiler option:selected').text() == 'Alquiler' || $('#opcionAlquiler option:selected').text() == 'Alquiler Vacacional'){
            $('#fianza').show();
            $('#extraAlquiler').show();
        }else{
            $('#fianza').hide();
            $('#extraAlquiler').hide();
        }
    })
})