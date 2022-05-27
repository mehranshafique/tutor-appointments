@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.packages.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.packages.fields.id') }}
                        </th>
                        <td>
                            {{ $package->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packages.fields.name') }}
                        </th>
                        <td>
                            {{ $package->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.packages.fields.price') }}
                        </th>
                        <td>
                            {{ App\UserInterFace::CURRENCY_SYMBOL }}{{ $package->price }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.packages.fields.duration') }}
                        </th>
                        <td>
                            {{ $package->duration }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.packages.fields.duration_type') }}
                        </th>
                        <td>
                            {{ $package->duration_type }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.packages.fields.auto_renew') }}
                        </th>
                        <td>
                            {{ $package->auto_renew }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.packages.fields.allowed_classes') }}
                        </th>
                        <td>
                            {{ $package->allowed_classes }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.packages.fields.description') }}
                        </th>
                        <td>
                            {{ $package->description }}
                        </td>
                    </tr>

                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection
