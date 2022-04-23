<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Appointment;
use App\Client;
use App\UserInterFace;
use App\User;
use Auth;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
class AppointmentsControllerer extends Controller
{
  public function index(Request $request)
  {
      if ($request->ajax()) {
          $query = Appointment::with(['client', 'employee', 'services'])->where('client_id', Auth::user()->id)->select(sprintf('%s.*', (new Appointment)->table));
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

          $table->addColumn('employee_name', function ($row) {
              return $row->employee ? $row->employee->name : '';
          });

          $table->addColumn('start_time', function ($row) {
              $time = $row->start_time;
              $now = strtotime(date('Y-m-d H:i'));
              if(isset($time)) {
              if(date('d', strtotime($time)) == date('d', $now))
               return '<p class="text-warning">'.$time.'</p>';
              else if(strtotime($time) < $now)
                return '<p class="text-secondary">'.$time.'</p>';
              else
                return '<p class="text-info">'.$time.'</p>';
              }else
                 return '';
          });

          $table->addColumn('finish_time', function ($row) {
              $time = $row->finish_time;
              $now = strtotime(date('Y-m-d H:i'));
              if(isset($time)) {
              if(date('d', strtotime($time)) == date('d', $now))
               return '<p class="text-warning">'.$time.'</p>';
              else if(strtotime($time) < $now)
                return '<p class="text-secondary">'.$time.'</p>';
              else
                return '<p class="text-info">'.$time.'</p>';
              }else
                 return '';
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

          $table->editColumn('class', function ($row) {
              return ($row->status==0) ?  "<a href='' class='btn btn-primary'> Start</a>": "<a href='' class='btn btn-secondary'> View</a>";
          });

          $table->rawColumns(['start_time', 'finish_time', 'actions', 'placeholder', 'client', 'employee', 'services', 'class']);

          return $table->make(true);
      }

      return view('student.my-appointments');
  }

  public function store(StoreAppointmentRequest $request)
  {
    // ->whereDay('start_time', '=', date("d", strtotime($request->start_time)))
    // ->whereTime('start_time', '>=', date("H:i", strtotime($request->start_time)))
    // ->whereTime('finish_times', '<=', date("H:i", strtotime($request->finish_time)))
    // ->where('start_time', '<=', $request->input('start_time'))
    // ->where('finish_time', '>=', $request->input('finish_time'))
    //->whereBetween('start_time', [$request->start_time, $request->finish_time] )
      echo date("H:i", strtotime($request->start_time)). "= ".$request->input('finish_time');
      $start_timeExists = \App\TeacherAvailbility::where('teacher_id', $request->input('employee_id'))
      ->whereYear('start_time', '=', date("Y", strtotime($request->start_time)))
      ->whereMonth('start_time', '=', date("m", strtotime($request->start_time)))
      ->whereDay('start_time', '=', date("d", strtotime($request->start_time)))
      ->whereTime('start_time', '<=', date("H:i", strtotime($request->start_time)))
      ->exists();

      $finish_timeExists = \App\TeacherAvailbility::where('teacher_id', $request->input('employee_id'))
      ->whereYear('finish_time', '=', date("Y", strtotime($request->start_time)))
      ->whereMonth('finish_time', '=', date("m", strtotime($request->start_time)))
      ->whereDay('finish_time', '=', date("d", strtotime($request->start_time)))
      ->whereTime('finish_time', '>=', date("H:i", strtotime($request->finish_time)))
      ->exists();

      // $appointmentStartTimeExists = \App\Appointment::where('employee_id', $request->input('employee_id'))
      // ->whereRaw("? BETWEEN start_time AND finish_time", date("H:i", strtotime($request->start_time)))
      // ->whereDay('start_time', '=', date("d", strtotime($request->start_time)))
      // ->exists();
      //
      // $appointmentFinishTimeExists = \App\Appointment::where('employee_id', $request->input('employee_id'))
      // ->whereYear('finish_time', '=', date("Y", strtotime($request->finish_time)))
      // ->whereMonth('finish_time', '=', date("m", strtotime($request->finish_time)))
      // ->whereDay('finish_time', '=', date("d", strtotime($request->finish_time)))
      // ->where('finish_time', '=', date("H:i", strtotime($request->finish_time)))
      // ->exists();

      if(!$start_timeExists && !$finish_timeExists){
        return redirect()->back()->withErrors("This teacher isn't available at your selected date and time")->withInput();
      }
      // if($appointmentStartTimeExists && $appointmentFinishTimeExists){
      //   return redirect()->back()->withErrors("At same date & time someone else has already booked an appointment. Please just change the appointment time!")->withInput();
      // }

      $appointment = Appointment::create($request->all());
      $appointment->services()->sync($request->input('services', []));

      return redirect()->route('student.appointments.index')->with('success', 'appointment has been created');
  }
}
