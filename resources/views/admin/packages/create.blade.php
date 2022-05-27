@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.packages.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.packages.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.packages.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($package) ? $package->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.packages.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">{{ trans('cruds.packages.fields.price') }}*</label>
                <input type="text" id="price" name="price" class="form-control" value="{{ old('price', isset($package) ? $package->price : '') }}" >
                @if($errors->has('price'))
                    <em class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.packages.fields.price_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('duration') ? ' has-error' : '' }}">
                <label for="duration">{{ trans('cruds.packages.fields.duration') }}*</label>
                <input type="number" id="duration" name="duration" class="form-control" value="{{ old('duration', isset($package) ? $package->duration : '') }}" >
                @if($errors->has('duration'))
                    <em class="invalid-feedback">
                        {{ $errors->first('duration') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.packages.fields.duration_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('duration_type') ? 'has-error' : '' }}">
                <label for="duration_type">{{ trans('cruds.packages.fields.duration_type') }}*</label>
                <select name="duration_type" id="duration_type" required class="form-control">
                  <option value="Day">{{ trans('cruds.packages.fields.duration_day') }}</option>
                  <option value="Week">{{ trans('cruds.packages.fields.duration_week') }}</option>
                  <option value="Month">{{ trans('cruds.packages.fields.duration_month') }}</option>
                  <option value="Year">{{ trans('cruds.packages.fields.duration_year') }}</option>
                </select>
                @if($errors->has('duration_type'))
                    <em class="invalid-feedback">
                        {{ $errors->first('duration_type') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.packages.fields.duration_type_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('auto_renew') ? 'has-error' : '' }}">
                <label for="auto_renew">{{ trans('cruds.packages.fields.auto_renew') }}*</label>
                <select name="auto_renew" id="auto_renew" required class="form-control">
                  <option value="1">{{ trans('cruds.packages.fields.auto_renew_yes') }}</option>
                  <option value="0">{{ trans('cruds.packages.fields.auto_renew_no') }}</option>
                </select>
                @if($errors->has('auto_renew'))
                    <em class="invalid-feedback">
                        {{ $errors->first('auto_renew') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.packages.fields.auto_renew_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('allowed_classes') ? ' has-error' : '' }}">
                <label for="allowed_classes">{{ trans('cruds.packages.fields.allowed_classes') }}*</label>
                <input type="number" id="allowed_classes" name="allowed_classes" class="form-control" value="{{ old('allowed_classes', isset($package) ? $package->allowed_classes : '') }}" >
                @if($errors->has('allowed_classes'))
                    <em class="invalid-feedback">
                        {{ $errors->first('allowed_classes') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.packages.fields.allowed_classes_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.packages.fields.description') }}*</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($service) ? $service->description : '') }}" required>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.packages.fields.description_helper') }}
                </p>
            </div>

            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection
