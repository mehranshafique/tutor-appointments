<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use App\Client;
use App\UserInterFace;
use App\User;
use App\Price;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Service;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Appointment::with(['client', 'employee', 'services'])->select(sprintf('%s.*', (new Appointment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointment_show';
                $editGate      = 'appointment_edit';
                $deleteGate    = 'appointment_delete';
                $crudRoutePart = 'appointments';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->addColumn('employee_name', function ($row) {
                return $row->employee ? $row->employee->name : '';
            });

            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
            });
            $table->editColumn('status', function ($row) {
                return ($row->status==0) ?  "Pending": "End";
            });

            $table->editColumn('comments', function ($row) {
                return $row->comments ? $row->comments : "";
            });
            $table->editColumn('services', function ($row) {
                $labels = [];

                foreach ($row->services as $service) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $service->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'employee', 'services']);

            return $table->make(true);
        }

        return view('admin.appointments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = User::where('user_type', UserInterFace::STUDENT_ROLE_ID)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::where('user_type', UserInterFace::TEACHER_ROLE_ID)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $clients = Client::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        // $employees = Employee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::all()->pluck('name', 'id');
        $price = Price::first();

        return view('admin.appointments.create', compact('clients', 'employees', 'services', 'price'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        //$price = Price::first();
      //call helper function get_time_difference
       $price = get_time_difference($request->input('start_time'), $request->input('finish_time'));
       $teacher = User::find($request->input('employee_id'));
       $price = ($price/60) * $teacher->hourly_pay;
       $appointment = Appointment::create(array_merge($request->all(), ['price' => $price]));
       $appointment->services()->sync($request->input('services', []));

        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $clients = Client::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $employees = Employee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = User::where('user_type', UserInterFace::STUDENT_ROLE_ID)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::where('user_type', UserInterFace::TEACHER_ROLE_ID)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::all()->pluck('name', 'id');
        $statuses = ['Pending', 'End'];
        $appointment->load('client', 'employee', 'services');

        return view('admin.appointments.edit', compact('clients', 'employees', 'services', 'appointment', 'statuses'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());
        $appointment->services()->sync($request->input('services', []));

        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('client', 'employee', 'services');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        Appointment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function student_appointments($student_id, Request $request)
    {
        if ($request->ajax()) {
            $query = Appointment::with(['client', 'employee', 'services'])->select(sprintf('%s.*', (new Appointment)->table))->where('client_id', $student_id)->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointment_show';
                $editGate      = 'appointment_edit';
                $deleteGate    = 'appointment_delete';
                $crudRoutePart = 'appointments';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->addColumn('employee_name', function ($row) {
                return $row->employee ? $row->employee->name : '';
            });

            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : "";
            });
            $table->editColumn('status', function ($row) {
                return ($row->status==0) ?  "Pending": "End";
            });

            $table->editColumn('comments', function ($row) {
                return $row->comments ? $row->comments : "";
            });
            $table->editColumn('services', function ($row) {
                $labels = [];

                foreach ($row->services as $service) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $service->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'employee', 'services']);

            return $table->make(true);
        }

        return view('admin.appointments.index');
    }

}
