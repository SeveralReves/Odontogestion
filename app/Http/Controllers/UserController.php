<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        // return response()->json(['message' => 'Usuario creado']);
        return redirect()->route('users')
            ->with('message', 'Usuario creado satisfactoriamente.');
        // } else {
        //     return response()->json(['message' => 'No tienes permiso para crear usuarios'], 403);
        // }
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:Dentist,Assistant,Receptionist,Administrator',
        ])->validate();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users')
            ->with('message', 'Usuario actualizado satisfactoriamente.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')
            ->withErrors('Usuario no encontrado');
        }

        $user->delete();

        return redirect()->route('users')
            ->with('message', 'Usuario eliminado satisfactoriamente.');
    }

    public function index(Request $request)
    {
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
            'Correo electrónico',
            'Rol',
            'Acciones'
        ];
        return view('admin.users.list', compact('users', 'heads', 'success'));
    }
    public function showEdit(Request $request, $id)
    {
        $roles = [
            [
                'label' => 'Dentista',
                'value' => 'Dentist',
            ],
            [
                'label' => 'Asistente',
                'value' => 'Assistant',
            ],
            [
                'label' => 'Recepcionista',
                'value' => 'Receptionist',
            ],
            [
                'label' => 'Administrador',
                'value' => 'Administrator',
            ]
        ];
        $users = User::find($id);
        return view('admin.users.edit', compact('users', 'roles'));
    }
    public function showCreate(Request $request)
    {
        $roles = [
            [
                'label' => 'Dentista',
                'value' => 'Dentist',
            ],
            [
                'label' => 'Asistente',
                'value' => 'Assistant',
            ],
            [
                'label' => 'Recepcionista',
                'value' => 'Receptionist',
            ],
            [
                'label' => 'Administrador',
                'value' => 'Administrator',
            ]
        ];
        return view('admin.users.create', compact('roles'));
    }
}
