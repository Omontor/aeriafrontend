@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.level.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.levels.update", [$level->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.level.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $level->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.level.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('world') ? 'has-error' : '' }}">
                            <label for="world_id">{{ trans('cruds.level.fields.world') }}</label>
                            <select class="form-control select2" name="world_id" id="world_id">
                                @foreach($worlds as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('world_id') ? old('world_id') : $level->world->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('world'))
                                <span class="help-block" role="alert">{{ $errors->first('world') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.level.fields.world_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('name_in_build') ? 'has-error' : '' }}">
                            <label for="name_in_build">{{ trans('cruds.level.fields.name_in_build') }}</label>
                            <input class="form-control" type="text" name="name_in_build" id="name_in_build" value="{{ old('name_in_build', $level->name_in_build) }}">
                            @if($errors->has('name_in_build'))
                                <span class="help-block" role="alert">{{ $errors->first('name_in_build') }}</span>
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



        </div>
    </div>
</div>
@endsection