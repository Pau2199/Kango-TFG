<?php

use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function metros_cuadrados(){
            return mt_rand(30,200);
        }
        function piscina(){
            return mt_rand(0,1);
        }
        function garage(){
            return mt_rand(0,1);
        }
        function ascensor(){
            return mt_rand(0,1);
        }
        function n_habitaciones(){
            return mt_rand(1,5);
        }
        function n_cuartos_de_banyo(){
            return mt_rand(1,3);
        }
        function usuarios(){
            return mt_rand(1,6);
        }

        $precio = mt_rand(200, 200000);
        $tipo_de_vivienda = array('P', 'D', 'A','C','B');
        $descripcion = "Lorem Ipsum es simplemente un texto ficticio de la industria de impresión y composición tipográfica. Lorem Ipsum ha sido el texto ficticio estándar de la industria desde el año 1500, cuando una impresora desconocida tomó una galera de tipo y la revolvió para hacer un libro de muestras. Ha sobrevivido no solo cinco siglos, sino también el salto a la composición electrónica, permaneciendo esencialmente sin cambios. Se popularizó en la década de 1960 con el lanzamiento de las hojas de Letraset que contienen pasajes de Lorem Ipsum, y más recientemente con software de publicación de escritorio como Aldus PageMaker que incluye versiones de Lorem Ipsum.";
        DB::table('property')->insert([
            [
                'metros_cuadrados' => metros_cuadrados(),
                'precio' => 900,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)],
                'descripcion' => $descripcion,
                'piscina' => piscina(),
                'ascensor' => ascensor(),
                'garage' => garage(),
                'n_habitaciones' => n_habitaciones(),
                'n_cuartos_de_banyo' => n_cuartos_de_banyo(),
                'idUsuario' => usuarios(),
                'disponible' => 1,
            ],
            [
                'metros_cuadrados' => metros_cuadrados(),
                'precio' => 600,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)],
                'descripcion' => $descripcion,
                'piscina' => piscina(),
                'ascensor' => ascensor(),
                'garage' => garage(),
                'n_habitaciones' => n_habitaciones(),
                'n_cuartos_de_banyo' => n_cuartos_de_banyo(),
                'idUsuario' => usuarios(),
                'disponible' => 1,
            ],
            [
                'metros_cuadrados' => metros_cuadrados(),
                'precio' => 260000,
                'tipo_de_vivienda' => 'C',
                'descripcion' => $descripcion,
                'piscina' => piscina(),
                'ascensor' => ascensor(),
                'garage' => garage(),
                'n_habitaciones' => n_habitaciones(),
                'n_cuartos_de_banyo' => n_cuartos_de_banyo(),
                'idUsuario' => usuarios(),
                'disponible' => 1,
            ],
            [
                'metros_cuadrados' => metros_cuadrados(),
                'precio' => 100000,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)],
                'descripcion' => $descripcion,
                'piscina' => piscina(),
                'ascensor' => ascensor(),
                'garage' => garage(),
                'n_habitaciones' => n_habitaciones(),
                'n_cuartos_de_banyo' => n_cuartos_de_banyo(),
                'idUsuario' => usuarios(),
                'disponible' => 1,
            ],
            [
                'metros_cuadrados' => metros_cuadrados(),
                'precio' => 150000,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)],
                'descripcion' => $descripcion,
                'piscina' => piscina(),
                'ascensor' => ascensor(),
                'garage' => garage(),
                'n_habitaciones' => n_habitaciones(),
                'n_cuartos_de_banyo' => n_cuartos_de_banyo(),
                'idUsuario' => usuarios(),
                'disponible' => 1,
            ],
            [
                'metros_cuadrados' => metros_cuadrados(),
                'precio' => 175000,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)],
                'descripcion' => $descripcion,
                'piscina' => piscina(),
                'ascensor' => ascensor(),
                'garage' => garage(),
                'n_habitaciones' => n_habitaciones(),
                'n_cuartos_de_banyo' => n_cuartos_de_banyo(),
                'idUsuario' => usuarios(),
                'disponible' => 1,
            ],
            [
                'metros_cuadrados' => metros_cuadrados(),
                'precio' => 500,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)],
                'descripcion' => $descripcion,
                'piscina' => piscina(),
                'ascensor' => ascensor(),
                'garage' => garage(),
                'n_habitaciones' => n_habitaciones(),
                'n_cuartos_de_banyo' => n_cuartos_de_banyo(),
                'idUsuario' => usuarios(),
                'disponible' => 1,
            ],
            [
                'metros_cuadrados' => metros_cuadrados(),
                'precio' => 1000,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)],
                'descripcion' => $descripcion,
                'piscina' => piscina(),
                'ascensor' => ascensor(),
                'garage' => garage(),
                'n_habitaciones' => n_habitaciones(),
                'n_cuartos_de_banyo' => n_cuartos_de_banyo(),
                'idUsuario' => usuarios(),
                'disponible' => 1,
            ],
            [
                'metros_cuadrados' => metros_cuadrados(),
                'precio' => 700,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)],
                'descripcion' => $descripcion,
                'piscina' => piscina(),
                'ascensor' => ascensor(),
                'garage' => garage(),
                'n_habitaciones' => n_habitaciones(),
                'n_cuartos_de_banyo' => n_cuartos_de_banyo(),
                'idUsuario' => usuarios(),
                'disponible' => 1,
            ],
            [
                'metros_cuadrados' => metros_cuadrados(),
                'precio' => 220000,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)],
                'descripcion' => $descripcion,
                'piscina' => piscina(),
                'ascensor' => ascensor(),
                'garage' => garage(),
                'n_habitaciones' => n_habitaciones(),
                'n_cuartos_de_banyo' => n_cuartos_de_banyo(),
                'idUsuario' => usuarios(),
                'disponible' => 1,
            ],
        ]);
    }
}
