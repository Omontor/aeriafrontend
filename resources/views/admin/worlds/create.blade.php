@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.world.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.worlds.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="game_id">{{ trans('cruds.world.fields.game') }}</label>
                <select class="form-control select2 {{ $errors->has('game') ? 'is-invalid' : '' }}" name="game_id" id="game_id">
                    @foreach($games as $id => $entry)
                        <option value="{{ $id }}" {{ old('game_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('game'))
                    <span class="text-danger">{{ $errors->first('game') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.world.fields.game_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.world.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.world.fields.name_helper') }}</span>
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