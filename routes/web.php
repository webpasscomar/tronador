<?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;

    use App\Http\Controllers\ContactoController;
    use App\Http\Controllers\HomeController;


    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

// Protege el acceso al registro desde la barra de navegación del navegador
    Auth::routes(
        ['register' => false]
    );

    // Reedirigir a la ruta de login
    Route::match(['get', 'post','put','patch','delete'], '/register', function () {
        return redirect()->route('login');
    });

    Route::get('/', [HomeController::class, 'index'])->name('home');
    //Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');
