<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class verificarNieNif implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $correcto = false;
        if(strlen($value) == 9) {
            $dni = strtoupper($value);
            echo $dni;
            
            $letra = substr($dni, -1, 1);
            $numero = substr($dni, 0, 8);

            // Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
            $numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);	

            $modulo = $numero % 23;
            $letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
            $letra_correcta = substr($letras_validas, $modulo, 1);

            if($letra_correcta == $letra) {
                $correcto = true;
            }
        }
        return $correcto;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El DNI debe estar compuesto: 8 números y una Letra
                En caso de NIE debe estar compuesto por una letra(X,Y), 7 números y una Letra';
    }
}
