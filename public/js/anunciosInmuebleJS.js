$(function(){        
    var url = location.href;
    url = url.split('/')[5]
    console.log(url)
    
    $.ajax({
        url: '/inmuebles/vistaInmueble/'+url,
        type: 'GET',
        success: function(data){
            console.log(data);
            console.log('HOLA');
        }
    })
    
})