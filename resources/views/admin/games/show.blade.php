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
}</style>
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="/admin/games" class="btn btn-md btn-primary">Back to all games</a>
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
                <div class="box-body box-profile">

                             <div class="col-lg-5">  
     From:
                                <div class="input-group date" data-provide="datepicker">
    <input type="text" class="form-control">
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
</div>
    
                          
                        </select>
                    </div>                              

                    <div class="col-lg-5">  
     To:
                               <div class="input-group date" data-provide="datepicker2">
    <input type="text" class="form-control">
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
</div>
                         
                        </select>
                    </div> 
<div class="col-lg-2">  
    <br>
    <a href="" class="btn btn-md btn-primary">Filter By Date</a>
                    </div> 


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


        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>


<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-info">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link  btn btn-primary" href="#activity" data-toggle="tab" style="color:white;">Cohort View</a></li>
                  <li class="nav-item"><a class="nav-link btn btn-primary" href="#settings" data-toggle="tab" style="color:white;">Level</a></li>  
                  <li class="nav-item"><a class="nav-link btn btn-primary" href="#settings" data-toggle="tab" style="color:white;">Resources Spent</a></li>
                  <li class="nav-item"><a class="nav-link btn btn-primary" href="#settings" data-toggle="tab" style="color:white;">Monetization</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                  
                   <table id="example1" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                <th style="max-width: 15px;">ID</th>
                <th style="max-width: 40px;">Last <br> Activity </th>
                <th style="max-width: 50px;">DPL <br>
                    <a href="#" data-toggle="tooltip" title="Deaths per level played"><i class="fas fa-info-circle"></i></a></th> 
                    <th style="max-width: 50px;">IAP <br>
                    <a href="#" data-toggle="tooltip" title="In App Purchases"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 40px;">Imp 
                    <br>
  <a href="#" data-toggle="tooltip" title="Impressions per level played"><i class="fas fa-info-circle"></i></a> </th>               

  <th style="max-width: 40px;">Ads 
                    <br>
  <a href="#" data-toggle="tooltip" title="Showed ads"><i class="fas fa-info-circle"></i></a> </th>
                <th style="max-width: 50px;">Box
