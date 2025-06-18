<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_rol;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiUsersController extends Controller
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required',
            'repassword' => 'required|same:password',
            'lastname' => 'required',
            'nationality_id' => 'required',
            'birthday' => 'nullable|date|before:today',
            'phone' => 'nullable',
        ]);

        try {
            if ($request->password != $request->repassword) {
                return response()->json(['message' => 'Los password no son iguales'], 400);
            }
            //Creacion del usuario que se registra en la api
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'nationality_id' => $request->nationality_id,
                'birthday' => $request->birthday,
            ]);


            //asignamos el rol User al usuario
            $user_rol = new User_rol();
            $user_rol->user_id = $user->id;
            $user_rol->rol_id = 4;
            $user_rol->save();

            //devolver el usuario creado
            return response()->json(['message' => 'Usuario registrado'], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al registrar el usuario'], 500);
        }
    }
    /**
     * Revisa el usuario
    * @param  string  $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function byUser($email)
    {
        // Buscar al usuario por el correo electrónico
        $user = User::where('email', $email)
            ->with(['institutions','nationalities'])
            ->first();

        // Verificar si el usuario existe
        if ($user) {
            //Cambiar para mostrar la nacionalidad y la institución sin mostrar el id
            $user->nationality = $user->nationalities->name ?? null;
            $user->institution = $user->institutions->name ?? null;
            // No mostrar los campos de nacionalidades e instituciones con los ids y los objectos completos de navionalidad e institucion
            unset($user->nationalities, $user->institutions, $user->nationality_id, $user->institution_id);

            // Si el usuario existe, retornar una respuesta JSON con estado 200
            return response()->json([
                'exists' => true,
                'message' => 'Usuario encontrado.',
                'user' => $user  // Puedes incluir información del usuario si es necesario
            ]);
        } else {
            // Si no se encuentra el usuario, retornar una respuesta JSON con estado 404
            return response()->json([
                'exists' => false,
                'message' => 'Usuario no encontrado.'
            ], 404);
        }
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