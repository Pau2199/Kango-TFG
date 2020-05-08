<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // @id se genera automáticamente en mysql pero en este caso la C.P. es el dni
        $nombres_hombre = array('Rafael','Juan','Mateo','Tomas','Antonio','Jose','Rafael','Miguel');
        $nombres_mujer = array('Laura','Raquel','Marta','Claudia','Maria','Olga','Noemi', 'Julia');
        $apellidos = array('Gomez','Perez','Hernandez','Garcia','Romero','Sosa','Ruiz','Flores');
        $sexos = array('Hombre', 'Mujer');
        $roles = array('Usuario', 'Administrador');
        // Generar las fechas y las contraseñas
        $n_usuarios = 5;
        for ($i = 0; $i < $n_usuarios; $i++){
            $nums_aleatorios[$i] = mt_rand(600000000,900000000);
            $fechas_nacimiento[$i] = date("Y-m-d H:i:s", $nums_aleatorios[$i]);
            $contraseñas[$i] = Hash::make('password');
        }

        DB::table('users')->insert([
            [
            'nombre' => $nombres_hombre[0],
            'sexo' => $sexos[0],
            'primer_apellido' => $apellidos[rand(0,7)],
            'segundo_apellido' => $apellidos[rand(0,7)],
            'rol' => $roles[rand(0,1)],
            'fecha_nacimiento' => $fechas_nacimiento[0],
            'email' => Str::random(10).'@gmail.com',
            'password' => $contraseñas[0],
            'dni' => Str::random(9),
            ],
            [
            'nombre' => $nombres_mujer[0],
            'sexo' => $sexos[1],
            'primer_apellido' => $apellidos[rand(0,7)],
            'segundo_apellido' => $apellidos[rand(0,7)],
            'rol' => $roles[rand(0,1)],
            'fecha_nacimiento' => $fechas_nacimiento[1],
            'email' => Str::random(10).'@gmail.com',
            'password' => $contraseñas[1],
            'dni' => Str::random(9),
            ],
            [
            'nombre' => $nombres_hombre[1],
            'sexo' => $sexos[0],
            'primer_apellido' => $apellidos[rand(0,7)],
            'segundo_apellido' => $apellidos[rand(0,7)],
            'rol' => $roles[rand(0,1)],
            'fecha_nacimiento' => $fechas_nacimiento[2],
            'email' => Str::random(10).'@gmail.com',
            'password' => $contraseñas[2],
            'dni' => Str::random(9),
            ],
            [
            'nombre' => $nombres_mujer[1],
            'sexo' => $sexos[1],
            'primer_apellido' => $apellidos[rand(0,7)],
            'segundo_apellido' => $apellidos[rand(0,7)],
            'rol' => $roles[rand(0,1)],
            'fecha_nacimiento' => $fechas_nacimiento[3],
            'email' => Str::random(10).'@gmail.com',
            'password' => $contraseñas[3],
            'dni' => Str::random(9),
            ],
            [
            'nombre' => $nombres_hombre[2],
            'sexo' => $sexos[0],
            'primer_apellido' => $apellidos[rand(0,7)],
            'segundo_apellido' => $apellidos[rand(0,7)],
            'rol' => $roles[rand(0,1)],
            'fecha_nacimiento' => $fechas_nacimiento[4],
            'email' => Str::random(10).'@gmail.com',
            'password' => $contraseñas[4],
            'dni' => Str::random(9),
            ],  
        ]
        );
    }
}
