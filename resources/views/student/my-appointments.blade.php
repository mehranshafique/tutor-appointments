@extends('layouts.admin')
@section('content')
@can('appointment_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.appointments.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.appointment.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<style>
.rate {
  float: left;
  height: 46px;
  padding: 0 10px;
}
.rate:not(:checked) > input {
  position:absolute;
  top:-9999px;
}
.rate:not(:checked) > label {
  float:right;
  width:1em;
  overflow:hidden;
  white-space:nowrap;
  cursor:pointer;
  font-size:30px;
  color:#ccc;
}
.rate:not(:checked) > label:before {
  content: '★ ';
}
.rate > input:checked ~ label {
  color: #ffc700;
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
  color: #deb217;
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
  color: #c59b08;
}

</style>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.appointment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Appointment">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.appointment.fields.id') }}
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
                        {{ trans('cruds.appointment.fields.class') }}
                    </th>
                    <th>
                        {{ trans('cruds.appointment.fields.rate') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>


    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="zoomModalCenter" tabindex="-1" role="dialog" aria-labelledby="zoomModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="zoomModalLongTitle">Zoom Meeting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered" >
            <tbody>
                <tr>
                  <th>Host Email</th>
                  <th></th>
                </tr>
                <tr>
                  <th>Topic</th>
                  <th></th>
                </tr>
                <tr>
                  <th>Agenda</th>
                  <th></th>
                </tr>
                <tr>
                  <th>Type</th>
                  <th></th>
                </tr>
                <tr>
                  <th>status</th>
                  <th></th>
                </tr>
                <tr>
                  <th>Start Time</th>
                  <th></th>
                </tr>
                <tr>
                  <th>Duration</th>
                  <th></th>
                </tr>
                <tr>
                  <th>Timezone</th>
                  <th></th>
                </tr>
                <tr>
                  <th>Password</th>
                  <th></th>
                </tr>
                <tr>
                  <th>Pre Schedule</th>
                  <th></th>
                </tr>

            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Join</button>
        <button type="button" class="btn btn-info">Start Meeting</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="rateModalCenter" tabindex="-1" role="dialog" aria-labelledby="rateModalCenter" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rateModalLongTitle">Meeting Rating</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="{{ route('student.ratings.store') }}" method="post" id="ratingForm">
        @csrf
        <div class="modal-body">
          <div class="container">
            <div class="rate">
              <input type="radio" id="star5" name="rating" value="5" />
              <label for="star5" title="text">5 stars</label>
              <input type="radio" id="star4" name="rating" value="4" />
              <label for="star4" title="text">4 stars</label>
              <input type="radio" id="star3" name="rating" value="3" />
              <label for="star3" title="text">3 stars</label>
              <input type="radio" id="star2" name="rating" value="2" />
              <label for="star2" title="text">2 stars</label>
              <input type="radio" id="star1" name="rating" value="1" />
              <label for="star1" title="text">1 star</label>
            </div>
            <div class="form-group">
              <label for="star2" title="text"></label>
              <input type="text" id="comment" name="comment" class="form-control">
              <input type="hidden" id="student_id" name="student_id" class="form-control">
              <input type="hidden" id="teacher_id" name="teacher_id" class="form-control">
              <input type="hidden" id="appointment_id" name="appointment_id" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
    </form>
    </div>
  </div>
</div>

@endsection
@section('scripts')
@parent

<script>

    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('appointment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.appointments.massDestroy') }}",
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
let url = '{{url()->current()}}';

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: url,
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },
      { data: 'employee_name', name: 'employee.name' },
      { data: 'start_time', name: 'start_time' },
      { data: 'finish_time', name: 'finish_time' },
      { data: 'price', name: 'price' },
      { data : 'status' , name: 'status'},
      { data: 'comments', name: 'comments' },
      { data: 'services', name: 'services.name' },
      { data: 'class', name: 'class' },
      { data : 'rate', name: 'rate'},
      { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-Appointment').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>

@endsection
