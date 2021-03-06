@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employee.title_singular') }}
    </div>

    <div class="card-body">
      <form action="{{ route("admin.availbilities.update", [$teacherAvailbility->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
          <div class="form-group {{ $errors->has('teacher_id') ? 'has-error' : '' }}">
              <label for="employee">{{ trans('cruds.appointment.fields.employee') }}</label>
              <select name="teacher_id" id="employee" class="form-control select2">
                  @foreach($teachers as $id => $teacher)
                      <option value="{{ $id }}" {{ (isset($teacherAvailbility) && $teacherAvailbility->id ? $teacherAvailbility->teacher_id : old('teacher_id')) == $id ? 'selected' : '' }}>{{ $teacher }}</option>
                  @endforeach
              </select>
              @if($errors->has('teacher_id'))
                  <em class="invalid-feedback">
                      {{ $errors->first('teacher_id') }}
                  </em>
              @endif
          </div>
          <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
              <label for="start_time">{{ trans('cruds.appointment.fields.start_time') }}*</label>
              <input type="text" id="start_time" name="start_time" class="form-control datetime" value="{{ old('start_time', isset($teacherAvailbility) ? $teacherAvailbility->start_time : '') }}" required>
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
              <input type="text" id="finish_time" name="finish_time" class="form-control datetime" value="{{ old('finish_time', isset($teacherAvailbility) ? $teacherAvailbility->finish_time : '') }}" required>
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
              <textarea id="comments" name="comments" class="form-control ">{{ old('comments', isset($teacherAvailbility) ? $teacherAvailbility->comments : '') }}</textarea>
              @if($errors->has('comments'))
                  <em class="invalid-feedback">
                      {{ $errors->first('comments') }}
                  </em>
              @endif
              <p class="helper-block">
                  {{ trans('cruds.appointment.fields.comments_helper') }}
              </p>
          </div>
          <div>
              <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
          </div>
      </form>

    </div>
</div>
@endsection

@section('scripts')

@stop
