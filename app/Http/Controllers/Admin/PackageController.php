<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Package;
use App\UserInterFace;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      if ($request->ajax()) {
          // $query = ChildSubject::with(['subjects'])->select(sprintf('%s.*', (new ChildSubject)->table));
          $query = Package::all();
          $table = Datatables::of($query);
          $table->addColumn('placeholder', '&nbsp;');
          $table->addColumn('actions', '&nbsp;');

          $table->editColumn('actions', function ($row) {
              $viewGate      = 'package_show';
              $editGate      = 'package_edit';
              $deleteGate    = 'package_delete';
              $crudRoutePart = 'packages';

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

          $table->editColumn('price', function ($row) {
              return $row->price ?  UserInterFace::CURRENCY_SYMBOL.$row->price  : "";
          });

          $table->editColumn('duration', function ($row) {
              return $row->duration ? $row->duration." ".$row->duration_type : "";
          });
          
          $table->editColumn('auto_renew', function ($row) {
              return $row->auto_renew ? $row->auto_renew : "";
          });

          $table->editColumn('allowed_classes', function ($row) {
              return $row->allowed_classes ? $row->allowed_classes : "";
          });

          $table->editColumn('description', function ($row) {
              return $row->description ? $row->description : "";
          });
          $table->rawColumns(['actions', 'placeholder', 'documents']);

          return $table->make(true);
      }

      return view('admin.packages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
          'name' => 'required',
          'price' => 'required',
          'description' => 'required',
          'duration' => 'required',
          'duration_type' => 'required',
          'auto_renew' => 'required',
          'allowed_classes' => 'required'
      ]);

      Package::create($request->all());

      return redirect()->route('admin.packages.index')
                      ->with('success','package created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return view('admin.packages.show',compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit',compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
      $request->validate([
          'name' => 'required',
          'price' => 'required',
          'description' => 'required',
          'duration' => 'required',
          'duration_type' => 'required',
          'auto_renew' => 'required',
          'allowed_classes' => 'required'
      ]);

      $package->update($request->all());
      return redirect()->route('admin.packages.index')
                        ->with('success','package updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
      $package->delete();
      return redirect()->route('admin.packages.index')
                      ->with('success','Product deleted successfully');
    }
}
