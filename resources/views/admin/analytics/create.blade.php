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
                       
                      
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" name="{{ old('name', '') }}">
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                          
                        </div>
                        <div class="form-group">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Back to Analytics</a>
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