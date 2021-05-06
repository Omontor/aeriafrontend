@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.analytic.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.analytics.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('bvc') ? 'has-error' : '' }}">
                            <label for="bvc">{{ trans('cruds.analytic.fields.bvc') }}</label>
                            <input class="form-control" type="text" name="bvc" id="bvc" value="{{ old('bvc', '') }}">
                            @if($errors->has('bvc'))
                                <span class="help-block" role="alert">{{ $errors->first('bvc') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.analytic.fields.bvc_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('game') ? 'has-error' : '' }}">
                            <label class="required" for="game_id">{{ trans('cruds.analytic.fields.game') }}</label>
                            <select class="form-control select2" name="game_id" id="game_id" required>
                                @foreach($games as $id => $entry)
                                    <option value="{{ $id }}" {{ old('game_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('game'))
                                <span class="help-block" role="alert">{{ $errors->first('game') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.analytic.fields.game_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('entry') ? 'has-error' : '' }}">
                            <label for="entry">{{ trans('cruds.analytic.fields.entry') }}</label>
                            <input class="form-control" type="text" name="entry" id="entry" value="{{ old('entry', '') }}">
                            @if($errors->has('entry'))
                                <span class="help-block" role="alert">{{ $errors->first('entry') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.analytic.fields.entry_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                            <label for="value">{{ trans('cruds.analytic.fields.value') }}</label>
                            <input class="form-control" type="text" name="value" id="value" value="{{ old('value', '') }}">
                            @if($errors->has('value'))
                                <span class="help-block" role="alert">{{ $errors->first('value') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.analytic.fields.value_helper') }}</span>
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