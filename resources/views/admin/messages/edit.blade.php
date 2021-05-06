@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.message.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.messages.update", [$message->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('game') ? 'has-error' : '' }}">
                            <label class="required" for="game_id">{{ trans('cruds.message.fields.game') }}</label>
                            <select class="form-control select2" name="game_id" id="game_id" required>
                                @foreach($games as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('game_id') ? old('game_id') : $message->game->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('game'))
                                <span class="help-block" role="alert">{{ $errors->first('game') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.message.fields.game_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('publish_date') ? 'has-error' : '' }}">
                            <label for="publish_date">{{ trans('cruds.message.fields.publish_date') }}</label>
                            <input class="form-control" type="text" name="publish_date" id="publish_date" value="{{ old('publish_date', $message->publish_date) }}">
                            @if($errors->has('publish_date'))
                                <span class="help-block" role="alert">{{ $errors->first('publish_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.message.fields.publish_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('expiration_date') ? 'has-error' : '' }}">
                            <label for="expiration_date">{{ trans('cruds.message.fields.expiration_date') }}</label>
                            <input class="form-control" type="text" name="expiration_date" id="expiration_date" value="{{ old('expiration_date', $message->expiration_date) }}">
                            @if($errors->has('expiration_date'))
                                <span class="help-block" role="alert">{{ $errors->first('expiration_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.message.fields.expiration_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                            <label for="subject">{{ trans('cruds.message.fields.subject') }}</label>
                            <input class="form-control" type="text" name="subject" id="subject" value="{{ old('subject', $message->subject) }}">
                            @if($errors->has('subject'))
                                <span class="help-block" role="alert">{{ $errors->first('subject') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.message.fields.subject_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                            <label for="message">{{ trans('cruds.message.fields.message') }}</label>
                            <input class="form-control" type="text" name="message" id="message" value="{{ old('message', $message->message) }}">
                            @if($errors->has('message'))
                                <span class="help-block" role="alert">{{ $errors->first('message') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.message.fields.message_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('uri') ? 'has-error' : '' }}">
                            <label for="uri">{{ trans('cruds.message.fields.uri') }}</label>
                            <input class="form-control" type="text" name="uri" id="uri" value="{{ old('uri', $message->uri) }}">
                            @if($errors->has('uri'))
                                <span class="help-block" role="alert">{{ $errors->first('uri') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.message.fields.uri_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('data_type') ? 'has-error' : '' }}">
                            <label for="data_type">{{ trans('cruds.message.fields.data_type') }}</label>
                            <input class="form-control" type="text" name="data_type" id="data_type" value="{{ old('data_type', $message->data_type) }}">
                            @if($errors->has('data_type'))
                                <span class="help-block" role="alert">{{ $errors->first('data_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.message.fields.data_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                            <label for="country">{{ trans('cruds.message.fields.country') }}</label>
                            <input class="form-control" type="text" name="country" id="country" value="{{ old('country', $message->country) }}">
                            @if($errors->has('country'))
                                <span class="help-block" role="alert">{{ $errors->first('country') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.message.fields.country_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('custom_data') ? 'has-error' : '' }}">
                            <label for="custom_data">{{ trans('cruds.message.fields.custom_data') }}</label>
                            <input class="form-control" type="text" name="custom_data" id="custom_data" value="{{ old('custom_data', $message->custom_data) }}">
                            @if($errors->has('custom_data'))
                                <span class="help-block" role="alert">{{ $errors->first('custom_data') }}</span>
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



        </div>
    </div>
</div>
@endsection