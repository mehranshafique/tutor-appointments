<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServiceRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\ChildSubject;
use App\Service;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ChildSubjectController extends Controller
{
    public function index(Request $request)
    {
        $data['child_subjects'] = [];
        if ($request->ajax()) {
            // $query = ChildSubject::with(['subjects'])->select(sprintf('%s.*', (new ChildSubject)->table));
            $query = $data['child_subjects'] = ChildSubject::select('*')->with('subjects')->get();
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'child_subject_show';
                $editGate      = 'child_subject_edit';
                $deleteGate    = 'child_subject_delete';
                $crudRoutePart = 'child-subjects';

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
            $table->editColumn('language', function ($row) {
                return $row->name ? $row->name : "";
            });

            $table->editColumn('category', function ($row) {
                return $row->subjects->name ?$row->subjects->name  : "";
            });

            $table->editColumn('picture', function ($row) {
                return $row->picture ? $row->picture : "";
            });

            $table->editColumn('description', function ($row) {
                return $row->picture ? $row->description : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('admin.child_subjects.index')->with($data);
    }

    public function create()
    {
        abort_if(Gate::denies('child_subject_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['subjects'] = Service::all();
        return view('admin.child_subjects.create')->with($data);
    }

    public function store(Request $request)
    {
        $service = ChildSubject::create($request->all());

        return redirect()->route('admin.child-subjects.index');
    }

    public function edit($id)
    {
        abort_if(Gate::denies('child_subject_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['service'] = ChildSubject::find($id);
        $data['subjects'] = Service::all();
        return view('admin.child_subjects.edit')->with($data);
    }

    public function update(Request $request, ChildSubject $child_subject)
    {
        $child_subject->update($request->all());

        return redirect()->route('admin.child-subjects.index');
    }

    public function show(ChildSubject $service)
    {
        abort_if(Gate::denies('child_subject_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.child_subjects.show', compact('service'));
    }

    public function destroy(ChildSubject $child_subject)
    {
        abort_if(Gate::denies('child_subject_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $child_subject->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        ChildSubject::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
