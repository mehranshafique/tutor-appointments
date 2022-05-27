@extends('layouts.admin')
@section('content')
@can('package_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.packages.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.packages.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.packages.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-packages">
            <thead>
                <tr>
                  <th width="10">

                  </th>
                    <th>
                        {{ trans('cruds.packages.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.packages.fields.name') }}
                    </th>

                    <th>
                        {{ trans('cruds.packages.fields.price') }}
                    </th>

                    <th>
                        {{ trans('cruds.packages.fields.duration') }}
                    </th>
                    
                    <th>
                        {{ trans('cruds.packages.fields.auto_renew') }}
                    </th>
                    <th>
                        {{ trans('cruds.packages.fields.allowed_classes') }}
                    </th>
                    <th>
                        {{ trans('cruds.packages.fields.description') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.packages.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },
      { data: 'name', name: 'name' },
      { data: 'price', name: 'price' },
      { data: 'duration', name: 'duration' },

      { data: 'auto_renew', name: 'auto_renew'},
      { data: 'allowed_classes', name: 'allowed_classes'},
      { data: 'description', name: 'description'},
      { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  console.log(dtOverrideGlobals);
  $('.datatable-packages').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection
