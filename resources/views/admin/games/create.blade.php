@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.game.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.games.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.game.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('app') ? 'has-error' : '' }}">
                            <label class="required" for="app">{{ trans('cruds.game.fields.app') }}</label>
                            <input class="form-control" type="text" name="app" id="app" value="{{ old('app', '') }}" required>
                            @if($errors->has('app'))
                                <span class="help-block" role="alert">{{ $errors->first('app') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.app_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('secret') ? 'has-error' : '' }}">
                            <label for="secret">{{ trans('cruds.game.fields.secret') }}</label>
                            <input class="form-control" type="text" name="secret" id="secret" value="{{ old('secret', '') }}">
                            @if($errors->has('secret'))
                                <span class="help-block" role="alert">{{ $errors->first('secret') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.secret_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label for="status">{{ trans('cruds.game.fields.status') }}</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', '') }}">
                            @if($errors->has('status'))
                                <span class="help-block" role="alert">{{ $errors->first('status') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.status_helper') }}</span>
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