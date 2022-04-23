<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\UserInterFace;
use App\User;
use App\Service;
use App\TeacherAvailbility;
use Illuminate\Http\Request;
use DB;
use Auth;
class TeacherDetailsController extends Controller
{
  public function index($id) {
    $teacher = User::find($id);
    $teacher->load('services');
    $data['teacher'] = $teacher;
    $data['clients'] = User::where('user_type', UserInterFace::STUDENT_ROLE_ID)->where('id', Auth::user()->id)->get()->pluck('name', 'id');
    $data['employees'] = User::where('user_type', UserInterFace::TEACHER_ROLE_ID)->where('id', $id)->get()->pluck('name', 'id');
    // $services = Service::all()->pluck('name', 'id');
    // $data['services'] = $services->load('services');
    $data['teacher_availbilities'] = TeacherAvailbility::with(['teacher_availbility'])->where('teacher_id', $id)->get();
    return view('student.teacher-details')->with($data);
  }
}
