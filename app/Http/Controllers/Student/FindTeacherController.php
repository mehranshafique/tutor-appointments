<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\UserInterFace;
use App\User;
use Illuminate\Http\Request;
use DB;
class FindTeacherController extends Controller
{
    public function index() {
      $teachers = User::Where('user_type', UserInterFace::TEACHER_ROLE_ID)->get();
      $teachers->load('services');
      $data['teachers'] = $teachers;
      return view('student.find-teacher')->with($data);
    }
}