<br>
<a href="#" data-toggle="tooltip" title="Free box claims per day"><i class="fas fa-info-circle"></i></a>
                </th>
                <th style="max-width: 50px;">Ret.
                    <br>
                <a href="#" data-toggle="tooltip" title="Inital Retention 7 days "><i class="fas fa-info-circle"></i></a>
                </th>
                <th style="max-width: 30px;">7DR <br><a href="#" data-toggle="tooltip" title="Current 7 day retention"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 30px;">30DR <br><a href="#" data-toggle="tooltip" title="Current Retention 30 days"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 30px;">AU <br><a href="#" data-toggle="tooltip" title="Users Still Active  (Played at least 1 time in the last 60 days)"><i class="fas fa-info-circle"></i> </a></th>
                <th style="max-width: 40px;">Prog. <br> <a href="#" data-toggle="tooltip" title="Progression depth: 25 Percentile"><i class="fas fa-info-circle"></i></a></th>
                <th style="max-width: 35px;">Finish <br> <a href="#" data-toggle="tooltip" title="Number of users that finished (any stars) last level"><i class="fas fa-info-circle"></i></a></th>
               


     
                
                <!-- Dynamic columns Worlds-->

                @forelse($game->levelinterfaces as $world)
                <th style="background-color: lightgray; color: black;">{{$world->name}} <br> <a href="#" data-toggle="tooltip" title="{{$world->name}}"><i class="fas fa-info-circle"></i></a></th>
                @empty
                @endforelse

                <!-- Dynamic columns-->


                



            </tr>
        </thead>
        <tbody>
              @foreach($cohorts as $cohort)
            <tr>

                <td>{{$loop->index + 1}} <a href="#" data-toggle="tooltip" title="{{$cohort->name}}"><i class="fas fa-info-circle"></i></a></td>
                <td>{{ \Carbon\Carbon::parse(\App\Models\UserData::where('cohort_id', $cohort->id)->pluck('last_activity')->first())->diffForHumans() }}</td>
                <td>0</td>
                <!-- IAPS -->
                <td>{{$cohort->userdata->sum('iap')}}</td>
                <!--Impressions-->
                <td>{{$cohort->userdata->sum('showed_ads')}}</td>
                <!-- watched ads -->
                <td>{{$cohort->userdata->sum('watched_ads')}}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <!-- Users -->
                <td> 0</td>
                <td>0</td>
                <td>0</td>
      
   

                <!-- Dynamic columns-->

                @forelse($game->levelinterfaces as $world)
                <td>
                   @if( \App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', $world->remote_id)->get()  != "[]")
                   {{\App\Models\LevelProg::where('cohort_id', $cohort->remote_id)->where('interface_id', $world->remote_id)->get()->sum('users') }}
                   @else
                  0
                   @endif
                </td>
                @empty
                @endforelse
                <!-- Dynamic columns-->
            </tr>
           @endforeach

        </tbody>
    </table>
                  </div>


                  <div class="tab-pane" id="settings">
                <table id="example3" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                <th style="max-width: 20px;">ID</th>
                <th style="max-width: 60px;">End <br> Date</th>
                <th style="max-width: 50px;">Deaths</th>
                <th style="max-width: 30px;">Imp</th>
                <th style="max-width: 40px;">Boxes</th>
                <th style="max-width: 30px;">Ret.</th>
                <th style="max-width: 30px;">7 <br> DR</th>
                <th style="max-width: 30px;">30 <br>DR</th>
                <th style="max-width: 40px;">Users</th>
                <th style="max-width: 50px;">Depth</th>
                <th style="max-width: 40px;">Finish</th>
                <th style="max-width: 30px;">LS</th>
                <th style="max-width: 30px;">PP</th>
                <th style="max-width: 30px;">Tut. <br> Start</th>
                <th style="max-width: 30px;">Tut. <br>End</th>
                <th style="max-width: 30px;">Main <br> Menu</th>
                <th style="max-width: 20px;">ID</th>
                <th style="max-width: 60px;">End <br> Date</th>
                <th style="max-width: 50px;">Deaths</th>
                <th style="max-width: 30px;">Imp</th>
                <th style="max-width: 40px;">Boxes</th>
                <th style="max-width: 30px;">Ret.</th>
                <th style="max-width: 30px;">7 <br> DR</th>
                <th style="max-width: 30px;">30 <br>DR</th>
                <th style="max-width: 40px;">Users</th>
                <th style="max-width: 50px;">Depth</th>
                <th style="max-width: 40px;">Finish</th>
                <th style="max-width: 30px;">LS</th>
                <th style="max-width: 30px;">PP</th>
                <th style="max-width: 30px;">Tut. <br> Start</th>
                <th style="max-width: 30px;">Tut. <br>End</th>
                <th style="max-width: 30px;">Main <br> Menu</th>

            </tr>
        </thead>
        <tbody>
              @forelse($cohorts as $y)

            <tr>
                <td>{{$loop->index + 1}} </td>
                <td>{{ \Carbon\Carbon::today()->subDays($loop->index)->diffForHumans() }} </td>

                <td>100</td>
                <td>0</td>
                <td>0</td>
                <td>50</td>
                <td>10</td>
                <td>25</td>
                <!-- Users -->
                <td> 1</td>
                <td>260</td>
                <td>600</td>
                <td>40</td>
                <td>500</td>
                <td>1250</td>
                <td>1200</td>
                <td>100</td>    
                <td>1 </td>
                <td>{{ \Carbon\Carbon::today()->subDay()->diffForHumans() }} </td>

                <td>
                    100
                </td>
                <td>0 </td>
                <td>0</td>
                <td>50</td>
                <td>10</td>
                <td>25</td>
                <!-- Users -->
                <td> 1</td>
                <td>260</td>
                <td>600</td>
                <td>40</td>
                <td>500</td>
                <td>1250</td>
                <td>1200</td>
                <td>100</td>

    
            </tr>
           @empty 
           @endforelse

        </tbody>
    </table>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
        </div>
        </div>


    </div>
  </div>



@section('scripts')
<script>
 $(document).ready(function() {
    $('#example').DataTable( {
        "scrollX": true
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
 $(document).ready(function() {
    $('#example3').DataTable( {
        "scrollX": true,
        'buttons': [
 
    'colvis',
],
    } );
} );
</script>

<script>
 $(document).ready(function() {
    $('#example4').DataTable( {
        "scrollX": true,
        'buttons': [
 
    'colvis',
],
    } );
} );
</script>

<script>
 $(document).ready(function() {
    $('#example5').DataTable( {
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
@endsection

@endsection