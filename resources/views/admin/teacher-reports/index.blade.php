@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.teacherReport.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
      <form class="form-inline form-reports" id="form-reports" >
        @method('get')
        <select class="form-control mb-2 mr-sm-2 w-25" name="teacher_id" id="teacher_id" required>
          @foreach($teachers as $key => $teacher)
            <option value="{{ $key }}">{{ $teacher }}</option>
          @endforeach
        </select>

        <label class="sr-only" for="start_date"></label>
        <div class="input-group mb-2 mr-sm-2">
          <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date" required>
        </div>

        <label class="sr-only" for="end_date"></label>
        <div class="input-group mb-2 mr-sm-2">
          <input type="date" class="form-control" name="end_date" id="end_date" placeholder="End" required>
        </div>

        <button type="submit" id="submit" class="btn btn-primary mb-2">Search</button>
      </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.teacherReport.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-teacher">
          <thead>
              <tr>
                  <th width="10">

                  </th>
                  <th>
                      {{ trans('cruds.appointment.fields.id') }}
                  </th>
                  <th>
                      {{ trans('cruds.appointment.fields.client') }}
                  </th>
                  <th>
                      {{ trans('cruds.appointment.fields.employee') }}
                  </th>
                  <th>
                      {{ trans('cruds.appointment.fields.start_time') }}
                  </th>
                  <th>
                      {{ trans('cruds.appointment.fields.finish_time') }}
                  </th>
                  <th>
                      {{ trans('cruds.teacher.fields.hourly_pay') }}
                  </th>
                  <th>
                      {{ trans('cruds.appointment.fields.duration') }}
                  </th>
                  <th>
                      {{ trans('cruds.appointment.fields.price') }}
                  </th>
                  <th>
                      {{ trans('cruds.appointment.fields.status') }}
                  </th>
                  <th>
                      {{ trans('cruds.appointment.fields.comments') }}
                  </th>
                  <th>
                      {{ trans('cruds.appointment.fields.services') }}
                  </th>
                  <th>
                      &nbsp;
                  </th>
              </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <tr>
                <th colspan="13" class="text-center"></th>

             </tr>
        </tfoot>
        </table>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.0/api/sum().js"></script>
<script type="text/javascript">
$('#form-reportss').submit(function(e){
  e.preventDefault();
    alert('Please enter');
});
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('teacher_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.teachers.massDestroy') }}",
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
  dtButtons.push(deleteButton)
@endcan

$('#submit').on('click', function(e){
  if ( $.fn.DataTable.isDataTable('.datatable-teacher') ) {
    $('.datatable-teacher').DataTable().destroy();
  }
  $('.datatable-teacher tbody').empty();
    e.preventDefault();
    let formData = {
        teacher_id: $('#teacher_id').val(),
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val()
    };

    let dtOverrideGlobals = {
      buttons: dtButtons,
      processing: true,
      serverSide: true,
      retrieve: true,
      aaSorting: [],
      ajax: {
        url: "{{ route('admin.teachers.get_report') }}",
        data: formData,
      },
      columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id' },
        { data: 'client_name', name: 'client.name' },
        { data: 'employee_name', name: 'employee.name' },
        { data: 'start_time', name: 'start_time' },
        { data: 'finish_time', name: 'finish_time' },
        { data: 'hourly_pay', name: 'hourly_pay' },
        { data: 'meeting_duration', name: 'meeting_duration'},
        { data: 'price', name: 'price' },
        { data : 'status' , name: 'status'},
        { data: 'comments', name: 'comments' },
        { data: 'services', name: 'services.name' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
      ],
      footerCallback: function( tfoot, data, start, end, display ) {
        var api = this.api();
        $(api.column(8).footer()).html(
            api.column(8).data().reduce(function ( a, b ) {
                return "Payment $" + (parseInt(a.toString().replace(/\$/g, "")) + parseInt(b.toString().replace(/\$/g, "")));
            }, 0)
        );
      },
      order: [[ 1, 'desc' ]],
      pageLength: 100,
    };

    $('.datatable-teacher').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

});

</script>
@endsection
