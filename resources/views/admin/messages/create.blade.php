@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.message.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.messages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="game_id">{{ trans('cruds.message.fields.game') }}</label>
                <select class="form-control select2 {{ $errors->has('game') ? 'is-invalid' : '' }}" name="game_id" id="game_id" required>
                    @foreach($games as $id => $entry)
                        <option value="{{ $id }}" {{ old('game_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('game'))
                    <span class="text-danger">{{ $errors->first('game') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.game_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="publish_date">{{ trans('cruds.message.fields.publish_date') }}</label>
                <input class="form-control {{ $errors->has('publish_date') ? 'is-invalid' : '' }}" type="text" name="publish_date" id="publish_date" value="{{ old('publish_date', '') }}">
                @if($errors->has('publish_date'))
                    <span class="text-danger">{{ $errors->first('publish_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.publish_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="expiration_date">{{ trans('cruds.message.fields.expiration_date') }}</label>
                <input class="form-control {{ $errors->has('expiration_date') ? 'is-invalid' : '' }}" type="text" name="expiration_date" id="expiration_date" value="{{ old('expiration_date', '') }}">
                @if($errors->has('expiration_date'))
                    <span class="text-danger">{{ $errors->first('expiration_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.expiration_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="subject">{{ trans('cruds.message.fields.subject') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="subject" id="subject" value="{{ old('subject', '') }}">
                @if($errors->has('subject'))
                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.subject_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="message">{{ trans('cruds.message.fields.message') }}</label>
                <input class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" type="text" name="message" id="message" value="{{ old('message', '') }}">
                @if($errors->has('message'))
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.message_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="uri">{{ trans('cruds.message.fields.uri') }}</label>
                <input class="form-control {{ $errors->has('uri') ? 'is-invalid' : '' }}" type="text" name="uri" id="uri" value="{{ old('uri', '') }}">
                @if($errors->has('uri'))
                    <span class="text-danger">{{ $errors->first('uri') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.uri_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="data_type">{{ trans('cruds.message.fields.data_type') }}</label>
                <input class="form-control {{ $errors->has('data_type') ? 'is-invalid' : '' }}" type="text" name="data_type" id="data_type" value="{{ old('data_type', '') }}">
                @if($errors->has('data_type'))
                    <span class="text-danger">{{ $errors->first('data_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.data_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country">{{ trans('cruds.message.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}">
                @if($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="custom_data">{{ trans('cruds.message.fields.custom_data') }}</label>
                <input class="form-control {{ $errors->has('custom_data') ? 'is-invalid' : '' }}" type="text" name="custom_data" id="custom_data" value="{{ old('custom_data', '') }}">
                @if($errors->has('custom_data'))
                    <span class="text-danger">{{ $errors->first('custom_data') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.message.fields.custom_data_helper') }}</span>
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