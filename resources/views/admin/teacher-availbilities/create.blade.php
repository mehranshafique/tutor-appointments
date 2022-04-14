@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.teacher.title_singular') }}
    </div>

    <div class="card-body">
      <form action="{{ route("admin.availbilities.store") }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group {{ $errors->has('teacher_id') ? 'has-error' : '' }}">
              <label for="employee">{{ trans('cruds.appointment.fields.employee') }}</label>
              <select name="teacher_id" id="employee" class="form-control select2">
                  @foreach($employees as $id => $employee)
                      <option value="{{ $id }}" {{ (isset($appointment) && $appointment->employee ? $appointment->employee->id : old('employee_id')) == $id ? 'selected' : '' }}>{{ $employee }}</option>
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
          <div>
              <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
          </div>
      </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.teachers.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($teacher) && $teacher->photo)
      var file = {!! json_encode($teacher->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@stop
