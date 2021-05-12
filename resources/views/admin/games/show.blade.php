@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.game.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
        @forelse($messages as $message)
        @if($message['gameId'] == $gameid)
           {{$message['id']}} {{$message['subject']}}<br>
           @endif
        @empty

        @endforelse
                  
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.games.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection