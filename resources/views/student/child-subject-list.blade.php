@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.child_subjects.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
      <div class="row">
        @foreach($child_subjects as $child_subject)
        <div class="col-lg-4">
          <h4 class="card-title">
             {{ $child_subject->subjects->name }}
            </h4>
          <div class="card">
            <img class="card-img-top" src="https://pngimg.com/uploads/book/book_PNG2111.png" alt="Card image"  style="width:50%" >
            <div class="card-body">
              <h4 class="card-title">{{ trans('cruds.child_subjects.fields.name') }}: {{ $child_subject->name }}
              </h4>
              <p class="card-text">{{ trans('cruds.child_subjects.fields.description') }}
              {{ $child_subject->description }}</p>
              <a href="{{ $child_subject->id}}" class="btn btn-primary">Book Appointment</a>
            </div>
          </div>
          </div>
        @endforeach
      </div>
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
