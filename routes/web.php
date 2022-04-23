<?php
use App\ChildSubject;
use App\Http\Controllers\Student\AppointmentsController;
Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);
Route::get('/child', function (Request $request) {
    $data['child_subjects'] = ChildSubject::select('*')->with('subjects')->orderBy('subject_id')->get();
    // $data['child_subjects'] = $child_subjects->groupBy('subject_id');
    return view('student.child-subject-list')->with($data);
});

// student login routes
Route::group(['prefix' => 'student', 'as' => 'student.', 'namespace' => 'Student', 'middleware' => ['auth']], function () {
  Route::get('find-teacher', 'FindTeacherController@index');
  Route::get('teacher-details/{id}', 'TeacherDetailsController@index');
  Route::get('my-appointments', 'AppointmentsControllerer@index')->name('appointments.index');
  Route::post('appointments/store', 'AppointmentsControllerer@store')->name('appointments.store');

  // Route::resource('appointments', 'AppointmentsController');
  // Route::get('student-appointments/{id}', 'AppointmentsController@student_appointments');
  // Route::get('appointment/store', 'AppointmentsControllerer@index')->name('studentAppointments.store');
});
Route::group(['prefix' => 'student', 'as' => 'student.', 'namespace' => 'admin', 'middleware' => ['auth']], function () {
  Route::get('student-calendar/{id}', 'SystemCalendarController@student')->name('student.studentCalendar');
});
// admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // subjects
    Route::delete('subjects/destroy', 'ServicesController@massDestroy')->name('subjects.massDestroy');
    Route::resource('subjects', 'ServicesController');

    // child subjects
    Route::delete('child-subjects/destroy', 'ChildSubjectController@massDestroy')->name('child-subjects.massDestroy');
    Route::resource('child-subjects', 'ChildSubjectController');

    // teachers
    Route::delete('teachers/destroy', 'EmployeesController@massDestroy')->name('teachers.massDestroy');
    Route::post('teachers/media', 'EmployeesController@storeMedia')->name('teachers.storeMedia');
    Route::resource('teachers', 'EmployeesController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientsController');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentsController');
    Route::get('student-appointments/{id}', 'AppointmentsController@student_appointments');

    // Teacher availbilities
    Route::delete('availbilities/destroy', 'TeacherAvailbilityController@massDestroy')->name('availbilities.massDestroy');
    Route::resource('availbilities', 'TeacherAvailbilityController');

    // calendar
    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('teacher-calendar', 'TeacherAvailbilityController@calendar')->name('teacherCalendar');
    Route::get('student-calendar/{id}', 'SystemCalendarController@student')->name('studentCalendar');
});
