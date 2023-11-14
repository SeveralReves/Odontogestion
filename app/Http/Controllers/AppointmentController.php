<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentStatus;
use App\Models\AppointmentType;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
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
            'client_id' => 'required',
            'appointments_type_id' => 'required',
            'status_id' => 'required',
            'date' => 'required|date_format:d/m/Y',
            'hour' => 'required',
        ], $this->messages())->validate();


        // Transformar la fecha al formato de base de datos (Y-m-d)
        $request['date'] = Carbon::createFromFormat('d/m/Y', $request['date'])->format('Y-m-d');
        // $request['hour'] = Carbon::createFromFormat('HH:mm', $request['hour'])->format('HH:mm');

        $appointment = Appointment::create($request->all());
        // return response()->json($client, 201);
        return redirect()->route('appointments')
            ->with('message', 'Cita creada satisfactoriamente.');
    }
    public function showView(Request $request)
    {
        $appointments = Appointment::all();
        $heads = [
            'ID',
            'Fecha',
            'Hora',
            'Cliente',
            'Estado',
            'Tipo de cita',
        ];
        return view('admin.appointments.list', compact('appointments', 'heads'));
    }
    public function showCreate(Request $request)
    {
        $statuses = AppointmentStatus::all();
        $types = AppointmentType::all();
        $clients = Client::all();
        return view('admin.appointments.create', compact('clients','statuses','types'));
    }
}
