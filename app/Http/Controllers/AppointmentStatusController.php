<?php

namespace App\Http\Controllers;

use App\Models\AppointmentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class AppointmentStatusController extends Controller
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
        $request->validate([
            'name' => 'required',
            ],$this->messages());
            
            $request['type'] = 'appointment';
    

        $appointmentStatus = AppointmentStatus::create($request->all());
        //return response()->json($appointmentType, 201);
        return redirect()->route('appointment_status')->with('message', 'Estado de Cita creado satisfactoriamente');
    }

    public function update(Request $request, $id)
    {
        $appointmentStatus = AppointmentStatus::find($id);
        if (!$appointmentStatus) {
            return response()->json(['message' => 'Estado de cita no encontrado'], 404);
        }

        $request->validate([
            'name' => 'required',
            
        ]);

        $appointmentStatus->update($request->all());

        return redirect()->route('appointment_status')
            ->with('message', 'Estado de cita actualizado satisfactoriamente');
        
    }

    public function show($id)
    {
        $appointmentStatus = AppointmentStatus::find($id);

        if (!$appointmentStatus) {
            return response()->json(['message' => ' Estado de cita no encontrado'], 404);
        }

        return response()->json($appointmentStatus);
    }

    public function delete($id)
    {
        $appointmentStatus = AppointmentStatus::find($id);
        if (!$appointmentStatus) {
            return response()->json(['message' => 'Estado de cita no encontrado'], 404);
        }

        $appointmentStatus->delete();

        return redirect()->route('appointment_status')
            ->with('message', 'Estado de cita eliminado satisfactoriamente.');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $appointment_status = AppointmentStatus::where('name', 'like', '%' . $search . '%')
            ->orWhere('type', 'like', '%' . $search . '%')
            ->get();

        return response()->json($appointmentStatuses);
    }

     public function showView(Request $request){
        // $search = $request->input('search')
        $success = $request->get('success');
        $appointment_status = AppointmentStatus::all();
        $heads = [
            'ID',
            'Nombre',
            'Acciones'
            
        ];
        return view('admin.appointment_status.list', compact('appointment_status', 'heads', 'success'));
    }
    public function showCreate(Request $request)
    {

        return view('admin.appointment_status.create');
    }
    public function showEdit(Request $request, $id)
    {
        // $search = $request->input('search')
        $appointment_status = AppointmentStatus::find($id);
        return view('admin.appointment_status.edit', compact('appointment_status'));
    }
}

