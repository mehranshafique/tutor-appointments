<?php

Route::group(['prefix' => 'v1'], function () {

// Get list of meetings.
Route::get('/meetings', 'Zoom\MeetingController@list');

// Create meeting room using topic, agenda, start_time.
Route::post('/meetings', 'Zoom\MeetingController@create');

// Get information of the meeting room by ID.
Route::get('/meetings/{id}', 'Zoom\MeetingController@get')->where('id', '[0-9]+');
Route::patch('/meetings/{id}', 'Zoom\MeetingController@update')->where('id', '[0-9]+');
Route::delete('/meetings/{id}', 'Zoom\MeetingController@delete')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Services
    Route::apiResource('services', 'ServicesApiController');

    // Employees
    Route::post('employees/media', 'EmployeesApiController@storeMedia')->name('employees.storeMedia');
    Route::apiResource('employees', 'EmployeesApiController');

    // Clients
    Route::apiResource('clients', 'ClientsApiController');

    // Appointments
    Route::apiResource('appointments', 'AppointmentsApiController');
});
