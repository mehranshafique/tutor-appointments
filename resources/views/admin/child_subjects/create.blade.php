@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.child_subjects.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.child-subjects.store") }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">
                <label for="subject_id">{{ trans('cruds.child_subjects.fields.name') }}*</label>
                <select name="subject_id" id="subject_id" required class="form-control">
                  @foreach ($subjects as $subject)
                    <option value="{{$subject->id}}">{{ $subject->name }}</option>
                  @endforeach
                </select>
                @if($errors->has('subject_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('subject_id') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.child_subjects.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.child_subjects.fields.curriculum') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($service) ? $service->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.child_subjects.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.child_subjects.fields.description') }}*</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($service) ? $service->description : '') }}" required>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.child_subjects.fields.description_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('picture') ? 'has-error' : '' }}">
                <label for="picture">{{ trans('cruds.child_subjects.fields.picture') }}*</label>
                <input type="file" id="picture" name="picture" class="form-control" value="{{ old('picture', isset($service) ? $service->picture : '') }}" >
                @if($errors->has('picture'))
                    <em class="invalid-feedback">
                        {{ $errors->first('picture') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.child_subjects.fields.picture_helper') }}
                </p>
            </div>

            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection
