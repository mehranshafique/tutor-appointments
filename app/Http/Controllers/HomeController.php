<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChildSubject;
use App\Package;
class HomeController extends Controller
{
  public function index()
  {
      $data['child_subjects'] = ChildSubject::select('*')->with('subjects')->get();
      $data['packages'] = Package::all();
      return view('user-site.index')->with($data);
  }

  public function course_details($id){
    $data['course_details'] = ChildSubject::select('*')->with('subjects')->where('id', $id)->get();
    return view('user-site.course-details')->with($data);
  }
}
