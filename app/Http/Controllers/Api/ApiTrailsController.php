<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Throwable;

class ApiTrailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function index()
    {
        try {
            $trails = Trail::where('status', 1)
                ->get()
                ->map(function ($trail){
                    $trail->image = $trail->image ? Storage::url('senderos/' . $trail->image) : null;
                    $trail->geom = $trail->geom ? Storage::url('senderos/' . $trail->geom) : null;
                    return $trail;
                });
            return response()->json($trails, 200);
        } catch (\Throwable $th) {
            // throw ValidationException::withMessages(['message' => $th->getMessage()]);
            return response()->json(['message' => $th->getMessage()], 400);
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