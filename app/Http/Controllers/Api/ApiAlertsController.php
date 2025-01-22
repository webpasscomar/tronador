<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;

class ApiAlertsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $alerts = Alert::where('status', 1)
                ->orderBy('titulo', 'asc')
                ->with('institutions:id,initial')
                ->get();

            if ($alerts->isEmpty()) {
                return response()->json(['message' => 'No existen alertas'], 404);
            } else {
                $alerts->transform(function ($alert) {
                    return [
                        'titulo' => $alert->titulo,
                        'title' => $alert->title,
                        'descripcion' => $alert->descripcion,
                        'description' => $alert->description,
                        'date' => $alert->date,
                        'institution' => $alert->institutions->initial
                    ];
                });
            }
            return response()->json($alerts, 200);
        } catch (\Throwable $th) {
            //manejo de errores de solicitudes que no se pueden procesar
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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