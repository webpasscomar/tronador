<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\Reference;
    use App\Models\Institution;
    use Throwable;
    use function PHPUnit\Framework\isEmpty;

    class ApiReferencesController extends Controller
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
        public function byTopic($topic_id)
        {
            //
            try {
                $trails =
                    Reference::where('references.status', 1)
                        ->orderBy('name', 'ASC')
                        ->where('topic_id', $topic_id)
                        ->join('institutions', 'references.institution_id', '=', 'institutions.id')
                        ->select('references.nombre', 'references.name', 'references.descripcion', 'references.description', 'references.image', 'references.pdf', 'references.trail_id', 'institutions.initial')
                        ->get();

                if ($trails->isEmpty()) {
                    return response()->json(['message' => 'No existen referencias para ese topic'], 404);
                }
                return response()->json($trails, 200);
            } catch (\Throwable $th) {
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