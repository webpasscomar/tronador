<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Positions;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            UsuariosTableSeeder::class,
            InstitutionsTableSeeder::class,
            TiposTableSeeder::class,
            TopicsTableSeeder::class,
            NationalitiesTableSeeder::class
        ]);
    }
}
