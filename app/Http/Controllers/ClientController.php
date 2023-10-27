<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
class ClientController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => ['required', 'regex:/^04\d{9}$/'],
            'birthday' => 'required|date_format:d/m/Y',
            'email' => ['required','email',Rule::unique('clients')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            'id_number' => ['required', 'regex:/^\d{7,8}$/', Rule::unique('clients')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        // Transformar la fecha al formato de base de datos (Y-m-d)
        $request['birthday'] = Carbon::createFromFormat('d/m/Y', $request['birthday'])->format('Y-m-d');

        $client = Client::create($request->all());
        return response()->json($client, 201);
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
            'email' => 'required|email|unique:clients,email,'.$id,
            'id_number' => ['required', 'regex:/^\d{7,8}$/', 'unique:clients,id_number,'.$id],
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        $requestData = $request->all();
        $requestData['birthday'] = Carbon::createFromFormat('d/m/Y', $requestData['birthday'])->format('Y-m-d');
    
        $client->update($requestData);
    
        return response()->json($client);
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

        return response()->json(['message' => 'Cliente eliminado']);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $clients = Client::where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->get();

        return response()->json($clients);
    }
}
