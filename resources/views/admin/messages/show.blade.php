@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.message.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.messages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.id') }}
                        </th>
                        <td>
                            {{ $message->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.game') }}
                        </th>
                        <td>
                            {{ $message->game->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.publish_date') }}
                        </th>
                        <td>
                            {{ $message->publish_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.expiration_date') }}
                        </th>
                        <td>
                            {{ $message->expiration_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.subject') }}
                        </th>
                        <td>
                            {{ $message->subject }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.message') }}
                        </th>
                        <td>
                            {{ $message->message }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.uri') }}
                        </th>
                        <td>
                            {{ $message->uri }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.data_type') }}
                        </th>
                        <td>
                            {{ $message->data_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.country') }}
                        </th>
                        <td>
                            {{ $message->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.message.fields.custom_data') }}
                        </th>
                        <td>
                            {{ $message->custom_data }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.messages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection