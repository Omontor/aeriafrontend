@extends('layouts.admin')
@section('content')
<div class="content">
    @can('user_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
            {{--Add button to create--}}
            </div>
        </div>
    @endcan

        <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Games List
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
          
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Remote ID</th>
                <th>Name</th>
                <th>APP ID</th>
                <th>OneSignal ID</th>
                <th>OneSignal API</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          @forelse($games as $game)
            <tr>
                <td>{{$game->id}}</td>
                <td>{{$game->remote_id}}</td>
                <td>{{$game->name}}</td>
                <td>{{$game->appid}}</td>
                <td>{{$game->onesignal_id ? $game->onesignal_id : "Not added"}}</td>
                <td>{{$game->api_key ? $game->api_key : "Not added"}}</td>
                <td>

                  <div class="row">
                      
                      <a href="#" class="btn btn-primary btn-sm"> Active Events</a>
                       
            
                

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


