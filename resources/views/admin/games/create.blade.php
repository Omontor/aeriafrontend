@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.game.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.games.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.game.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.game.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="app">{{ trans('cruds.game.fields.app') }}</label>
                <input class="form-control {{ $errors->has('app') ? 'is-invalid' : '' }}" type="text" name="app" id="app" value="{{ old('app', '') }}" required>
                @if($errors->has('app'))
                    <span class="text-danger">{{ $errors->first('app') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.game.fields.app_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="secret">{{ trans('cruds.game.fields.secret') }}</label>
                <input class="form-control {{ $errors->has('secret') ? 'is-invalid' : '' }}" type="text" name="secret" id="secret" value="{{ old('secret', '') }}">
                @if($errors->has('secret'))
                    <span class="text-danger">{{ $errors->first('secret') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.game.fields.secret_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.game.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
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



@endsection