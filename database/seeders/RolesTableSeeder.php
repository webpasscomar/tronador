<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rol = new Role();
        $rol->id     = 1;
        $rol->name = 'Administrador';
        $rol->save();

        $rol2 = new Role();
        $rol2->id     = 2;
        $rol2->name = 'Editor';
        $rol2->save();
    }
}
