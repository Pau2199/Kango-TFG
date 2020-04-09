<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class esMayorDeEdad implements Rule
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
        $mayorEdad = false;
        $fechaActual = getDate();
        $arrayFecha = explode('-', $value);
        $anyo = intval($arrayFecha[0]);
        $dia = intval($arrayFecha[1]);
        $mes = intval($arrayFecha[2]);
        
        if($fechaActual['year']-$anyo > 18){
            $mayorEdad = true;
        }else if($fechaActual['year']-$anyo == 18){
            if($fechaActual['mon'] == $mes){
                if($fechaActual['mday'] >= $dia){
                    $mayorEdad = true;
                }
            }else if($fechaActual['mon'] > $mes){
                $mayorEdad = true;
            }
        }
        
        return $mayorEdad;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Debes de ser mayor de edad para poder registrarte en nuestra web.';
    }
}
