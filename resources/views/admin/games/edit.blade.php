@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.game.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.games.update", [$game->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.game.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $game->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('appid') ? 'has-error' : '' }}">
                            <label class="required" for="appid">App ID</label>
                            <input class="form-control" type="text" name="appid" id="appid" value="{{ old('appid', $game->appid) }}" required readonly="">
                            @if($errors->has('appid'))
                                <span class="help-block" role="alert">{{ $errors->first('appid') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.app_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('secret') ? 'has-error' : '' }}">
                            <label for="secret">{{ trans('cruds.game.fields.secret') }}</label>
                            <input class="form-control" type="text" name="secret" id="secret" value="{{ old('secret', $game->secret) }}" readonly="">
                            @if($errors->has('secret'))
                                <span class="help-block" role="alert">{{ $errors->first('secret') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.secret_helper') }}</span>
                        </div>
             <br>
  <h3 class="">OneSignal Configuration</h3>
  <br>

                        <div class="row">
                         

                        <div class="form-group col-lg-6 {{ $errors->has('api_key') ? 'has-error' : '' }}">
                            <label class="" for="api_key">OneSignal Api Key</label>
                            <input class="form-control" type="text" name="api_key" id="api_key" value="{{$game->api_key }}" >
                            @if($errors->has('api_key'))
                                <span class="help-block" role="alert">{{ $errors->first('api_key') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.name_helper') }}</span>
                        </div>      
                        <div class="form-group col-lg-6 {{ $errors->has('onesignal_id') ? 'has-error' : '' }}">
                            <label class="" for="onesignal_id">OneSignal ID</label>
                            <input class="form-control" type="text" name="onesignal_id" id="onesignal_id" value="{{$game->onesignal_id}}" >
                            @if($errors->has('onesignal_id'))
                                <span class="help-block" role="alert">{{ $errors->first('onesignal_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.name_helper') }}</span>
                        </div>   

                        </div>
          
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection