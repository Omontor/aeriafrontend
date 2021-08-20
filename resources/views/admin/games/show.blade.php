<div id="load"></div>
@extends('layouts.admin')
    <style type="text/css">
      div.dataTables_wrapper {

        margin: 0 auto;
        padding: 20px;
    }
    </style>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/plugins/sweetalert2/sweetalert2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style type="text/css">
  #load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("http://3dbionotes.cnb.csic.es/images/loading.gif") no-repeat center center rgba(0,0,0,0.65)
}
</style>

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="{{route('admin.games.index')}}" class="btn btn-md btn-primary">Back to all games</a>
        <a href="{{route('admin.games.resync')}}" class="btn btn-md btn-success" onclick="myFunction()">Resync Data</a>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12">
            <h1>{{$game->name}}</h1>
        <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Filters</h3>
                </div>
                <form method="POST" action="{{route('admin.games.filterbydate')}}">
                    @csrf

                    <input type="text" hidden value="{{$game->remote_id}}" name="id">
                <div class="box-body box-profile">
                 <div class="col-lg-5">
                    From:
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" name="start_date">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>                              
                <div class="col-lg-5">  
                To:
                <div class="input-group date" data-provide="datepicker2">
                    <input type="text" class="form-control" name="end_date">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
                </div> 


<div class="col-lg-2">  
    <br>
    <button type="submit" class="btn btn-md btn-primary">Filter By Date</button>
</div> 
</form>

                </div>
                
                <div class="box-body box-profile">
                    <div class="col-lg-4">   
                    <div class="row">  
                    <div class="col-lg-9">   
                        <select class="form-control" control-id="ControlID-24">
                        <option>Star Groups   </option> 
                        </select>
                        </div>   
                        <div class="col-lg-3">
                            <a href="" class="btn btn-block btn-primary"> Filter</a>
                        </div>
                    </div>
                        
</div>
                      
<div class="col-lg-4">   
    <div class="row">
        <div class="col-lg-9">   
            <select class="form-control" control-id="ControlID-24">
                <option>Age Groups   </option> 
            </select>
        </div>   
        <div class="col-lg-3">
            <a href="" class="btn btn-block btn-primary"> Filter</a>
        </div>
    </div>                      
</div> 



 <div class="col-lg-4">   
    <div class="row">  
        <div class="col-lg-9">   
            <select class="form-control" control-id="ControlID-24">
                <option>Segments  </option> 
            </select>
        </div>   
        <div class="col-lg-3">
            <a href="" class="btn btn-block btn-primary"> Filter</a>
        </div>
    </div>                  
</div>     
        
         </div>
        </div>


        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Compare Cohorts</h3>
            </div>
                <div class="box-body box-profile">
                    <div class="col-lg-6">   
                        <select class="form-control" control-id="ControlID-24">
                             @forelse($cohorts as $data)
                          <option>
                              {{$data->name}}
                          </option>
                            @empty
                            No data to show
                            @endforelse
                        </select>
                        </div>       
                        <div class="col-lg-6">   
                        <select class="form-control" control-id="ControlID-24">

                        @forelse($cohorts as $data)
                          <option>
                                {{$data->name}}
                          </option>
                            @empty
                            No data to show
                            @endforelse
                        </select>
                        </div>  
                        <br>
                        <br>
                        
                        <div class="col-lg-12"><a href="{{route('admin.games.compare')}}" class="btn btn-md btn-primary">Compare Cohorts</a></div>    
                        <br>
                        <br>
                </div>
        </div>
      </div>
    </div>
</section>


