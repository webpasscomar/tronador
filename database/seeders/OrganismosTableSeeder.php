<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organismo;

class OrganismosTableSeeder extends Seeder
{

    public function run(): void
    {
        $org1 = new Organismo();
        $org1->nombre = 'Ministerio de Agricultura';
        $org1->sigla = 'MAG';
        $org1->status = 1;
        $org1->save();
    }
}
