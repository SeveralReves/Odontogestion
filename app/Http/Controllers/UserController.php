<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'role' => 'required|in:Dentist,Assistant,Receptionist,Administrator',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        // Validar si el usuario que hace la petición es Administrador
        // if ($request->user()->can('Administrator')) {
            // Si es Administrador, crear el nuevo usuario
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->save();
            return response()->json(['message' => 'Usuario creado']);
        // } else {
        //     return response()->json(['message' => 'No tienes permiso para crear usuarios'], 403);
        // }
    }

    // Otros métodos para CRUD de usuarios: index(), show(), update(), destroy(), etc.
}
