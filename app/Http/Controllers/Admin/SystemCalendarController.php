<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use App\Http\Controllers\Controller;

class SystemCalendarController extends Controller
{

    public function index()
    {
        $events = [];

        $appointments = Appointment::with(['client', 'employee'])->get();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }

            $events[] = [
                'title' => $appointment->client->name . '\'s meeting with teacher ('.$appointment->employee->name.')',
                'start' => $appointment->start_time,
                'end' => $appointment->end_time,
                'url'   => route('admin.appointments.edit', $appointment->id),
            ];
        }

        return view('admin.calendar.calendar', compact('events'));
    }

    public function student($student_id)
    {
        $events = [];

        $appointments = Appointment::with(['client', 'employee'])->where('client_id', $student_id)->get();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }

            $events[] = [
                'title' => $appointment->client->name . '\'s meeting with teacher ('.$appointment->employee->name.')',
                'start' => $appointment->start_time,
                'end' => $appointment->end_time,
                'url'   => route('admin.appointments.edit', $appointment->id),
            ];
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
