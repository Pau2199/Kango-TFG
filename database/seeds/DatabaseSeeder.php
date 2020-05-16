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
            //PostSeeder::class,
            //CommentSeeder::class,
        ]);
    }
}
