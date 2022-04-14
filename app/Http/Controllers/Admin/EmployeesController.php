<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\User;
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
            // $query = User::all()->where('user_type', '2');
            $query = DB::table('users')->Where('user_type', UserInterFace::TEACHER_ROLE_ID)->get();

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

            // $table->editColumn('phone', function ($row) {
            //     return   $row->avatar ?  '<a href="%s" target="_blank"><img src="'.$row->avatar.'" width="50px" height="50px"></a>' : "";
            // });

            $table->editColumn('avatar', function ($row) {
                if ($photo = $row->avatar) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $row->avatar? $row->avatar: '',
                        $row->avatar? $row->avatar: ''
                    );
                }

                return '';
            });


            $table->rawColumns(['actions', 'placeholder', 'photo']);

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

        if ($request->input('photo', false)) {
            $teacher->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
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
}
