<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    protected function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'regex' => 'El formato del campo :attribute no es válido.',
            'date_format' => 'El campo :attribute debe tener el formato dd/mm/yyyy.',
            'email.unique' => 'La dirección de correo electrónico ya está registrada.',
            'id_number.unique' => 'El número de identificación ya está registrado.',
        ];
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => ['required', 'regex:/^04\d{9}$/'],
            'birthday' => 'required|date_format:d/m/Y',
            'email' => [
                'required',
                'email',
                Rule::unique('clients')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ],
            'id_number' => [
                'required',
                'regex:/^\d{7,8}$/',
                Rule::unique('clients')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })
            ],
        ], $this->messages())->validate();


        // Transformar la fecha al formato de base de datos (Y-m-d)
        $request['birthday'] = Carbon::createFromFormat('d/m/Y', $request['birthday'])->format('Y-m-d');

        $client = Client::create($request->all());
        // return response()->json($client, 201);
        return redirect()->route('clients')
            ->with('message', 'Cliente creado satisfactoriamente.');
    }
    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => ['required', 'regex:/^04\d{9}$/'],
            'birthday' => 'required|date_format:d/m/Y',
            'email' => 'required|email|unique:clients,email,' . $id,
            'id_number' => ['required', 'regex:/^\d{7,8}$/', 'unique:clients,id_number,' . $id],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $requestData = $request->all();
        $requestData['birthday'] = Carbon::createFromFormat('d/m/Y', $requestData['birthday'])->format('Y-m-d');


        $client->update($requestData);
        return redirect()->route('clients')
            ->with('message', 'Cliente actualizado satisfactoriamente.');
    }

    public function show($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        return response()->json($client);
    }

    public function delete($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $client->delete();

        return redirect()->route('clients')
            ->with('message', 'Cliente eliminado satisfactoriamente.');
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $clients = Client::where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->get();

        return response()->json($clients);
    }

    public function showView(Request $request)
    {
        $clients = Client::all();
        $heads = [
            'ID',
            'Nombre',
            'Apellido',
            'Teléfono',
            'Fecha de nacimiento',
            'Correo electrónico',
            'Cédula',
            'Acciones'
        ];
        return view('admin.clients.list', compact('clients', 'heads'));
    }
    public function showEdit(Request $request, $id)
    {
        // $search = $request->input('search')
        $client = Client::find($id);
        $client->birthday = Carbon::parse($client->birthday)->format('d/m/Y');
        return view('admin.clients.edit', compact('client'));
    }
    public function showCreate(Request $request)
    {

        return view('admin.clients.create');
    }
}
