@extends('layouts.admin')
@section('content')
<div class="content">
    @can('user_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.games.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.game.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
          
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>APP ID</th>
                <th>OneSignal ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          @forelse($games as $game)
            <tr>
                <td>{{$game->id}}</td>
                <td>{{$game->name}}</td>
                <td>{{$game->appid}}</td>
                <td>{{$game->onesignal_id ? $game->onesignal_id : "Not added"}}</td>
                <td>

                  <div class="row">
                      
                      <a href="{{route('admin.games.edit', $game->remote_id)}}" class="btn btn-success btn-sm"> Edit</a>
                        <a href="{{route('admin.games.view', $game->remote_id)}}" class="btn btn-sm btn-primary">Data</a>
                        <a href="{{route('admin.worlds.view', $game->remote_id)}}" class="btn btn-sm btn-primary">Worlds</a>
            
                

                  </div>

                </td>
            </tr>
          @empty
          No games created
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
  
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection


