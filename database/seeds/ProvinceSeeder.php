<?php

use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            ['nombre' => 'Alicante'],
            ['nombre' => 'Albacete'],
            ['nombre' => 'Almeria'],
            ['nombre' => 'Asturias'],
            ['nombre' => 'Avila'],
            ['nombre' => 'Barcelona'],
            ['nombre' => 'Burgos'],
            ['nombre' => 'Caceres'],
            ['nombre' => 'Cadiz'],
            ['nombre' => 'Castellon'],
            ['nombre' => 'Gerona'],
            ['nombre' => 'Granada'],
            ['nombre' => 'Huelva'],
            ['nombre' => 'Jaen'],
            ['nombre' => 'Lugo'],
            ['nombre' => 'Leon'],
            ['nombre' => 'La Coruña'],
            ['nombre' => 'Madrid'],
            ['nombre' => 'Malaga'],
            ['nombre' => 'Navarra'],
            ['nombre' => 'Palencia'],
            ['nombre' => 'Pontevedra'],
            ['nombre' => 'Soria'],
            ['nombre' => 'Sevilla'],
            ['nombre' => 'Teruel'],
            ['nombre' => 'Toledo'],
            ['nombre' => 'Valencia'],
            ['nombre' => 'Zaragoza'],
        ]);
    }
}
