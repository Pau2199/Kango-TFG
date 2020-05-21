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
    });


    var textoHermano = "";
    $('td').dblclick(function(){
        var dia = $(this).attr('class');
        $(this).addClass('bg-warning');
        $('#texto').html('Agregando... Por favor Espere!');
        if($(this).hasClass('bg-info')){
            $('#texto').html('Ya tienes registrada esa franja horaria para ese dia de la semana! Haz doble click si deseas eliminarla');
            $(this).removeClass('bg-warning');
            $('#mensajeInfo').removeClass('bg-success');
            $('html, body').animate({scrollTop: 0},1000)
            $('#mensajeInfo').addClass('bg-danger').show();
        }else{
            var elemento = $(this);
            var primerHermano = $(this).siblings(':first').html();
            var datos = {dia: dia, horaInicio: primerHermano.split('-')[0].trim(), horaFinal: primerHermano.split('-')[1].trim()}
            $.ajax({
                url: '/perfil/modificarHorario',
                method: 'GET',
                data: datos,
                success: function(data){
                    var id = data['id'];
                    if(data['error'] == true){
                        elemento.removeClass('bg-warning');
                        $('#texto').html('Ya tienes registrada esa franja horaria para ese dia de la semana! Haz doble click si deseas eliminarla');
                        $('#mensajeInfo').removeClass('bg-success');
                        $('html, body').animate({scrollTop: 0},1000)
                        $('#mensajeInfo').addClass('bg-danger').show();
                    }else{
                        data = JSON.stringify(data);
                        elemento.removeClass('bg-warning');
                        elemento.addClass('bg-info');
                        elemento.attr('id', dia + ' - ' + id);
                        $('#texto').html('Franja Horaria: '+ datos['dia'] + ' de ' + datos['horaInicio'] + ' - ' + datos['horaFinal'] +  ' ha sido agregada correctamente!');
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