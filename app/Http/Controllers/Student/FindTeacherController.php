<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
// namespace MacsiDigital\Zoom;
// use MacsiDigital\Zoom\Support\Model;
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

    public function zoom(){
      $date = new \DateTime(date('Y-m-d H:i:s'));
      $date->format('Y-m-d\TH:i:s');
      $zoom = new \MacsiDigital\Zoom\Support\Entry;
      $user = new \MacsiDigital\Zoom\User($zoom);
      $user = $zoom::user()->create([
          'topic' => "testing",
          'type' => '1',
          'start_time' => $date->format('Y-m-d\TH:i:s'),
          'duration' => 30,
          'agenda' => "testing agenda",
          'settings' => [
              'host_video' => false,
              'participant_video' => false,
              'waiting_room' => true,
          ]
        ]);
        dd($user);
    }
}
