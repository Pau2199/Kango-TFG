<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class comprobarContrasenya implements Rule
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
        $contrasenyaSegura = false;
        if(strlen($value)>=8){
            $numeros = intval(preg_replace('/[^0-9]+/', '', $value), 10);
            if(strlen($numeros)>0){
                for($i = 0; $i<strlen($value) ; $i++){
                    if(ctype_upper($value[$i])){
                        $contrasenyaSegura = true;
                        break;
                    }
                }
            }

        }
        return $contrasenyaSegura;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La contraseña debe tener un minimp de 8 caracteres, una letra mayuscula y un número';
    }
}
