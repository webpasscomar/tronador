<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicsTableSeeder extends Seeder
{

    public function run(): void
    {
        $topic1 = new Topic();
        $topic1->name = 'General';
        $topic1->save();

        $topic2 = new Topic();
        $topic2->name = 'Montaña Segura';
        $topic2->save();

        $topic3 = new Topic();
        $topic3->name = 'Biodiversidad';
        $topic3->save();

        $topic4 = new Topic();
        $topic4->name = 'Cambio Climático';
        $topic4->save();

        $topic5 = new Topic();
        $topic5->name = 'Servicios';
        $topic5->save();

        $topic6 = new Topic();
        $topic6->name = 'Patrimonio';
        $topic6->save();
      
    }
}
