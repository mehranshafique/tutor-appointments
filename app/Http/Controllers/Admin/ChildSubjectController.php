<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServiceRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\ChildSubject;
use App\CurriculumDocuments;
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
                return $row->description ? $row->description : "";
            });

            $table->editColumn('documents', function ($row) {
              if ($row->id) {
                  return sprintf(
                      '<a href="%s" >Documents</a>',
                      'child-subjects/'.$row->id.'/documents'
                  );
              }
            });

            $table->rawColumns(['actions', 'placeholder', 'documents']);

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
        if ($request->input('picture', false)) {
            $service->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('photo');
        }
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


    // child subject curriculum documents

    public function documents($id, Request $request)
    {
        $data['child_subjects'] = [];
        if ($request->ajax()) {
            // $query = ChildSubject::with(['subjects'])->select(sprintf('%s.*', (new ChildSubject)->table));
            $query =  CurriculumDocuments::where('child_subject_id', $id)->get();
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'child_subject_document_show';
                $editGate      = '';
                //$deleteGate    = 'child_subject_document_delete';
                $deleteDocumentGate = 'child_subject_document_delete';
                $crudRoutePart = 'child-subjects';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    //'deleteGate',
                    'deleteDocumentGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('file_name', function ($row) {
                if ($row->file_name) {
                    return sprintf(
                        '<a href="%s" target="_blank">'.$row->file_name.'</a>',
                        public_path().'/files/'.$row->file_name
                    );
                }

            });

            $table->editColumn('file_type', function ($row) {
                return $row->file_type ?$row->file_type  : "";
            });

            $table->editColumn('file_size', function ($row) {
                return $row->file_size ? $row->file_size : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'file_name']);

            return $table->make(true);
        }
        return view('admin.child_subjects.documents')->with($data);
    }

    public function create_document(Request $request){
      return view('admin.child_subjects.documents');

    }

    public function store_document($curriculum_id, Request $request){

      $this->validate($request, [
               'file_names' => 'required',
               'file_names.*' => 'mimes:doc,pdf,docx,zip,ppt, xlsx, txt, xls, csv',
       ]);


       if($request->hasfile('file_names'))
        {
           foreach($request->file('file_names') as $file)
           {
               $extension = $file->extension();
               $size = $file->getSize();
               $name = time().'.'.$extension;
               $file->move(public_path().'/files/', $name);
               CurriculumDocuments::create([
                 'file_name' => $name,
                 'file_type' => $extension,
                 'file_size' => $size,
                 'child_subject_id' => $curriculum_id
               ]);

           }
        }


       return back()->with('success', 'Your files has been successfully added');
    }

    public function delete_document($id, Request $request){
      $document = CurriculumDocuments::find($id);
      CurriculumDocuments::where('id', $id)->delete();
      if(file_exists(public_path('files/'.$document->file_name))){
       unlink(public_path('files/'.$document->file_name));
      }
      return back()->with('success', 'Your files has been deleted successfully');
    }

}