<div class="content">
    <div class="row">


        {{-- Sum --}}

        <div class="col-lg-12" id="sumtable">
            <div class="box box-info">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link  btn btn-primary" href="#activity" data-toggle="tab" style="color:white;">Cohort View</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                             <a  onclick="percentage()" class="btn btn-primary btn-xl pull-right" style="margin-right: 50px;">Total / Percentage</a>
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                  
                   <table id="example1" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                <th style="max-width: 15px;">ID</th>
                
                 <th style="max-width: 30px;">LA <br>
                    <a href="#" data-toggle="tooltip" title="Last Activity"><i class="fas fa-info-circle"></i></a></th> 
                 <th style="max-width: 50px;">SP <br>
                    <a href="#" data-toggle="tooltip" title="Sessions Played"><i class="fas fa-info-circle"></i></a></th> 
                <th style="max-width: 30px;">Deaths <br>
                    <a href="#" data-toggle="tooltip" title="Deaths by cohort"><i class="fas fa-info-circle"></i></a></th> 
                    <th style="max-width: 50px;">IAP <br>
                    <a href="#" data-toggle="tooltip" title="In App Purchases"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 40px;">Imp 
                    <br>
  <a href="#" data-toggle="tooltip" title="Impressions per level played"><i class="fas fa-info-circle"></i></a> </th>               

  <th style="max-width: 40px;">Ads 
                    <br>
  <a href="#" data-toggle="tooltip" title="Watched Ads"><i class="fas fa-info-circle"></i></a> </th>

                <th style="max-width: 50px;">Ret.
                    <br>
                <a href="#" data-toggle="tooltip" title="Inital Retention 7 days "><i class="fas fa-info-circle"></i></a>
                </th>
                <th style="max-width: 30px;">7DR <br><a href="#" data-toggle="tooltip" title="Current 7 day retention"><i class="fas fa-info-circle"></i></a></th>
               

                <th style="max-width: 30px;">30DR <br><a href="#" data-toggle="tooltip" title="Current Retention 30 days"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 30px;">AU <br><a href="#" data-toggle="tooltip" title="Users Still Active  (Played at least 1 time in the last 60 days)"><i class="fas fa-info-circle"></i> </a></th>
                <th style="max-width: 40px;">Prog. <br> <a href="#" data-toggle="tooltip" title="Progression depth: 25 Percentile"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 35px;">Finish <br> <a href="#" data-toggle="tooltip" title="Number of users that finished (any stars) last level"><i class="fas fa-info-circle"></i></a></th>

           <th style="max-width: 30px;">Logo <br> <a href="#" data-toggle="tooltip" title="Logo Screen"><i class="fas fa-info-circle"></i> </a></th>
                <th style="max-width: 30px;">Menu <br> <a href="#" data-toggle="tooltip" title="Menu Screen"><i class="fas fa-info-circle"></i></a></th>
     
                <th style="max-width: 40px;">Tut.<br>S <a href="#" data-toggle="tooltip" title="Tutorial Start"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 35px;">Tut <br>E <a href="#" data-toggle="tooltip" title="Tutorial End"><i class="fas fa-info-circle"></i></a></th>
        
                
                <!-- Dynamic columns Worlds-->



                @forelse($game->levelinterfaces as $world)
                @if($world->name == "Menu" || $world->name == "LogoScreen" || $world->name == "Tutorial" ||  $world->name == "Tutorial End" )
                @else
                    @foreach(\App\Models\LevelDif::all() as $leveldif)
                     <th style="background-color: lightblue; color: black;">{{$world->name}} <br>{{$leveldif->name}} <br> <a href="#" data-toggle="tooltip" title="{{$world->name}}"><i class="fas fa-info-circle"></i></a></th>
                    @endforeach
                @endif
                @empty
                @endforelse
            </tr>
        </thead>


