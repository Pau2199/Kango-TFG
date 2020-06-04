$(function(){
    $('input').blur(function(){
        if($(this).val() == ""){
            $('#mensaje'+$(this).attr('id')).html('Este campo no puede estar vacio');
        }else{
            if($(this).attr('id') == 'name' || $(this).attr('id') == 'primerApellido' || $(this).attr('id') == 'segundoApellido'){
                comprobarLogintudTexto($(this).attr('id'), $(this).val());
            }else if($(this).attr('id') == 'nif_nie'){
                comprobarDniNie($(this).attr('id'), $(this).val());
            }else if($(this).attr('id') == 'fechaNacimiento'){
                comprobarFecha($(this).attr('id'), $(this).val());
            }else if($(this).attr('id') == 'email'){
                comprobarCorreoElectronico($(this).attr('id'), $(this).val());
            }else if($(this).attr('id') == 'telefono'){
                comprobarTelefono($(this).attr('id'), $(this).val());
            }
        }

    });

    $('#modificar').click(function(event){
        event.preventDefault();

        $('input').each(function(){
            if($(this).val() == ""){
                $('#mensaje'+$(this).attr('id')).html('Este campo no puede estar vacio');
            }else{
                if($(this).attr('id') == 'name' || $(this).attr('id') == 'primerApellido' || $(this).attr('id') == 'segundoApellido'){
                    comprobarLogintudTexto($(this).attr('id'), $(this).val());
                }else if($(this).attr('id') == 'nif_nie'){
                    comprobarDniNie($(this).attr('id'), $(this).val());
                }else if($(this).attr('id') == 'fechaNacimiento'){
                    comprobarFecha($(this).attr('id'), $(this).val());
                }else if($(this).attr('id') == 'email'){
                    comprobarCorreoElectronico($(this).attr('id'), $(this).val());
                }else if($(this).attr('id') == 'telefono'){
                    comprobarTelefono($(this).attr('id'), $(this).val());
                }
            }
        });
        var error = false
        $('strong.js').each(function(){
            if($(this).html() != ''){
                error = true;
            }
        });

        if(error == false){
            $('#formModificar').submit();
        }
    })


})