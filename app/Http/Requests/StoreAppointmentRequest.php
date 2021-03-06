<?php

namespace App\Http\Requests;

use App\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(!Gate::any(['appointment_create', 'student_appointment_access']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'client_id'   => [
                'required',
                'integer',
            ],
            'employee_id'   => [
                'required',
                'integer',
            ],
            'start_time'  => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'unique:appointments,start_time,employee_id,employee_id',
                'before_or_equal:finish_time'
            ],
            'finish_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'unique:appointments,finish_time,employee_id,employee_id',
                'after_or_equal:start_time'
            ],
            'services.*'  => [
                'integer',
            ],
            'services'    => [
                'array',
            ],
        ];
    }
}
