@extends('layouts.admin')
@section('content')
@can('child_subject_document_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" data-toggle="modal" data-target="#documentModalCenter" href="javascript:void(0)">
                {{ trans('global.add') }} {{ trans('cruds.documents.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.documents.title_singular') }} {{ trans('global.list') }}
    </div>

@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
</div>
@endif


@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-child-subjects">
            <thead>
                <tr>
                  <th width="10">

                  </th>
                    <th>
                        {{ trans('cruds.documents.fields.id') }}
                    </th>

                    <th>
                        {{ trans('cruds.documents.fields.file_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.documents.fields.file_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.documents.fields.file_size') }}
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
<div class="modal fade" id="documentModalCenter" tabindex="-1" role="dialog" aria-labelledby="documentModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="documentModalCenterTitle">Multiple File Upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form method="post" action="{{ route('admin.child-subjects.store_document', Request::segment(3) )}}" enctype="multipart/form-data">
        {{csrf_field()}}
      <div class="modal-body">


          <div class="input-group hdtuto control-group lst increment" >
            <input type="file" name="file_names[]" multiple class="myfrm form-control">
            <div class="input-group-btn">
              <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
            </div>
          </div>
          <div class="clone hide">
            <div class="hdtuto control-group lst input-group" style="margin-top:10px">
              <input type="file" name="file_names[]" multiple class="myfrm form-control">
              <div class="input-group-btn">
                <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
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

      { data: 'file_name', name: 'file_name' },
      { data: 'file_type', name: 'file_type' },
      { data: 'file_size', name: 'file_size' },
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

<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $(".btn-danger").on("click", function(){
          $(this).parent('.input-group-btn').parent(".hdtuto control-group lst").remove();
      });
    });
</script>
@endsection
