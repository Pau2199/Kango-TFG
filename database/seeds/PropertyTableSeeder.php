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
        $metros_cuadrdados = mt_rand(30, 200);
        $precio = mt_rand(200, 200000);
        $tipo_de_vivienda = array('P', 'D', 'A','C','B');
        $descripcion = 'asnasnansansnansansnansanansana,snaan ansansajsansansnasnansansannnasnansaansnasnasnansansansansknskansa s a sa k cs dl adlbandsx  dlajbdabdlabd dakbld ad'
            $piscina = mt_rand(0,1);    
        $garage = mt_rand(0,1);
        $n_habitaciones = mt_rand(1,5);
        $n_cuartos_de_banyo = mt_rand(1,3);
        $idUsuario = mt_rand(1,7);

        DB:table('Property')->insert({
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],
            [
                'metros_cuadrados' => $metros_cuadrdados,
                'precio' => $precio,
                'tipo_de_vivienda' => $tipo_de_vivienda[mt_rand(0,4)];
                'descripcion' => $descripcion,
                'piscina' => $piscina,
                'garage' => $garage,
                'n_habitaciones' => $n_habitaciones,
                'n_cuartos_de_banyo' => $n_cuartos_de_banyo,
                'idUsuario' => $idUsuario,
            ],

        })
    }
}
