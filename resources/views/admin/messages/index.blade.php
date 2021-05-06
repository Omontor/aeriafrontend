@extends('layouts.admin')
@section('content')
<div class="content">
    @can('message_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.messages.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.message.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.message.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Message">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.message.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.message.fields.game') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.message.fields.publish_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.message.fields.expiration_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.message.fields.subject') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.message.fields.message') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.message.fields.uri') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.message.fields.data_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.message.fields.country') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.message.fields.custom_data') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($games as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $key => $message)
                                    <tr data-entry-id="{{ $message->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $message->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->game->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->publish_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->expiration_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->subject ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->message ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->uri ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->data_type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->country ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->custom_data ?? '' }}
                                        </td>
                                        <td>
                                            @can('message_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.messages.show', $message->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('message_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.messages.edit', $message->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('message_delete')
                                                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
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
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('message_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.messages.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Message:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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