<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Llamadas a los seeds creados
        $this->call([
            UserTableSeeder::class,
            ProvinceSeeder::class,
            LocalitiesSeeder::class,
            PropertyTableSeeder::class,
            AddressTableSeeder::class,
            SaleTableSeeder::class,
            RentalTableSeeder::class,
            ImageTableSeeder::class,
            Visiting_hourTableSeeder::class,
            //PostSeeder::class,
            //CommentSeeder::class,
        ]);
    }
}
