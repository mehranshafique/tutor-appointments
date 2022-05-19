<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\User;
use App\Appointment;
use App\UserInterFace;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEmployeeRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Service;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmployeesController extends Controller
{
    use MediaUploadingTrait;

    public function index1(Request $request)
    {
        if ($request->ajax()) {
            $query = Employee::with(['services'])->select(sprintf('%s.*', (new Employee)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'teacher_show';
                $editGate      = 'teacher_edit';
                $deleteGate    = 'teacher_delete';
                $crudRoutePart = 'teachers';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('services', function ($row) {
                $labels = [];

                foreach ($row->services as $service) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $service->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'photo', 'services']);

            return $table->make(true);
        }

        return view('admin.teachers.index');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $blocked = $request->query('blocked');
            // $query = User::all()->where('user_type', '2');
            if($blocked == "true") {
              $query = DB::table('users')->Where('user_type', UserInterFace::TEACHER_ROLE_ID)->Where( 'status', 0)->get();
            }
            else{
              $query = DB::table('users')->Where('user_type', UserInterFace::TEACHER_ROLE_ID)->get();
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_show';
                $editGate      = 'user_edit';
                $deleteGate    = 'user_delete';
                $crudRoutePart = 'users';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : "";
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : "";
            });

            $table->editColumn('hourly_pay', function ($row) {
                return   $row->hourly_pay ?  $row->hourly_pay : "";
           });
            $table->editColumn('avatar', function ($row) {
                if ($photo = $row->avatar) {
                // return   '<a href="%s" target="_blank"><img src="$row->avatar" width="50px" height="50px"></a>';
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $row->avatar? $row->avatar: '',
                        $row->avatar? $row->avatar: ''
                    );
                }

                return '';
            });


            $table->rawColumns(['actions', 'placeholder', 'avatar']);

            return $table->make(true);
        }

        return view('admin.teachers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('teacher_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::all()->pluck('name', 'id');

        return view('admin.teachers.create', compact('services'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $teacher = Employee::create($request->all());
        $teacher->services()->sync($request->input('services', []));

        if ($request->input('avatar', false)) {
            $teacher->addMedia(storage_path('tmp/uploads/' . $request->input('avatar')))->toMediaCollection('photo');
        }

        return redirect()->route('admin.teachers.index');
    }

    public function edit(Employee $teacher)
    {
        abort_if(Gate::denies('teacher_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::all()->pluck('name', 'id');

        $teacher->load('services');

        return view('admin.teachers.edit', compact('services', 'teacher'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $teacher)
    {
        $teacher->update($request->all());
        $teacher->services()->sync($request->input('services', []));

        if ($request->input('photo', false)) {
            if (!$teacher->photo || $request->input('photo') !== $teacher->photo->file_name) {
                $teacher->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($teacher->photo) {
            $teacher->photo->delete();
        }

        return redirect()->route('admin.teachers.index');
    }

    public function show(Employee $teacher)
    {
        abort_if(Gate::denies('teacher_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teacher->load('services');

        return view('admin.teachers.show', compact('teacher'));
    }

    public function destroy(Employee $teacher)
    {
        abort_if(Gate::denies('teacher_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teacher->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmployeeRequest $request)
    {
        Employee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function reports(Request $request){

      if ($request->ajax()) {
          $blocked = $request->query('blocked');
          // $query = User::all()->where('user_type', '2');
          if($blocked == "true") {
            $query = DB::table('users')->Where('user_type', UserInterFace::TEACHER_ROLE_ID)->Where('status', 0)->get();
          }
          else{
            $query = DB::table('users')->Where('user_type', UserInterFace::TEACHER_ROLE_ID)->get();
          }

          $table = Datatables::of($query);

          $table->addColumn('placeholder', '&nbsp;');
          $table->addColumn('actions', '&nbsp;');

          $table->editColumn('actions', function ($row) {
              $viewGate      = 'user_show';
              $editGate      = 'user_edit';
              $deleteGate    = 'user_delete';
              $crudRoutePart = 'users';

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
          $table->editColumn('name', function ($row) {
              return $row->name ? $row->name : "";
          });
          $table->editColumn('email', function ($row) {
              return $row->email ? $row->email : "";
          });
          $table->editColumn('phone', function ($row) {
              return $row->phone ? $row->phone : "";
          });

          $table->editColumn('hourly_pay', function ($row) {
              return   $row->hourly_pay ?  $row->hourly_pay : "";
         });
          $table->editColumn('avatar', function ($row) {
              if ($photo = $row->avatar) {
              // return   '<a href="%s" target="_blank"><img src="$row->avatar" width="50px" height="50px"></a>';
                  return sprintf(
                      '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                      $row->avatar? $row->avatar: '',
                      $row->avatar? $row->avatar: ''
                  );
              }

              return '';
          });


          $table->rawColumns(['actions', 'placeholder', 'avatar']);

          return $table->make(true);
      }
      $teachers = DB::table('users')->Where('user_type', UserInterFace::TEACHER_ROLE_ID)->pluck('name', 'id');

      return view('admin.teacher-reports.index', compact('teachers'));
    }

    public function get_report(Request $request){

      if ($request->ajax()) {
        // dd($request);
        $query = Appointment::where('employee_id' , $request->input('teacher_id'))
                  ->whereBetween('created_at', [$request->input('start_date'), $request->input('end_date')])
                  ->with(['client', 'employee', 'services'])
                  ->get();

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

          $table->addColumn('hourly_pay', function ($row) {
              return $row->employee ? \App\UserInterFace::CURRENCY_SYMBOL .$row->employee->hourly_pay : '';
          });

          $table->editColumn('price', function ($row) {
              return $row->price ? \App\UserInterFace::CURRENCY_SYMBOL.$row->price : App\UserInterFace::CURRENCY_SYMBOL."0";
          });

          $table->editColumn('meeting_duration', function ($row) {
              //call helper function get_time_difference
              return $row->start_time ? get_time_difference($row->start_time, $row->finish_time)/60 : "0";
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

      // $teachers = DB::table('users')->Where('user_type', UserInterFace::TEACHER_ROLE_ID)->pluck('name', 'id');
      //
      // return view('admin.teacher-reports.index', compact('teachers'));
    }
}
