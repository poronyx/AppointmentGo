<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Instituition;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //
    public function createAppointment(Request $request)
    {

        if ($request->input('owner_id') == "NA") {
            $appointment = Appointment::create([
                'owner_id' => $request->input('owner_id'),
                'owner_type' => 'Institute',
                'patient_id' => $request->input('patient_id'),
                'prescription_id' => $request->input('prescription_id'),
                'appointment_date' => $request->input('appointment_date'),
                'time' => $request->input('time'),
                'satisfaction_id' => $request->input('satisfaction_id'),
                'instituition_id' => $request->input('instituition_id'),
                'appointment_type' => $request->input('appointment_type'),
                'symptoms' => $request->input('symptoms'),
            ]);
        } else {
            $appointment = Appointment::create([
                'owner_id' => $request->input('owner_id'),
                'owner_type' => 'Doctor',
                'patient_id' => $request->input('patient_id'),
                'prescription_id' => $request->input('prescription_id'),
                'appointment_date' => $request->input('appointment_date'),
                'time' => $request->input('time'),
                'satisfaction_id' => $request->input('satisfaction_id'),
                'instituition_id' => $request->input('instituition_id'),
                'appointment_type' => $request->input('appointment_type'),
                'symptoms' => $request->input('symptoms'),
            ]);
        }

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

    public function patientGetDoctorAvailability(Request $request)
    {

        $date = $request->input('date');
        $doctorId = $request->input('owner_id');
        $instituteId = $request->input('institute_id');

        $instituteTime =  Instituition::select('opening_time')
            ->where('id', $instituteId)
            ->get();

        $test = [];

        $i = 0;
        foreach ($instituteTime[0]->opening_time as $time) {
            $test[$i] = $time;
            $i++;
        }
        $firstOpening = $test[0];
        $secondOpening = $test[1];
        //['options->enabled' => true]

        // If appointment was made to institute
        if ($request->input('owner_id') == "NA") {
            $appointmentSlot = Appointment::select('time')
                ->where('owner_type', 'Institute')
                ->where('owner_id', $instituteId)
                ->where('instituition_id', $instituteId)
                ->where('appointment_date', $date)
                ->get();

            $slots = [];
            $slotsStart = [];
            $slotsEnd = [];

            $x = 0;
            foreach ($appointmentSlot as $slot) {
                $slots[$x] = intval($slot->time);
                $x++;
            }

            $y = 0;
            foreach ($slots as $slot) {
                $slotsStart[$y] = $slot;
                $y++;
            }

            $dailySlots = [];

            $finalSlots = [];


            $arrayDiff = array_diff($dailySlots, $slots);
            //combine slots for entire day
            for ($i = $firstOpening[0]; $i <= $firstOpening[1]; $i++) {
                array_push($dailySlots, $i);
            }
            for ($i = $secondOpening[0]; $i <= $secondOpening[1]; $i++) {
                array_push($dailySlots, $i);
            }


            foreach ($dailySlots as $item) {    // Loop the daily slots
                if (!in_array($item, $slots)) {   // If slots are made, remove slot from the daily slots
                    array_push($finalSlots, $item);
                }
            }
        } else {
            $appointmentSlot = Appointment::select('time')
                ->where('owner_type', 'Doctor')
                ->where('owner_id', $doctorId)
                ->where('instituition_id', $instituteId)
                ->where('appointment_date', $date)
                ->get();

            $slots = [];
            $slotsStart = [];
            $slotsEnd = [];

            $x = 0;
            foreach ($appointmentSlot as $slot) {
                $slots[$x] = intval($slot->time);
                $x++;
            }

            $y = 0;
            foreach ($slots as $slot) {
                $slotsStart[$y] = $slot;
                $y++;
            }

            $dailySlots = [];

            $finalSlots = [];


            $arrayDiff = array_diff($dailySlots, $slots);
            //combine slots for entire day
            for ($i = $firstOpening[0]; $i <= $firstOpening[1]; $i++) {
                array_push($dailySlots, $i);
            }
            for ($i = $secondOpening[0]; $i <= $secondOpening[1]; $i++) {
                array_push($dailySlots, $i);
            }


            foreach ($dailySlots as $item) {    // Loop the daily slots
                if (!in_array($item, $slots)) {   // If slots are made, remove slot from the daily slots
                    array_push($finalSlots, $item);
                }
            }
        }


        return response([
            'first_opening' => $firstOpening,
            'second_opening' => $secondOpening,
            'unavailable slot' => $slots,
            'dailySlots' => $dailySlots,
            'final_slots' => $finalSlots

        ]);
    }
}
