@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.introduction') }}
                        </th>
                        <td>
                            {{ $user->introduction }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.dob') }}
                        </th>
                        <td>
                            {{ $user->dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.user_type') }}
                        </th>
                        <td>
                          @if ($user->user_type == \App\UserInterFace::TEACHER_ROLE_ID)
                            {{ trans('cruds.user.fields.teacher') }}
                          @elseif ($user->user_type == \App\UserInterFace::STUDENT_ROLE_ID)
                            {{ trans('cruds.user.fields.student') }}
                          @else
                            {{ trans('cruds.user.fields.admin') }}
                          @endif
                        </td>
                    </tr>
                    @if($user->user_type == \App\UserInterFace::TEACHER_ROLE_ID)

                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.hourly_pay') }}
                        </th>
                        <td>
                            {{ $user->hourly_pay }}
                        </td>
                    </tr>
                    @endif

                    @if($user->user_type == \App\UserInterFace::STUDENT_ROLE_ID)

                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.credit') }}
                        </th>
                        <td>
                            {{ $user->credit }}
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.gender') }}
                        </th>
                        <td>
                          @if ($user->gender == \App\UserInterFace::MALE)
                            {{ trans('cruds.user.fields.male') }}
                          @elseif ($user->gender == \App\UserInterFace::FEMALE)
                            {{ trans('cruds.user.fields.female') }}
                          @else
                            {{ trans('cruds.user.fields.other') }}
                          @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.location') }}
                        </th>
                        <td>
                            {{ $user->location }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.country') }}
                        </th>
                        <td>
                            {{ $user->country }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Roles
                        </th>
                        <td>
                            @foreach($user->roles as $id => $roles)
                                <span class="label label-info label-many">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection
