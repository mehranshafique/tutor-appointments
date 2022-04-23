@extends('layouts.admin')
@section('content')
<style>
</style>
<div class="container">
    <div class="main-body">

          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{ $teacher->name }}</h4>
                      <p class="text-secondary mb-1">{{ $teacher->introduction }}</p>
                      <p class="text-muted font-size-sm">{{ $teacher->location }}</p>
                      <button class="btn btn-primary" data-toggle="modal" data-target="#appointmentBookModal" >Book Session</button>
                      <!-- <button class="btn btn-outline-primary">Message</button> -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  @foreach($teacher_availbilities as $teacher_availbility)
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">{{ $teacher_availbility->start_time }}</h6>
                    <span class="text-primary">Till: {{ $teacher_availbility->finish_time }}</span>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $teacher->name }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $teacher->email }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $teacher->phone }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $teacher->location }}
                    </div>
                  </div>
                  <hr>

                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Known</i>Languages</h6>
                      @foreach($teacher->services as $id => $service)
                      <small>{{ $service->name }}</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">known </i>Subjects </h6>
                      @foreach($teacher->services as $id => $service)
                      <small>{{ $service->name }}</small>
                      <div class="progress mb-3" style="height: 5px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>



            </div>
          </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="appointmentBookModal" tabindex="-1" role="dialog" aria-labelledby="appointmentBookModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('global.create') }} {{ trans('cruds.appointment.title_singular') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

            <form action="{{ route("student.appointments.store") }}" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
                @method('post')
                @csrf
                <div class="form-group {{ $errors->has('client_id') ? 'has-error' : '' }}">
                    <label for="client">{{ trans('cruds.appointment.fields.client') }}*</label>
                    <select name="client_id" id="client" class="form-control select2" required>
                        @foreach($clients as $id => $client)
                            <option value="{{ $id }}" {{ (isset($appointment) && $appointment->client ? $appointment->client->id : old('client_id')) == $id ? 'selected' : '' }}>{{ $client }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('client_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('client_id') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }}">
                    <label for="employee">{{ trans('cruds.appointment.fields.employee') }}</label>
                    <select name="employee_id" id="employee" class="form-control select2">
                        @foreach($employees as $id => $employee)
                            <option value="{{ $id }}" {{ (isset($appointment) && $appointment->employee ? $appointment->employee->id : old('employee_id')) == $id ? 'selected' : '' }}>{{ $employee }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('employee_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('employee_id') }}
                        </em>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
                    <label for="start_time">{{ trans('cruds.appointment.fields.start_time') }}*</label>
                    <input type="text" id="start_time" name="start_time" class="form-control datetime" value="{{ old('start_time', isset($appointment) ? $appointment->start_time : '') }}" required>

                    @if($errors->has('start_time'))
                        <em class="invalid-feedback">
                            {{ $errors->first('start_time') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.appointment.fields.start_time_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('finish_time') ? 'has-error' : '' }}">
                    <label for="finish_time">{{ trans('cruds.appointment.fields.finish_time') }}*</label>
                    <input type="text" id="finish_time" name="finish_time" class="form-control datetime" value="{{ old('finish_time', isset($appointment) ? $appointment->finish_time : '') }}" required>
                    @if($errors->has('finish_time'))
                        <em class="invalid-feedback">
                            {{ $errors->first('finish_time') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.appointment.fields.finish_time_helper') }}
                    </p>
                </div>

                <div class="form-group {{ $errors->has('comments') ? 'has-error' : '' }}">
                    <label for="comments">{{ trans('cruds.appointment.fields.comments') }}</label>
                    <textarea id="comments" name="comments" class="form-control ">{{ old('comments', isset($appointment) ? $appointment->comments : '') }}</textarea>
                    @if($errors->has('comments'))
                        <em class="invalid-feedback">
                            {{ $errors->first('comments') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.appointment.fields.comments_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
                    <label for="services">{{ trans('cruds.appointment.fields.services') }}
                        <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                    <select name="services[]" id="services" class="form-control select2" multiple="multiple">
                        @foreach($teacher->services as $id => $service)
                            <option value="{{ $service->id }}" {{ (in_array($id, old('services', [])) || isset($appointment) && $appointment->service->contains($id)) ? 'selected' : '' }}>{{ $service->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('services'))
                        <em class="invalid-feedback">
                            {{ $errors->first('services') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.appointment.fields.services_helper') }}
                    </p>
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button  class="btn btn-primary"  type="submit" >{{ trans('global.save') }}</button>
                </div>
            </form>
        </div>
      </div>
    </div>

@endsection
