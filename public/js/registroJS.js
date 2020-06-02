$(function(){
    $('#navbar').hide();

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
            }else if($(this).attr('id') == 'passwordRegister' || $(this).attr('id') == 'password-confirm'){
                comprobarContrasenya($(this).attr('id'), $(this).val());
            }
        }

    });

    $('#registrarse').click(function(event){
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
                }else if($(this).attr('id') == 'passwordRegister' || $(this).attr('id') == 'password-confirm'){
                    comprobarContrasenya($(this).attr('id'), $(this).val());
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
            $('#formRegistro').submit();
        }
    })


    function comprobarLogintudTexto(campo, valor){
        $('#mensaje'+campo).html('');
        if(valor.length > 40){
            $('#mensaje'+campo).html('Este campo no puede tener mas de 40 caracteres');
        }
    }
    function comprobarDniNie(campo, valor){
        $('#mensaje'+campo).html('');
        if(valor.length == 9){
            var dni = valor.toUpperCase();
            var letra = dni[8];
            var numeros = "";
            for (var i = 0 ;i<dni.length-1; i++){
                if(i == 0 ){
                    numeros = dni[i]; 
                }else{
                    numeros += dni[i];
                }
            }
            if(numeros[0] == 'X'){
                numeros[0] = 0
            }else if (numeros[0] == 'Y'){
                numeros[0] = 1
            }else{
                numeros[0] = 2
            }

            var modulo = parseInt(numeros) % 23;
            var letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
            var letra_correcta = letras[modulo];
            if(letra != letra_correcta){
                $('#mensaje'+campo).html('DNI o NIE incorrecto');
            }

        }else{
            $('#mensaje'+campo).html('Este campo debe tener 9 caracteres');

        }
    }

    function comprobarTelefono(campo, valor){
        $('#mensaje'+campo).html('');
        if(valor.length == 9){
            if(valor[0] != 6 && valor[0] != 7){
                $('#mensaje'+campo).html('El número empieza incorrectamente');
            }
        }else{
            $('#mensaje'+campo).html('Logitud del telefono incorrecta');
        }
    }

    function comprobarFecha(campo, valor){
        $('#mensaje'+campo).html('');
        var fechaSis = new Date();
        var fechaElegida = new Date(valor);

        if(fechaElegida > fechaSis){
            $('#mensaje'+campo).html('La fecha elegida no puede ser mayor a la que te encuentras');
        }else{
            if(fechaSis.getFullYear() - fechaElegida.getFullYear() < 18){
                $('#mensaje'+campo).html('Debes ser mayor de edad para registrarte');
            }else if(fechaSis.getFullYear() - fechaElegida.getFullYear() == 18){
                if(fechaSis.getMonth()+1 == fechaElegida.getMonth()+1){
                    if(fechaSis.getMonth()+1 > fechaElegida.getMonth()+1){
                        $('#mensaje'+campo).html('Debes ser mayor de edad para registrarte');
                    }
                }else if(fechaSis.getMonth()+1 > fechaElegida.getMonth()+1){
                    $('#mensaje'+campo).html('Debes ser mayor de edad para registrarte');
                }
            }
        }
    }

    function comprobarCorreoElectronico(campo, valor){
        $('#mensaje'+campo).html('');
        var expresionRegular = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
        if(!expresionRegular.test(valor)){
            $('#mensaje'+campo).html('Formato de email incorrecto');
        }
    }

    function comprobarContrasenya(campo, valor){
        $('#mensaje'+campo).html('');
        if(campo == 'passwordRegister'){
            if(valor.length < 8){
                $('#mensaje'+campo).html('La contraseña debe tener 8 caracteres, un número y una letra');
            }else{
                var expresionRegular = new RegExp('[^0-9]+');
                if(!expresionRegular.test(valor)){
                    $('#mensaje'+campo).html('La contraseña debe tener 8 caracteres, un número y una letra');
                }
                var letraMayus = false
                for(var i = 0 ; i<valor.length; i++){
                    if(valor[i] == valor[i].toUpperCase() && isNaN(valor[i])){
                        letraMayus = true;
                        break;
                    }
                }
                if(letraMayus == false){
                    $('#mensaje'+campo).html('La contraseña debe tener 8 caracteres, un número y una letra');
                }

            }
        }else{
            if(valor != $('#passwordRegister').val()){
                $('#mensaje'+campo).html('La contraseña debe ser igual a la del campo anterior');
            }
        }
    }
});