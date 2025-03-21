<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_rol;
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
            'phone' => 'required|digits_between:8,20|integer',
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
    public function byUser($email)
    {
        try {
            $user = User::where('email', $email)
                ->first();
            // Si no existe usuario
            if ($user->isEmpty()) {
                return response()->json([
                    'message' => 'No existe el usuario'
                ], 404);
            } else {
                // validamos que esté activo?
                $user->transform(function ($user) {
                    return [
                        'name' => $user->name,
                        'lastname' => $user->lastname,
                        'password' => $user->password,
                        'phone' => $user->phone,
                        'birthday' => $user->birthday,
                        'nationality' => $user->nationality_id,
                    ];
                });
            }
            // Mensaje de éxito
            return \response()->json($user, 200);
        } catch (\Throwable $th) {
            // Cualquier otro error lo manejamos con error 500 - error interno de servidor
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Revisa el usuario
     */
    public function byUser($email)
    {
        try {
            $user = User::where('email', $email)
                ->first();
            // Si no existe usuario
            if ($user->isEmpty()) {
                return response()->json([
                    'message' => 'No existe el usuario'
                ], 404);
            } else {
                // validamos que esté activo?
                $user->transform(function ($user) {
                    return [
                        'name' => $user->name,
                        'lastname' => $user->lastname,
                        'password' => $user->password,
                        'phone' => $user->phone,
                        'birthday' => $user->birthday,
                        'nationality' => $user->nationality_id,
                    ];
                });
            }
            // Mensaje de éxito
            return \response()->json($user, 200);
        } catch (\Throwable $th) {
            // Cualquier otro error lo manejamos con error 500 - error interno de servidor
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
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