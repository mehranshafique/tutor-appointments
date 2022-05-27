@extends('layouts.admin')
@section('content')
@can('child_subject_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.child-subjects.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.child_subjects.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.child_subjects.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-child-subjects">
            <thead>
                <tr>
                  <th width="10">

                  </th>
                    <th>
                        {{ trans('cruds.child_subjects.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.child_subjects.fields.name') }}
                    </th>
                    
                    <th>
                        {{ trans('cruds.child_subjects.fields.curriculum') }}
                    </th>

                    <th>
                        {{ trans('cruds.child_subjects.fields.picture') }}
                    </th>
                    <th>
                        {{ trans('cruds.child_subjects.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.child_subjects.fields.documents') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <!-- <tbody>

              @foreach($child_subjects as $child_subject)
              <tr>
                <td> {{ $child_subject->id}}</td>
                <td> {{ $child_subject->name }}</td>
                <td> {{ $child_subject->subjects->name }} </td>
                <td> {{ $child_subject->picture }}</td>
                <td> {{ $child_subject->description }}</td>
              </tr>
              @endforeach
            </tbody> -->
        </table>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('child_subject_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.child-subjects.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton);
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.child-subjects.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },

      { data: 'category', name: 'subject' },
      { data: 'language', name: 'language' },
      { data: 'picture', name: 'picture' },
      { data: 'description', name: 'description'},
      { data: 'documents', name: 'documents'},
      { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  console.log(dtOverrideGlobals);
  $('.datatable-child-subjects').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection
