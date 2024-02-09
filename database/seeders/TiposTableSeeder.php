<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipo;

class TiposTableSeeder extends Seeder
{

    public function run(): void
    {
        $tipo1 = new Tipo();
        $tipo1->name = 'Refugio';
        $tipo1->icon = 'refugio.png';
        $tipo1->save();

        $tipo2 = new Tipo();
        $tipo2->name = 'Alerta';
        $tipo2->icon = 'alerta.png';
        $tipo2->save();

        $tipo3 = new Tipo();
        $tipo3->name = 'Interes';
        $tipo3->icon = 'interes.png';
        $tipo3->save();

        $tipo4 = new Tipo();
        $tipo4->name = 'mirador';
        $tipo4->icon = 'mirador.png';
        $tipo4->save();
    }
}
