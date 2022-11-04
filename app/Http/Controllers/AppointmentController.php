<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //
    public function createAppointment(Request $request)
    {

        $appointment = Appointment::create([
            'owner_id' => $request->input('owner_id'),
            'owner_type' => $request->input('owner_type'),
            'patient_id' => $request->input('patient_id'),
            'prescription_id' => $request->input('prescription_id'),
            'time_slot' => $request->input('time_slot'),
            'satisfaction_id' => $request->input('satisfaction_id'),
            'instituition_id' => $request->input('instituition_id'),
            'appointment_type' => $request->input('appointment_type'),
            'symptoms' => $request->input('symptoms'),
        ]);
        //Create Slots data for institute according to opening time
        //Generate three months ahead from today

        return response([
            'appointment' => $appointment
        ]);
    }

    public function getApointmentsForDoctor(Request $request)
    {
        $doctorId = $request->input('id');

        $appointments = Appointment::where('owner_id', $doctorId)
        ->where('owner_type', 'Doctor')
        ->get();
        
        return response([
            'appointments' => $appointments
        ]);

    }

    public function patientMakeAppointment(Request $request)
    {
        
        $appointment = Appointment::create([
            'owner_id' => $request->input('owner_id'),
            'owner_type' => $request->input('owner_type'),
            'patient_id' => $request->input('patient_id'),
            'prescription_id' => $request->input('prescription_id'),
            'time_slot' => $request->input('time_slot'),
            'satisfaction_id' => $request->input('satisfaction_id'),
            'instituition_id' => $request->input('instituition_id'),
            'appointment_type' => $request->input('appointment_type'),
            'symptoms' => $request->input('symptoms'),
        ]);
        //Create Slots data for institute according to opening time
        //Generate three months ahead from today

        return response([
            'appointment' => $appointment
        ]);

    }
}
