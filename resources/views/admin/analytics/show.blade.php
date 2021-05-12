@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.analytic.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.analytics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.analytic.fields.id') }}
                        </th>
                        <td>
                            {{ $analytic->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.analytic.fields.bvc') }}
                        </th>
                        <td>
                            {{ $analytic->bvc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.analytic.fields.game') }}
                        </th>
                        <td>
                            {{ $analytic->game->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.analytic.fields.entry') }}
                        </th>
                        <td>
                            {{ $analytic->entry }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.analytic.fields.value') }}
                        </th>
                        <td>
                            {{ $analytic->value }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.analytics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection