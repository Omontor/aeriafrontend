@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.customKey.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.custom-keys.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.customKey.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}">
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.customKey.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('analytic') ? 'has-error' : '' }}">
                            <label for="analytic_id">{{ trans('cruds.customKey.fields.analytic') }}</label>
                            <select class="form-control select2" name="analytic_id" id="analytic_id">
                                @foreach($analytics as $analytic)
                                    <option value="{{ $analytic->id }}" {{ old('analytic_id') == $analytic->id ? 'selected' : '' }}>{{ $analytic->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('analytic'))
                                <span class="help-block" role="alert">{{ $errors->first('analytic') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.customKey.fields.analytic_helper') }}</span>
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