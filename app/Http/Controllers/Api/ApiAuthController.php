<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiAuthController extends Controller
{
    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('login');
    }

    public function login(Request $request)
    {

        $permisos = [];
        $mostrar_permisos = '';

        // Validar que se envien los datos correctos

        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Buscar el usuario
            $user = User::Where('email', $request->email)->first();

            // Verificamos que rol tiene el usuario para asignarle permisos
            if ($user->roles->contains('name', 'Administrador')) {
                $permisos = ['*'];
                $mostrar_permisos = 'Tienes todos los permisos';
            } else if ($user->roles->contains('name', 'Editor')) {
                $permisos = ['read', 'write'];
                $mostrar_permisos = 'Tienes permisos de lectura y escritura';
            } else {
                $permisos = ['read'];
                $mostrar_permisos = 'Tienes permisos de lectura';
            }

            // si el usuario no existe o la contraseña no coincide devolvemos un error de credenciales incorrectas

            if (!$user || !Hash::check($request->password, $user->password)) {

                return response()->json([
                    'message' => 'Las credenciales no son correctas',
                ], 401);
            }
            // si el usuario existe creamos el token y devolvemos un mensaje de bienvenida con el token creado

            $token = $user->createToken('auth_token', $permisos)->plainTextToken;

            return response()->json([
                'message' => 'Usuario conectado con éxito. ' . $mostrar_permisos,
                'token' => $token
            ], 200);
        } catch (\Throwable $th) {  // cualquier otro error devolvemos el mensaje de error correspondiente con el error 400
            return response()->json([
                'message' => $th->getMessage()
            ], 400);
        }
    }
}