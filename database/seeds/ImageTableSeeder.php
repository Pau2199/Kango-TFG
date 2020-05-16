<?php

use Illuminate\Database\Seeder;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('image')->insert([
            [
                'nombre' => 'perfil1.jpg',  
                'idInmueble' => 1,  
            ],
            [
                'nombre' => '2.jpg',  
                'idInmueble' => 1,  
            ],
            [
                'nombre' => '3.jpg',  
                'idInmueble' => 1,  
            ],
            [
                'nombre' => 'perfil2.jpg',  
                'idInmueble' => 2,  
            ],
            [
                'nombre' => '6.jpg',  
                'idInmueble' => 2,  
            ],
            [
                'nombre' => '6.jpg',  
                'idInmueble' => 2,  
            ],
            [
                'nombre' => '7.jpg',  
                'idInmueble' => 2,  
            ],
            [
                'nombre' => 'perfil3.jpg',  
                'idInmueble' => 3,  
            ],
            [
                'nombre' => '9.jpg',  
                'idInmueble' => 3,  
            ],
            [
                'nombre' => '10.jpg',  
                'idInmueble' => 3,  
            ],
            [
                'nombre' => 'perfil4.jpg',  
                'idInmueble' => 4,  
            ],
            [
                'nombre' => '12.jpg',  
                'idInmueble' => 4,  
            ],
            [
                'nombre' => '13.jpg',  
                'idInmueble' => 4,  
            ],
            [
                'nombre' => '14.jpg',  
                'idInmueble' => 4,  
            ],
            [
                'nombre' => 'perfil5.jpg',  
                'idInmueble' => 5,  
            ],
            [
                'nombre' => '16.jpg',  
                'idInmueble' => 5,  
            ],
            [
                'nombre' => '17.jpg',  
                'idInmueble' => 5,  
            ],
            [
                'nombre' => 'perfil6.jpg',  
                'idInmueble' => 6,  
            ],
            [
                'nombre' => '19.jpg',  
                'idInmueble' => 6,  
            ],
            [
                'nombre' => '20.jpg',  
                'idInmueble' => 6,  
            ],
            [
                'nombre' => '21.jpg',  
                'idInmueble' => 6,  
            ],
            [
                'nombre' => 'perfil7.jpg',  
                'idInmueble' => 7,  
            ],
            [
                'nombre' => '23.jpg',  
                'idInmueble' => 7,  
            ],
            [
                'nombre' => '24.jpg',  
                'idInmueble' => 7,  
            ],
            [
                'nombre' => 'perfil8.jpg',  
                'idInmueble' => 8,  
            ],
            [
                'nombre' => '26.jpg',  
                'idInmueble' => 8,  
            ],
            [
                'nombre' => '27.jpg',  
                'idInmueble' => 8,  
            ],
            [
                'nombre' => '28.jpg',  
                'idInmueble' => 8,  
            ],
            [
                'nombre' => 'perfil9.jpg',  
                'idInmueble' => 9,  
            ],
            [
                'nombre' => '31.jpg',  
                'idInmueble' => 9,  
            ],
            [
                'nombre' => '32.jpg',  
                'idInmueble' => 9,  
            ],
            [
                'nombre' => '33.jpg',  
                'idInmueble' => 9,  
            ],
            [
                'nombre' => 'perfil10.jpg',  
                'idInmueble' => 10,  
            ],
            [
                'nombre' => '36.jpg',  
                'idInmueble' => 10,  
            ],
            [
                'nombre' => '37.jpg',  
                'idInmueble' => 10,  
            ],
        ]);

    }
}
