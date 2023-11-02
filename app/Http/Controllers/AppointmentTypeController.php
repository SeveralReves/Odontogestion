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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $appointmentType = AppointmentType::create($request->all());
        return response()->json($appointmentType, 201);
    }

    public function update(Request $request, $id)
    {
        $appointmentType = AppointmentType::find($id);

        if (!$appointmentType) {
            return response()->json(['message' => 'Tipo de cita no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $appointmentType->update($request->all());
        return response()->json($appointmentType);
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

        return response()->json(['message' => 'Tipo de cita eliminado']);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $appointmentTypes = AppointmentType::where('name', 'like', '%' . $search . '%')
            ->orWhere('type', 'like', '%' . $search . '%')
            ->get();

        return response()->json($appointmentTypes);
    }
}
