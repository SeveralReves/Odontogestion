<?php

namespace App\Http\Controllers;

use App\Models\AppointmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class AppointmentTypeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $appointmentType = AppointmentType::create($request->all());
        //return response()->json($appointmentType, 201);
        return redirect()->route('appointment_type');
    }

    public function update(Request $request, $id)
    {
        $appointmentType = AppointmentType::find($id);
        if (!$appointmentType) {
            return response()->json(['message' => 'Tipo de cita no encontrada'], 404);

        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $appointmentType->update($request->all());
        return redirect()->route('appointment_type')
        ->with('message', 'Tipo de cita actualizado satisfactoriamente');
        
    }

    public function show($id)
    {
        $appointmentType = AppointmentType::find($id);

        if (!$appointmentType) {
            return response()->json(['message' => 'Tipo de cita no encontrado'], 404);
        }

        return response()->json($appointmentType);
    }

    public function delete($id)
    {
        $appointmentType = AppointmentType::find($id);
        if (!$appointmentType) {
            return response()->json(['message' => 'Tipo de cita no encontrado'], 404);
        }

        $appointmentType->delete();

        return redirect()->route('appointment_type')
            ->with('message', 'Cliente eliminado satisfactoriamente.');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $appointment_type = AppointmentType::where('name', 'like', '%' . $search . '%')
            ->orWhere('type', 'like', '%' . $search . '%')
            ->get();

        return response()->json($appointmentTypes);
    }

    public function showView(Request $request)
    {
        // $search = $request->input('search')
        $success = $request->get('success');
        $appointment_type = AppointmentType::all();
        $heads = [
            'ID',
            'Nombre',
            'Tipo',
            
        ];
        return view('admin.appointment_type.list', compact('appointment_type', 'heads', 'success'));
    }
    public function showCreate(Request $request)
    {

        return view('admin.appointment_type.create');
    }

    public function showEdit(Request $request, $id)
    {
        // $search = $request->input('search')
        $appointment_type = AppointmentType::find($id);
        return view('admin.appointment_type.edit', compact('appointment_type'));
    }
    
}

