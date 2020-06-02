$(function(){
    $('#navbar').hide();

    $('input').blur(function(){

    });


    function comprobarLogintudTexto(campo, valor){
        if(campo == 'nombre'){
            $('#mensaje'+campo).html('Este campo no puede tener mas de 40 caracteres');
        }
    }
    function comprobarDniNie(campo, valor){

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
        if(valor.length == 9){
            
        }else{
            $('#mensaje'+campo).html('Logitud del telefono incorrecta');
        }
    }
});