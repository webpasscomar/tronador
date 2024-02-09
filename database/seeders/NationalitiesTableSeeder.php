<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nationality;

class NationalitiesTableSeeder extends Seeder
{

    public function run(): void
    {
        $nac1 = new Nationality();
        $nac1->name = 'Argentina';
        $nac1->save();

        $nac2 = new Nationality();
        $nac2->name = 'Alemania';
        $nac2->save();

        $nac3 = new Nationality();
        $nac3->name = 'Brasilera';
        $nac3->save();

        $nac4 = new Nationality();
        $nac4->name = 'Francesa';
        $nac4->save();

        $nac5 = new Nationality();
        $nac5->name = 'Españoña';
        $nac5->save();

        $nac6 = new Nationality();
        $nac6->name = 'Italiana';
        $nac6->save();

        $nac7 = new Nationality();
        $nac7->name = 'England';
        $nac7->save();

        $nac8 = new Nationality();
        $nac8->name = 'Noruega';
        $nac8->save();

        $nac9 = new Nationality();
        $nac9->name = 'United State';
        $nac9->save();

        $nac10 = new Nationality();
        $nac10->name = 'Uruguaya';
        $nac10->save();
    }
}
