@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.world.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.worlds.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('game') ? 'has-error' : '' }}">
                            <label for="game_id">{{ trans('cruds.world.fields.game') }}</label>
                            <select class="form-control select2" name="game" id="game">
                                @foreach($games as $game)
                                    <option value="{{ $game->id }}" {{ old('game') == $game->id ? 'selected' : '' }}>{{ $game->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('game'))
                                <span class="help-block" role="alert">{{ $errors->first('game') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.world.fields.game_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.world.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}">
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.world.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
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