{{--Start body of table--}}


        <tbody>
              @foreach($cohorts as $cohort)
            <tr>

                <td>{{$loop->index + 1}} <a href="#" data-toggle="tooltip" title="{{$cohort->name}}"><i class="fas fa-info-circle"></i></a></td>

                <td><small>{{\Carbon\Carbon::parse( $cohort->userdata->first()->last_activity)->diffForHumans() }}</small></td>
                <td>{{$cohort->userdata->sum('sessions_played')}}</td>
                <td>{{$cohort->deaths->sum('value')}}</td>
                <!-- IAPS -->
                <td>{{$cohort->userdata->sum('iap')}}</td>
                <!--Impressions-->
                <td>{{$cohort->userdata->sum('showed_ads')}}</td>
                <!-- watched ads -->
                <td>{{$cohort->userdata->sum('watched_ads')}}</td>
       {{--Retention totals--}}
                <td style="color:blue">
                    {{\App\Models\UserData::where('cohort_id', $cohort->remote_id)->where('last_activity','<=', Carbon\Carbon::today()->subDay(6))->count() }}
                 
                    

                </td>
                <td style="color:green">           {{\App\Models\UserData::where('cohort_id', $cohort->remote_id)->where('last_activity','<=', Carbon\Carbon::today()->subDay(7))->count() }}
                </td>
                <td style="color: teal"> {{\App\Models\UserData::where('cohort_id', $cohort->remote_id)->where('last_activity','<=', Carbon\Carbon::today()->subDay(30))->count() }}</td>
                <!-- Users -->
                <td style="color:indigo"> {{\App\Models\UserData::where('cohort_id', $cohort->remote_id)->where('last_activity','<=', Carbon\Carbon::today()->subDay(29))->count() }}</td>
                <td>0</td>
                <td>0</td>                



                <td> @if( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'LogoScreenInterfaceTest')->get()  != "[]")
{{\App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'LogoScreenInterfaceTest')->get()->sum('users') }}
                   @else
                  0
                   @endif</td>

                <td>
                    
  @if( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'MenuInterface')->get()  != "[]")
{{\App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'MenuInterface')->get()->sum('users') }}
                   @else
                  0
                   @endif

                </td>

                <td> @if( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'TutorialInterface')->get()  != "[]")
{{\App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'TutorialInterface')->get()->sum('users') }}
                   @else
                  0
                   @endif</td>
                <td>@if( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'TutorialInterfaceEnd')->get()  != "[]")
{{\App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'TutorialInterfaceEnd')->get()->sum('users') }}
                   @else
                  0
                   @endif</td>
      
                @php
                $loopindex = 0;
                @endphp

                @forelse($game->levelinterfaces as $world)
                @if($world->name == "Menu" || $world->name == "LogoScreen" || $world->name == "Tutorial" ||  $world->name == "Tutorial End" )
                @else
                    @foreach(\App\Models\LevelDif::all() as $leveldif)
                    <td>
                @if( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', $world->remote_id)->get()  != "[]")
            

                @php
                if ($loopindex > 2) {
                    $loopindex = 0;
                }

                @endphp
                   {{\App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', $world->remote_id)->where('level_dif', $loopindex)->get()->sum('users') }}
                @php
                $loopindex ++;
                @endphp

                   @else
                  0
                   @endif
                    </td>
                    @endforeach
                @endif
                @empty
                @endforelse

                <!-- Dynamic columns-->

                <!-- Dynamic columns-->
            </tr>
           @endforeach

        </tbody>
    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12" id="percenttable" style="display:none;">
            <div class="box box-info">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link  btn btn-primary" href="#activity" data-toggle="tab" style="color:white;">Cohort View</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <a  onclick="percentage()" class="btn btn-primary btn-xl pull-right" style="margin-right: 50px;">Total / Percentage</a>
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                  
   <table id="example2" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                <th style="max-width: 15px;">ID</th>
                
                 <th style="max-width: 30px;">LA <br>
                    <a href="#" data-toggle="tooltip" title="Last Activity"><i class="fas fa-info-circle"></i></a></th> 
                 <th style="max-width: 50px;">SP <br>
                    <a href="#" data-toggle="tooltip" title="Sessions Played"><i class="fas fa-info-circle"></i></a></th> 
                <th style="max-width: 30px;">Deaths <br>
                    <a href="#" data-toggle="tooltip" title="Deaths by cohort"><i class="fas fa-info-circle"></i></a></th> 
                    <th style="max-width: 50px;">IAP <br>
                    <a href="#" data-toggle="tooltip" title="In App Purchases"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 40px;">Imp 
                    <br>
  <a href="#" data-toggle="tooltip" title="Impressions per level played"><i class="fas fa-info-circle"></i></a> </th>               

  <th style="max-width: 40px;">Ads 
                    <br>
  <a href="#" data-toggle="tooltip" title="Watched Ads"><i class="fas fa-info-circle"></i></a> </th>

                <th style="max-width: 50px;">Ret.
                    <br>
                <a href="#" data-toggle="tooltip" title="Inital Retention 7 days "><i class="fas fa-info-circle"></i></a>
                </th>
                <th style="max-width: 30px;">7DR <br><a href="#" data-toggle="tooltip" title="Current 7 day retention"><i class="fas fa-info-circle"></i></a></th>
               

                <th style="max-width: 30px;">30DR <br><a href="#" data-toggle="tooltip" title="Current Retention 30 days"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 30px;">AU <br><a href="#" data-toggle="tooltip" title="Users Still Active  (Played at least 1 time in the last 60 days)"><i class="fas fa-info-circle"></i> </a></th>
                <th style="max-width: 40px;">Prog. <br> <a href="#" data-toggle="tooltip" title="Progression depth: 25 Percentile"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 35px;">Finish <br> <a href="#" data-toggle="tooltip" title="Number of users that finished (any stars) last level"><i class="fas fa-info-circle"></i></a></th>

           <th style="max-width: 30px;">Logo <br> <a href="#" data-toggle="tooltip" title="Logo Screen"><i class="fas fa-info-circle"></i> </a></th>
                <th style="max-width: 30px;">Menu <br> <a href="#" data-toggle="tooltip" title="Menu Screen"><i class="fas fa-info-circle"></i></a></th>
     
                <th style="max-width: 40px;">Tut.<br>S <a href="#" data-toggle="tooltip" title="Tutorial Start"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 35px;">Tut <br>E <a href="#" data-toggle="tooltip" title="Tutorial End"><i class="fas fa-info-circle"></i></a></th>
        
                
                <!-- Dynamic columns Worlds-->



                @forelse($game->levelinterfaces as $world)
                @if($world->name == "Menu" || $world->name == "LogoScreen" || $world->name == "Tutorial" ||  $world->name == "Tutorial End" )
                @else
                    @foreach(\App\Models\LevelDif::all() as $leveldif)
                     <th style="background-color: lightblue; color: black;">{{$world->name}} <br>{{$leveldif->name}} <br> <a href="#" data-toggle="tooltip" title="{{$world->name}}"><i class="fas fa-info-circle"></i></a></th>
                    @endforeach
                @endif
                @empty
                @endforelse
            </tr>
        </thead>


{{--Start body of table--}}


        <tbody>
              @foreach($cohorts as $cohort)
            <tr>

                <td>{{$loop->index + 1}} <a href="#" data-toggle="tooltip" title="{{$cohort->name}}"><i class="fas fa-info-circle"></i></a></td>
                <td><small>{{\Carbon\Carbon::parse( $cohort->userdata->first()->last_activity)->diffForHumans() }}</small></td>
                <td>{{$cohort->userdata->sum('sessions_played')}}</td>


                <td>

@if($cohort->deaths->count() != 0 && $cohort->deaths->sum('value') != 0)
                        @if(number_format(($cohort->deaths->count() / $cohort->deaths->sum('value')) * 100, 0) > 50)
                            <span style="color: purple;">
                                {{number_format(($cohort->deaths->sum('value') /  $cohort->userdata->sum('sessions_played')) * 100, 0)  }} %
                            </span>

                        @else
 <span style="color: blue;">
                     {{number_format(($cohort->deaths->sum('value') /  $cohort->userdata->sum('sessions_played')) * 100, 0)  }} %
                    </span>
                        @endif

                    @else
                   <span style="color: black;"> 0 % </span>
                    @endif



                </td>
                <!-- IAPS -->
                <td>


@if($cohort->userdata->count() != 0 && $cohort->userdata->sum('iaps') != 0)
                        @if(number_format(($cohort->userdata->count() / $cohort->userdata->sum('iaps')) * 100, 0) > 50)
                            <span style="color: green;">
                                {{number_format(($cohort->userdata->count() / $cohort->userdata->sum('iaps')) * 100, 0)  }} %
                            </span>

                        @else
 <span style="color: red;">
                    {{number_format(($cohort->userdata->count() / $cohort->userdata->sum('iaps')) * 100, 0)  }} %
                    </span>
                        @endif

                    @else
                   <span style="color: red;"> 0 % </span>
                    @endif

                </td>
                <!--Impressions-->
                <td>{{$cohort->userdata->sum('showed_ads')}}</td>
                <!-- watched ads -->
                <td>
                    @if($cohort->userdata->sum('showed_ads') != 0 && $cohort->userdata->sum('watched_ads') != 0)
                        @if(number_format(($cohort->userdata->sum('watched_ads') / $cohort->userdata->sum('showed_ads')) * 100, 0) > 50)
                            <span style="color: green;">
                                {{number_format(($cohort->userdata->sum('watched_ads') / $cohort->userdata->sum('showed_ads')) * 100, 0)  }} %
                            </span>

                        @else
 <span style="color: red;">
                    {{number_format(($cohort->userdata->sum('watched_ads') / $cohort->userdata->sum('showed_ads')) * 100, 0)  }} %
                    </span>
                        @endif

                    @else
                    0 %
                    @endif

                </td>

                <td>0</td>
                <td>0</td>
                <td>0</td>
                <!-- Users -->
                <td> 0</td>
                <td>0</td>
                <td>0</td>                



                <td> @if( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'LogoScreenInterfaceTest')->get()  != "[]")
{{\App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'LogoScreenInterfaceTest')->get()->sum('users') }}
                   @else
                  0
                   @endif</td>

                <td>
                    
  @if( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'MenuInterface')->get()  != "[]")
{{\App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'MenuInterface')->get()->sum('users') }}
                   @else
                  0
                   @endif

                </td>
                   
                <td> @if( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'TutorialInterface')->get()  != "[]")
{{\App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'TutorialInterface')->get()->sum('users') }}
                   @else
                  0
                   @endif</td>
                <td>@if( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'TutorialInterfaceEnd')->get()  != "[]")
{{\App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', 'TutorialInterfaceEnd')->get()->sum('users') }}
                   @else
                  0
                   @endif</td>
      
                @php
                $loopindex = 0;
                @endphp

                @forelse($game->levelinterfaces as $world)
                @if($world->name == "Menu" || $world->name == "LogoScreen" || $world->name == "Tutorial" ||  $world->name == "Tutorial End" )
                @else
                    @foreach(\App\Models\LevelDif::all() as $leveldif)
                    <td>
                @if( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', $world->remote_id)->get()  != "[]")
            

                @php
                if ($loopindex > 2) {
                    $loopindex = 0;
                }

                @endphp
 @if(\App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', $world->remote_id)->where('level_dif', $loopindex)->get()->sum('users') != 0)
<!-- Here-->

 {{number_format(( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', $world->remote_id)->where('level_dif', $loopindex)->get()->sum('users')  / $cohort->amount) * 100, 0)  }} %

 @else

 0
 @endif
                @php
                $loopindex ++;
                @endphp

                   @else
                  0
                   @endif
                    </td>
                    @endforeach
                @endif
                @empty
                @endforelse

                <!-- Dynamic columns-->

                <!-- Dynamic columns-->
            </tr>
           @endforeach

        </tbody>
    </table>                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@section('scripts')
<script>
 $(document).ready(function() {
    $('#example').DataTable( {
        "scrollX": true,
         dom: 'Bfrtip',
         buttons: [
            {
                text: 'My button',
                action: function ( e, dt, node, config ) {
                    alert( 'Button activated' );
                }
            }
        ]
    } );
} );
</script>
<script>
 $(document).ready(function() {
    $('#example1').DataTable( {
        "scrollX": true,
        'buttons': [
 
    'colvis',
],
    } );
} );
</script>
<script>
 $(document).ready(function() {
    $('#example2').DataTable( {
        "scrollX": true,
        'buttons': [
 
    'colvis',
],
    } );
} );
</script>




<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>


<script>
    $('.datepicker').datepicker();
</script>

<script>
    $('.datepicker2').datepicker();
</script>


<script>document.onreadystatechange = function () {
  var state = document.readyState
  if (state == 'interactive') {
       document.getElementById('contents').style.visibility="hidden";
  } else if (state == 'complete') {
      setTimeout(function(){
         document.getElementById('interactive');
         document.getElementById('load').style.visibility="hidden";
         document.getElementById('contents').style.visibility="visible";
      },1000);
  }


}</script>

<script>
function myFunction() {
  document.getElementById("load").style.visibility = "visible";
}
</script>

<script>
    
function percentage() {
  var x = document.getElementById("sumtable");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
  var x = document.getElementById("percenttable");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

</script>

@endsection

@endsection