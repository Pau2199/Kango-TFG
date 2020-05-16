<?php

use Illuminate\Database\Seeder;

class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sale')->insert([
            [    
                'idInmueble' => 3,
            ],
            [    
                'idInmueble' => 4,
            ],
            [    
                'idInmueble' => 5,
            ],
            [    
                'idInmueble' => 6,
            ],
            [    
                'idInmueble' => 10,
            ],
        ]);
    }
}
