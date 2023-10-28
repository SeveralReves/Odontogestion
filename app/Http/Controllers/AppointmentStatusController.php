<?php

namespace App\Http\Controllers;

use App\Models\AppointmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class AppointmentStatusController extends Controller
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

        $appointmentStatus = AppointmentStatus::create($request->all());
        return response()->json($appointmentStatus, 201);
    }

    public function update(Request $request, $id)
    {
        $appointmentStatus = AppointmentStatus::find($id);

        if (!$appointmentStatus) {
            return response()->json(['message' => 'Estado de cita no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $appointmentStatus->update($request->all());
        return response()->json($appointmentStatus);
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

        return response()->json(['message' => 'Estado de cita eliminado']);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $appointmentStatuses = AppointmentStatus::where('name', 'like', '%' . $search . '%')
            ->orWhere('type', 'like', '%' . $search . '%')
            ->get();

        return response()->json($appointmentStatuses);
    }
}
