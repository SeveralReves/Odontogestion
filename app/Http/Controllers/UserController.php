<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'role' => 'required|in:Dentist,Assistant,Receptionist,Administrator',
        ]);

        //if ($validator->fails()) {
           // return response()->json(['error' => $validator->errors()], 422);
        //}
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

    public function show($id){
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id){
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required|in:Dentist,Assistant,Receptionist,Administrator',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user->name = $request->name;
        $user->role = $request->role;
        $user->save();

        return response()->json(['message' => 'Usuario actualizado']);
    }

    public function destroy($id){
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado']);
    }

    public function index(Request $request){
        $validator = Validator::make($request->all(), [
            'search' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $searchQuery = $request->input('search');

        $users = User::where(function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%');
        })->get();

        return response()->json($users);
    }
    // Otros métodos para CRUD de usuarios: index(), show(), update(), destroy(), etc.

    public function showView(Request $request)
    {
        // $search = $request->input('search')
        $success = $request->get('success');
        $users = User::all();
        $heads = [
            'ID',
            'Nombre',
            'email',
            'Rol'
        ];
        return view('admin.users.list', compact('users', 'heads', 'success'));
    }
    public function showEdit(Request $request, $id)
    {
        // $search = $request->input('search')
        $users = User::find($id);
        return view('admin.users.edit', compact('users'));
    }
    public function showCreate(Request $request)
    {

        return view('admin.users.create');
    }
}
