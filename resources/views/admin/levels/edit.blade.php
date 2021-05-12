@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.level.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.levels.update", [$level->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.level.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $level->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.level.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="world_id">{{ trans('cruds.level.fields.world') }}</label>
                <select class="form-control select2 {{ $errors->has('world') ? 'is-invalid' : '' }}" name="world_id" id="world_id">
                    @foreach($worlds as $id => $entry)
                        <option value="{{ $id }}" {{ (old('world_id') ? old('world_id') : $level->world->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('world'))
                    <span class="text-danger">{{ $errors->first('world') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.level.fields.world_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_in_build">{{ trans('cruds.level.fields.name_in_build') }}</label>
                <input class="form-control {{ $errors->has('name_in_build') ? 'is-invalid' : '' }}" type="text" name="name_in_build" id="name_in_build" value="{{ old('name_in_build', $level->name_in_build) }}">
                @if($errors->has('name_in_build'))
                    <span class="text-danger">{{ $errors->first('name_in_build') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.level.fields.name_in_build_helper') }}</span>
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