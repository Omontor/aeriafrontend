
@extends('layouts.admin')
@section('content')
<div class="content">
    @can('analytic_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.notifications.create') }}">
                    Create New Notification
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Sent Notifications
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Analytic">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.analytic.fields.id') }}
                                    </th>                                    

                                    <th>
                                        Game
                                    </th>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                       Date Sent
                                    </th>                               

                                    <th>
                                       Actions
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>                                    
                                    <td>

                                    </td>

  
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($notifications as $notification)
                                    <tr data-entry-id="{{ $notification->id }}">
                                        <td>

                                        </td>
                                        <td>
                                         {{$notification->id}}
                                        </td>
                                        <td>
                                            {{ $notification->game->name}}
                                        </td>                                   

                                        <td>
                                            {{ $notification->title }}
                                        </td>                                        

                                        <td>
                                            {{ $notification->created_at }}
                                        </td>
                  
                                        <td>
                                            <a href="#" class="btn btn-xs btn-danger">Delete</a>
                                        </td>

                                    </tr>
                                @empty
                                @endforelse    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Analytic:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('div#sidebar').on('transitionend', function(e) {
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  })
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection