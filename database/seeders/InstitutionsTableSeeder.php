<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Institution;

class InstitutionsTableSeeder extends Seeder
{

    public function run(): void
    {
        $org1 = new Institution();
        $org1->name = 'Secretaria de Ambiente y Desarrollo Sustentable';
        $org1->sigla = 'SAyDS';
        $org1->status = 1;
        $org1->save();

        $org2= new Institution();
        $org2->name = 'Parques Nacionales';
        $org2->sigla = 'PN';
        $org2->status = 1;
        $org2->save();

        $org3= new Institution();
        $org3->name = 'Secretaría de Turismo';
        $org3->sigla = 'ST';
        $org3->status = 1;
        $org3->save();

        $org4= new Institution();
        $org4->name = 'Ejército Argentino';
        $org4->sigla = 'EA';
        $org4->status = 1;
        $org4->save();

        $org5= new Institution();
        $org5->name = 'Gendarmería Nacional';
        $org5->sigla = 'GN';
        $org5->status = 1;
        $org5->save();

        $org6= new Institution();
        $org6->name = 'Servicio Meteorológico Nacional';
        $org6->sigla = 'SMN';
        $org6->status = 1;
        $org6->save();

        $org7= new Institution();
        $org7->name = 'Instituto Argentino de Nivología, Glaciologia y Ciencia';
        $org7->sigla = 'IANIGLA';
        $org7->status = 1;
        $org7->save();

        $org8= new Institution();
        $org8->name = 'Servicio Geológico Minero Argentino';
        $org8->sigla = 'SEGEMAR';
        $org8->status = 1;
        $org8->save();
    }
}
