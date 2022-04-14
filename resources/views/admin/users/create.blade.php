@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.users.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.email_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('introduction') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.user.fields.introduction') }}*</label>
                <input type="text" id="introduction" name="introduction" class="form-control" value="{{ old('introduction', isset($user) ? $user->introduction : '') }}" >
                @if($errors->has('introduction'))
                    <em class="invalid-feedback">
                        {{ $errors->first('introduction') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.introduction_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
                <label for="dob">{{ trans('cruds.user.fields.dob') }}*</label>
                <input type="date" id="dob" name="dob" class="form-control" value="{{ old('dob', isset($user) ? $user->dob : '') }}" >
                @if($errors->has('dob'))
                    <em class="invalid-feedback">
                        {{ $errors->first('dob') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.dob_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('user_type') ? 'has-error' : '' }}">
                <label for="user_type">{{ trans('cruds.user.fields.user_type') }}*</label>
                <select name="user_type" id="user_type" required class="form-control">
                  <option value="1"> {{ trans('cruds.user.fields.admin') }}</option>
                    <option value="2"> {{ trans('cruds.user.fields.teacher') }}</option>
                    <option value="3"> {{ trans('cruds.user.fields.student') }}</option>
                </select>
                @if($errors->has('user_type'))
                    <em class="invalid-feedback">
                        {{ $errors->first('user_type') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.user_type_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                <label for="gender">{{ trans('cruds.user.fields.status') }}*</label>
                <select name="gender" id="gender" required class="form-control">
                    <option value="1"> {{ trans('cruds.user.fields.male') }}</option>
                    <option value="0"> {{ trans('cruds.user.fields.female') }}</option>
                </select>
                @if($errors->has('gender'))
                    <em class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.gender_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                <label for="avatar">{{ trans('cruds.user.fields.picture') }}*</label>
                <input type="file" name="avatar" id="avatar" class="form-control" value="{{ old('avatar', isset($user) ? $user->avatar : '') }}" >
                @if($errors->has('avatar'))
                    <em class="invalid-feedback">
                        {{ $errors->first('avatar') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.avatar_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">{{ trans('cruds.user.fields.status') }}*</label>
                <select name="status" id="status" required class="form-control">
                    <option value="1"> {{ trans('cruds.user.fields.active') }}</option>
                    <option value="0"> {{ trans('cruds.user.fields.block') }}</option>
                </select>
                @if($errors->has('status'))
                    <em class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.status_helper') }}
                </p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">{{ trans('cruds.user.fields.phone') }}*</label>
                <input type="number" name="phone" id="phone"  class="form-control" value="{{ old('phone', isset($user) ? $user->phone : '') }}" >
                @if($errors->has('phone'))
                    <em class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.phone_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                <label for="location">{{ trans('cruds.user.fields.location') }}*</label>
                <input type="text" name="location" id="location" name="location" class="form-control" value="{{ old('location', isset($user) ? $user->location : '') }}" >
                @if($errors->has('location'))
                    <em class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.location_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                <label for="country">{{ trans('cruds.user.fields.country') }}*</label>
                <select name="country" id="country" required class="form-control">
                    <option value="1"> Pakistan</option>
                    <option value="2"> US</option>
                </select>
                @if($errors->has('country'))
                    <em class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.country_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input type="password" id="password" name="password" class="form-control" >
                @if($errors->has('password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.password_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('cruds.user.fields.roles') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <em class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.roles_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
          </div>
        </div>
      </form>

    </div>
</div>
@endsection
