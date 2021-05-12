@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.customKey.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.custom-keys.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.customKey.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customKey.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="analytic_id">{{ trans('cruds.customKey.fields.analytic') }}</label>
                <select class="form-control select2 {{ $errors->has('analytic') ? 'is-invalid' : '' }}" name="analytic_id" id="analytic_id">
                    @foreach($analytics as $id => $entry)
                        <option value="{{ $id }}" {{ old('analytic_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('analytic'))
                    <span class="text-danger">{{ $errors->first('analytic') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.customKey.fields.analytic_helper') }}</span>
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