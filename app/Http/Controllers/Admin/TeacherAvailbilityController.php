<?php

namespace App\Http\Controllers\Admin;

use App\UserInterFace;
use App\User;
use App\TeacherAvailbility;
use App\Http\Controllers\Controller;
use Gate;
use Auth;
use Arr;
use Carbon\Carbon;
use Validator;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TeacherAvailbilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validation(){
      $validator = Validator::make(
          [
              'name' => 'Dayle',
              'password' => 'lamepassword',
              'email' => 'email@example.com'
          ],
          [
              'name' => 'required',
              'password' => 'required|min:8',
              'email' => 'required|email|unique:users'
          ]
      );
    }
    public function index(Request $request)
    {
      if ($request->ajax()) {
          // $query = User::all()->where('user_type', '2');
          // $query = DB::table('teacher_availbilities')->Where('user_type', UserInterFace::TEACHER_ROLE_ID)->get();
          $query = TeacherAvailbility::with(['teacher_availbility'])->get();
          if(Auth::user()->user_type == UserInterFace::TEACHER_ROLE_ID)
            $query = TeacherAvailbility::where('teacher_id', Auth::user()->id)->with(['teacher_availbility'])->get();

          $table = Datatables::of($query);

          $table->addColumn('placeholder', '&nbsp;');
          $table->addColumn('actions', '&nbsp;');

          $table->editColumn('actions', function ($row) {
              $viewGate      = 'teacher_show';
              $editGate      = 'teacher_edit';
              $deleteGate    = 'teacher_delete';
              $crudRoutePart = 'availbilities';

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
          $table->editColumn('start_time', function ($row) {
              return $row->start_time ? twelve_hours_format($row->start_time) : "";
          });
          $table->editColumn('end_time', function ($row) {
              return $row->finish_time ? twelve_hours_format($row->finish_time) : "";
          });
          $table->editColumn('teacher', function ($row) {
              return $row->teacher_availbility->name ? $row->teacher_availbility->name : "";
          });

          $table->editColumn('comments', function ($row) {
              return $row->comments ? $row->comments : "";
          });

          $table->rawColumns(['actions', 'placeholder', 'photo']);

          return $table->make(true);
      }

      return view('admin.teacher-availbilities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('teacher_availbility_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $clients = User::where('user_type', UserInterFace::STUDENT_ROLE_ID)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $employees = User::where('user_type', UserInterFace::TEACHER_ROLE_ID)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        if(Auth::user()->user_type == UserInterFace::TEACHER_ROLE_ID)
          $employees = User::where('id', auth::user()->id)->pluck('name', 'id');

        // $clients = Client::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        // $employees = Employee::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // $services = Service::all()->pluck('name', 'id');

        return view('admin.teacher-availbilities.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //call helper function get_time_difference
        $data = $request->all();
        $TA = new TeacherAvailbility;
        $validator = Validator::make($data, $TA->rules());

        if (!$validator->fails()){
          $totalMinutes = get_time_difference($request->input('start_time'), $request->input('finish_time'));
          $totalSessions = intval($totalMinutes / UserInterFace::ZOOM_MEETING_INTERVAL);
          $minutes = 0;
          $errors = [];
          $success = [];
          if($totalSessions <=0){
            $errors[] = 'Minimum session time should be 30 minutes';
          }

          for($i = 0; $i < $totalSessions; $i++){
            $data['start_time'] = Carbon::parse($request->input('start_time'))->addMinutes($minutes)->format('Y-m-d H:i:s');
            $minutes = $minutes + UserInterFace::ZOOM_MEETING_INTERVAL;
            $data['finish_time'] = Carbon::parse($data['start_time'])->addMinutes(UserInterFace::ZOOM_MEETING_INTERVAL)->format('Y-m-d H:i:s');
            $exist = TeacherAvailbility::select('id')
                    ->whereBetween('start_time', [$data['start_time'], $data['finish_time']])
                    ->whereBetween('finish_time', [$data['start_time'], $data['finish_time']])
                    ->where('teacher_id', $data['teacher_id'])->exists();
           if(!$exist){
              $TeacherAvailbility = TeacherAvailbility::create($data);
              $success[] = $data['start_time'].' & '.$data['finish_time'].'Availbilities successfully created';
            }else{
              $errors[] = $data['start_time'].' & '.$data['finish_time'].' this time already exist';
            }
          }
          return redirect()->route('admin.availbilities.index')->with('success', $success)->withErrors($errors);
      }
      else{
        return redirect()->back()->withErrors($validator->errors());
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $teachers = User::where('user_type', UserInterFace::TEACHER_ROLE_ID)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
      $teacherAvailbility = TeacherAvailbility::find($id);
      return view('admin.teacher-availbilities.edit', compact('teacherAvailbility', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $teacherAvailbility = TeacherAvailbility::find($id);
      $teacherAvailbility->update($request->all());
      // dd($teacherAvailbility->update($request->all()));
      return redirect()->route('admin.availbilities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function calendar(){
      $events = [];

      $availbilities = TeacherAvailbility::with(['teacher_availbility'])->get();
      if(Auth::user()->user_type == UserInterFace::TEACHER_ROLE_ID)
        $availbilities = TeacherAvailbility::where('teacher_id', Auth::user()->id)->with(['teacher_availbility'])->get();

      foreach ($availbilities as $availbility) {
          if (!$availbility->start_time) {
              continue;
          }

          $events[] = [
              'title' => $availbility->teacher_availbility->name . '\'s available from '.date_in_hours_format($availbility->start_time).' To: '.date_in_hours_format($availbility->finish_time),
              'start' => $availbility->start_time,
              'end' => $availbility->end_time,
              'url'   => route('admin.availbilities.edit', $availbility->id),
              'timeFormat'=> 'H:mm',
              'allDay' => false
          ];
      }
      return view('admin.calendar.calendar', compact('events'));
    }
}
