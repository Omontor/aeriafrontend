@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.game.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.games.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.game.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.name_helper') }}</span>
                        </div>

                              

<br>
  <h3 class="">OneSignal Configuration</h3>
  <br>

                        <div class="row">
                         

                        <div class="form-group col-lg-6 {{ $errors->has('apikey') ? 'has-error' : '' }}">
                            <label class="" for="apikey">OneSignal Api Key</label>
                            <input class="form-control" type="text" name="apikey" id="apikey" value="{{ old('apikey', '') }}" >
                            @if($errors->has('apikey'))
                                <span class="help-block" role="alert">{{ $errors->first('apikey') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.name_helper') }}</span>
                        </div>      

                        <div class="form-group col-lg-6 {{ $errors->has('onesingalid') ? 'has-error' : '' }}">
                            <label class="" for="onesingalid">OneSignal Api Key</label>
                            <input class="form-control" type="text" name="onesingalid" id="onesingalid" value="{{ old('onesingalid', '') }}" >
                            @if($errors->has('onesingalid'))
                                <span class="help-block" role="alert">{{ $errors->first('onesingalid') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.game.fields.name_helper') }}</span>
                        </div>   

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