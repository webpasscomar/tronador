<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiPointsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    // Mostrar los puntos en base al id del sendero enviado por parámetro
    public function byTrail($trail_id)
    {
        try {
            $points = Point::where('status', 1)
                ->orderBy('nombre', 'ASC')
                ->where('trail_id', $trail_id)
                ->with('institutions:id,initial', 'tipos:id,icon')
                // ->select('nombre', 'name', 'tipo_id')
                ->get();
            // Si no existen puntos mostrar mensaje
            if ($points->isEmpty()) {
                return response()->json([
                    'message' => 'No existen puntos en este sendero'
                ], 404);
            } else {
                // modificamos los puntos para agregar en la respuesta la sigla de instituciones de institution_id y el nombre del icono de tipo_id
                $points->transform(function ($point) {
                    return [
                        'nombre' => $point->nombre,
                        'name' => $point->name,
                        'descripcion' => $point->descripcion,
                        'decription' => $point->description,
                        'image' => $point->image ? Storage::url('puntos/'. $point->image) :null,
                        'pdf' => $point->pdf ? Storage::url('puntos/'. $point->pdf): null,
                        'lat' => $point->lat,
                        'lng' => $point->lng,
                        'icon' => Storage::url('iconos/'.$point->tipos->icon),
                        'institution' => $point->institutions->initial,
                    ];
                });
            }

            // Mensaje de éxito
            return \response()->json($points, 200);
        } catch (\Throwable $th) {
            // Cualquier otro error lo manejamos con error 500 - error interno de servidor
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}