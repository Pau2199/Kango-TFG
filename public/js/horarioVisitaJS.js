$(function(){
    var diasSemana = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
    $.ajax({
        url: '/perfil/obtenerHorarioUsuario',
        method: 'GET',
        success: function(data){
            for(var i = 0 ; i<diasSemana.length ; i++){
                for(var j = 0 ; j<data[diasSemana[i]].length ; j++){
                    var id = 'H' + data[diasSemana[i]][j]['hora_inicio'].split(':')[0]
                    var dia = data[diasSemana[i]][j]['dia'];
                    var idBD = data[diasSemana[i]][j]['id'];
                    $('#'+id).siblings('td.'+dia).attr('id', dia+'-'+idBD).addClass('bg-info');
                }
            } 
        }
    })


    var textoHermano = "";
    $('td').dblclick(function(){
        if($(this).hasClass('bg-info')){
            $('#texto').html('Ya tienes registrada esa franja horaria para ese dia de la semana! Haz doble click si deseas eliminarla');
            $('#mensajeInfo').removeClass('bg-success');
            $('html, body').animate({scrollTop: 0},1000)
            $('#mensajeInfo').addClass('bg-danger').show();
        }else{
            $('#mensajeInfo').hide();
            var elemento = $(this);
            var primerHermano = $(this).siblings(':first').html();
            var dia = $(this).attr('class');
            var data = {dia: dia, horaInicio: primerHermano.split('-')[0].trim(), horaFinal: primerHermano.split('-')[1].trim()}
            console.log(data);
            $.ajax({
                url: '/perfil/modificarHorario',
                method: 'GET',
                data: data,
                success: function(data){
                    var id = data['id'];
                    if(data['error'] == true){
                        $('#texto').html('Ya tienes registrada esa franja horaria para ese dia de la semana! Haz doble click si deseas eliminarla');
                        $('#mensajeInfo').removeClass('bg-success');
                        $('html, body').animate({scrollTop: 0},1000)
                        $('#mensajeInfo').addClass('bg-danger').show();
                    }else{
                        data = JSON.stringify(data);
                        elemento.addClass('bg-info');
                        elemento.attr('id', dia + ' - ' + id);
                        $('#texto').html('Franja Horaria agregada correctamente!');
                        $('#mensajeInfo').removeClass('bg-danger');
                        $('html, body').animate({scrollTop: 0},1000)
                        $('#mensajeInfo').addClass('bg-success').show();
                    }
                }
            })
        }
    });

    $('td').click(function(){
        if($(this).hasClass('bg-info')){
            var id = $(this).attr('id').split('-')[1];
            $.ajax({
                url: '/perfil/borrarFranjaHoraria/'+id,
                method: 'GET',
                success: function(data){
                    
                }
            }) 
        }
    })

});