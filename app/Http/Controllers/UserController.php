<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('hasPermission:user-list')->only(['index', 'show']);
        $this->middleware('hasPermission:user-create')->only(['create', 'store']);
        $this->middleware('hasPermission:user-edit')->only(['edit', 'update']);
        $this->middleware('hasPermission:user-delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Inertia renderiza el componente Vue 'Users/Index.vue' y le pasa la lista de usuarios.
        $users = User::with('roles')->get();
        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        // Inertia renderiza el componente Vue 'Users/Index.vue' y le pasa la lista de usuarios.
        return Inertia::render('Users/Create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validamos los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Creamos el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asignamos el rol al usuario
        if ($request->has('role_id') && auth()->user()->hasPermission('user-assign-role')) {
            $user->roles()->attach($request->role_id);
        }

        // En Inertia, en lugar de retornar JSON, hacemos un redirect. Inertia interceptará esto en el frontend
        //  y actualizará la vista sin recargar la página.
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        
        if ($user->email === 'admin@admin.com' && auth()->user()->email !== 'admin@admin.com') {
            return redirect()->route('users.index')->withErrors(['error' => 'No tienes permiso para editar al administrador principal.']);
        }

        $roles = Role::all();
        
        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($user->email === 'admin@admin.com' && auth()->user()->email !== 'admin@admin.com') {
            return redirect()->route('users.index')->withErrors(['error' => 'No tienes permiso para modificar al administrador principal.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($user->email === 'admin@admin.com') {
            if ($request->email !== 'admin@admin.com') {
                return redirect()->back()->withErrors(['email' => 'No puedes cambiar el correo del administrador principal.']);
            }
            $adminRole = Role::where('name', 'admin')->first();
            if ($adminRole && $request->has('role_id') && $request->role_id != $adminRole->id) {
                return redirect()->back()->withErrors(['role_id' => 'No puedes quitarle el rol de administrador al administrador principal.']);
            }
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if ($request->has('role_id') && auth()->user()->hasPermission('user-assign-role')) {
            $user->roles()->sync([$request->role_id]);
        }

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->email === 'admin@admin.com') {
            return redirect()->route('users.index')->withErrors(['error' => 'No puedes eliminar al administrador principal.']);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
