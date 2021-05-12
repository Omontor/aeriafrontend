@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.game.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.games.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.game.fields.id') }}
                        </th>
                        <td>
                            {{ $game->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.game.fields.name') }}
                        </th>
                        <td>
                            {{ $game->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.game.fields.app') }}
                        </th>
                        <td>
                            {{ $game->app }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.game.fields.secret') }}
                        </th>
                        <td>
                            {{ $game->secret }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.game.fields.status') }}
                        </th>
                        <td>
                            {{ $game->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.games.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection