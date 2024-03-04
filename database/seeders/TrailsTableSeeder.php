<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trail;

class TrailsTableSeeder extends Seeder
{

    public function run(): void
    {
        $trail1 = new Trail();
        $trail1->nombre = 'Pampa Linda-Refugio Otto Meiling';
        $trail1->name = 'Pampa Linda-Otto Meiling Hut';
        $trail1->resumen = 'El sendero comienza a pocos metros de la Seccional de Guardaparques de Pampa Linda. Los primeros 3 kilómetros transcurren en terreno casi plano, y llevan hasta el puente que cruza el Río Castaño Overa. Desde allí se emprende el ascenso por un faldeo de montaña de aproximadamente 6 kilómetros y 500 metros de desnivel hasta llegar a la cima del morro, lugar denominado “La Almohadilla”.     A partir de ese punto, el trayecto continúa con menor pendiente en dirección oeste, y luego de caminar unos 2 kilómetros se llega al “Descanso de los Caballos”, ubicado justo en el límite de la vegetación. Desde este lugar se emprende la parte final del ascenso, transitando unos 2 kilómetros y 350 metros de desnivel, a lo largo de una cresta o  filo ya sin vegetación y con marcas de pintura sobre las piedras que indican el recorrido.';
        $trail1->summary = 'Reservation is mandatory to camp and to overnight at the mountain hut.
        The trail starts next to the Park Rangers Office in Pampa Linda. The first 3 km. are almost flat, you’ll arrive at the Castaño Overa bridge.   The trail from here is partly on a 4×4 road with lots of well thought shortcuts for the next 6 km. and gaining 500 mts. The last part is pretty steep with switchbacks to make it to the shoulder called the “La Almohadilla”.
        From here the trail continues along the shoulder with less incline towards the Tronador peak, roughly 2 km. ahead at the edge of treeline you pass the highest point the horses go when taking people or gear. From here on it’s a rocky trail though very well marked, the last 2 km. are very exposed to wind.
        Warning: Snow has lasted until the end of December these last years and the last part of the trail changes course going on top of the ridge, the hut keepers mark this detour to avoid high risk exposure to slipping on hard snow or ice. Snowshoes/ crampons are highly recommended during October – November.
        The Otto Meiling Hut is set on the shoulder of the Tronador peak, between the Castaño Overa glacier and the Alerce glacier almost 2000 mts. above sea level.
        The way down to Pampa Linda is via the same trail or you can connect to Agostino Rocca Hut doing the Alerce Glacier crossing or heading down part of the way to the junction to the trail heading to the Agostino Rocca Hut via the valley, this trail is part of the “Paso de las Nubes” (“Clouds pass”) trave';
        $trail1->image = 'Refugio-Otto-Meiling.jpg';
        $trail1->kms = '13';
        $trail1->dificultad = 'Dif: Media (nov-abr) - Alta (may-oct)';
        $trail1->difficulty = 'Diff: Moderate (nov-apr) - Hugh (may-oct)';
        $trail1->elevation = '1050';
        $trail1->duracion = '5 a 7 hs de marcha en verano';
        $trail1->duration = '5 to 7 hours';
        $trail1->periodo = 'Todo el año';
        $trail1->period = 'Open all year';
        $trail1->geom = 'Pampa Linda-Refugio Otto Meiling.gpx';
        $trail1->order = 1;

        $trail1->save();

        $trail2 = new Trail();
        $trail2->nombre = 'Pampa Linda - Refugio Manuel Ojeda Cancino (Refugio Viejo del Tronador)';
        $trail2->name = 'Pampa Linda - Manuel Ojeda Cancino (Known as Refugio Viejo Tronador';
        $trail2->resumen = 'Antes de comenzar la travesía hay que realizar el trámite migratorio en Gendarmería Nacional de Pampa Linda. Continuar por el camino de autos que conduce a Ventisquero Negro y a un kilómetro, y a mano izquierda, tomar el sendero a Saltillo Las Nalcas. Cruzar el primer arroyo y luego el puente del Río Manso Superior. A pocos metros tomar el desvío a la derecha siguiendo el camino que bordea el Río Cauquenes (a la izquierda el camino lleva al Saltillo Las Nalcas). Al llegar a dos bifurcaciones tomar siempre a la derecha (a la izquierda el sendero lleva a la laguna La Rosada y Cerro Volcánico). Continuar hasta el paso Los Vuriloches y rodear el Mallín Chileno hasta el puesto de carabineros, donde se debe realizar un segundo trámite migratorio y anunciar que se va a subir y hacer noche en el refugio. Normalmente los carabineros sólo están los meses de enero y febrero y atienden hasta las 18 hs';
        $trail2->summary = 'Before you set out of Pampa Linda you must do you migration paperwork at the Border Police office. The trail head is roughly 400 mts. along the road towards Ventisquero Negro, a detour to the left which is also the Trail to Saltillo de las Nalcas (waterfall). There is first a small creek and then a bridge to cross the Manso Superior river. Soon there is a detour to the right next to the Cauquenes stream (to the left is the Saltillo de las Nalcas).
        This lower part of the trail is pretty closed with bamboo. After roughly an hour you have to wade through the Cauquenes creek. Here the trail starts to climb more steadily. There will be a junction, take a right, the left one goes towards La Rosada lagoon and Volcánico peak.';
        $trail2->image = 'Refugio-Viejo.jpg';
        $trail2->kms = '18';
        $trail2->dificultad = 'Dif: Alta (nov-abr) - Muy alta (may-oct)';
        $trail2->difficulty = 'Diff: Hugh (nov-apr) - Very hugh (may-oct)';
        $trail2->elevation = '1400';
        $trail2->duracion = '10 a 12 hs';
        $trail2->duration = '10 to 12 hours';
        $trail2->periodo = 'Todo el año';
        $trail2->period = 'Open all year';
        $trail2->geom = 'Pampa Linda Refugio Viejo.gpx';
        $trail2->order = 2;

        $trail2->save();
    }
}
