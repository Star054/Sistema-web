<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View|RedirectResponse
    {
        // Verificar si el usuario autenticado tiene el rol 'admin'
        if (Auth::check() && Auth::user()->rol === 'admin') {
            return view('auth.register'); // Mostrar el formulario de registro
        }

        // Si el usuario no tiene rol 'admin', redirigir al login con error
        return redirect()->route('login')->withErrors(['error' => 'No tienes permisos para registrar nuevos usuarios.']);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        dd(Auth::check(), Auth::user());

        if (Auth::check()) {
            // Si el usuario ya está autenticado, redirigirlo al inicio o página que desees
            return redirect()->route('home')->withErrors(['error' => 'Ya estás logueado. No puedes crear otro usuario.']);
        }
        // Validación
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        dd($request->all());
        // Crear el usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'rol' => 'usuario',  // Asignamos el rol por defecto 'usuario'
        ]);

        dd($request->all());
        // Iniciar sesión con el nuevo usuario
        Auth::login($user);
        dd($request->all());
        // Redirigir al dashboard con un mensaje de éxito
        return redirect(route('dashboard'))->with('success', 'Usuario creado con éxito.');
    }

}
