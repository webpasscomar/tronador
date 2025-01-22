<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicsTableSeeder extends Seeder
{

    public function run(): void
    {
        $topic1 = new Topic();
        $topic1->nombre = 'General';
        $topic1->name = 'General';
        $topic1->save();

        $topic2 = new Topic();
        $topic2->nombre = 'Montaña Segura';
        $topic2->name = 'Safe Mountain';
        $topic2->save();

        $topic3 = new Topic();
        $topic3->nombre = 'Biodiversidad';
        $topic3->name = 'Biodiversity';
        $topic3->save();

        $topic4 = new Topic();
        $topic4->nombre = 'Cambio Climático';
        $topic4->name = 'Climate Change';
        $topic4->save();

        $topic5 = new Topic();
        $topic5->nombre = 'Servicios';
        $topic5->name = 'Services';
        $topic5->save();

        $topic6 = new Topic();
        $topic6->nombre = 'Patrimonio';
        $topic6->name = 'Heritage';
        $topic6->save();
    }
}