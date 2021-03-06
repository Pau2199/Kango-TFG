<?php

namespace App\Http\Controllers\Auth;
use App\Rules\comprobarContrasenya;
use App\Rules\esMayorDeEdad;
use App\Rules\verificarNieNif;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:40', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'passwordRegister' => ['required', new comprobarContrasenya],
            'primerApellido' => ['required', 'string', 'max:40', 'min:3'],
            'segundoApellido' => ['required','string', 'max:40', 'min:3'],
            'sexo' => ['in:hombre,mujer','required'],
            'fechaNacimiento' => ['required', new esMayorDeEdad],
            'nif_nie' => ['required', new verificarNieNif, 'unique:users'],
            'terminosYCondiciones' => ['required'],
            'rol' => ['required'],
            'telefono' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nombre' => $data['name'],
            'sexo' => $data['sexo'],
            'primer_apellido' => $data['primerApellido'],
            'segundo_apellido' => $data['segundoApellido'],
            'rol' => $data['rol'],
            'fecha_nacimiento' => $data['fechaNacimiento'],
            'email' => $data['email'],
            'nif_nie' => $data['nif_nie'],
            'password' => Hash::make($data['passwordRegister']),
            'telefono' => $data['telefono'],
        ]);
    }
}
