<?php

use Illuminate\Database\Seeder;

class RentalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function internet(){
            return mt_rand(0,1);
        }
        function animales(){
            return mt_rand(0,1);
        }
        function reformas(){
            return mt_rand(0,1);
        }
        function calefaccion(){
            return mt_rand(0,1);
        }
        function aireAcondicionado(){
            return mt_rand(0,1);
        }

        DB::table('rental')->insert([
            [
                "internet" =>  internet(),
                "animales" =>  animales(),
                "reformas" =>  reformas(),
                "calefaccion" =>  calefaccion(),
                "aireAcondicionado" =>  aireAcondicionado(),
                "fianza" => 1800,
                "idInmueble" => 1,
            ],
            [
                "internet" =>  internet(),
                "animales" =>  animales(),
                "reformas" =>  reformas(),
                "calefaccion" =>  calefaccion(),
                "aireAcondicionado" =>  aireAcondicionado(),
                "fianza" => 1800,
                "idInmueble" => 2,
            ],
            [
                "internet" =>  internet(),
                "animales" =>  animales(),
                "reformas" =>  reformas(),
                "calefaccion" =>  calefaccion(),
                "aireAcondicionado" =>  aireAcondicionado(),
                "fianza" => 1000,
                "idInmueble" => 7,
            ],
            [
                "internet" =>  internet(),
                "animales" =>  animales(),
                "reformas" =>  reformas(),
                "calefaccion" =>  calefaccion(),
                "aireAcondicionado" =>  aireAcondicionado(),
                "fianza" => 3000,
                "idInmueble" => 8,
            ],
            [
                "internet" =>  internet(),
                "animales" =>  animales(),
                "reformas" =>  reformas(),
                "calefaccion" =>  calefaccion(),
                "aireAcondicionado" =>  aireAcondicionado(),
                "fianza" => 1400,
                "idInmueble" => 9,
            ],
        ]);
    }
}
