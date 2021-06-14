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

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="/admin/games" class="btn btn-md btn-primary">Back to all games</a>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
 

@switch($gameid)
    @case(5)
          <img class="card-img-top" src="/img/american.jpg" alt="Card image cap" width="100%"> 
        @break

    @case(6)
        <img class="card-img-top" src="/img/rescue.jpg" alt="Card image cap" width="100%"> 
        @break
    @case(7)
          <img class="card-img-top" src="/img/herostorm.jpg" alt="Card image cap" width="100%"> 
        @break
        @case(8)
          <img class="card-img-top" src="/img/copsvsrobbers.jpg" alt="Card image cap" width="100%"> 
        @break
       @case(9)
          <img class="card-img-top" src="/img/designspace.jpg" alt="Card image cap" width="100%"> 
        @break         
    @default
        <img class="card-img-top" src="/img/slider-1.jpg" alt="Card image cap" width="100%">  
@endswitch
<hr>
              <h3 class="profile-username text-center">{{$game->first()->Name}}</h3>

              <p class="text-muted text-center">Last updated: {{\Carbon\Carbon::now()->diffForHumans()}}</p>

                      
       <p>  <b>Users</b> <a class="pull-right">1</a></p>
            
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-lg-8">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Game Details</h3>
              <br>
                <ul class="list-group list-group-unbordered">
                <li class="list-group-item">   
                  <b>App ID</b>
                  <br> 
                  <a>{{$game->first()->AppId}}</a>
                  <br>
                </li>
                <li class="list-group-item">
                  <b>App Secret</b>
                  <br> 
                  <a>{{$game->first()->Secret}}</a>
                  <br>
                </li>
    
              </ul>
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

                          <option>{{$data->NameID}}</option>
                            @empty
                            No data to show
                            @endforelse
                        </select>
                        </div>       
                        <div class="col-lg-6">   
                        <select class="form-control" control-id="ControlID-24">
                        @forelse($cohorts as $data)
                          <option>{{$data->NameID}}</option>
                            @empty
                            No data to show
                            @endforelse
                        </select>
                        </div>  
                        <br>
                        <hr>
                        <div class="col-lg-2">
                        </div>
                        <div class="col-lg-8"><a href="{{route('admin.games.compare')}}" class="btn btn-block btn-primary">Compare Cohorts</a></div>
                            <div class="col-lg-2">
                        </div>
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
                  <li class="nav-item"><a class="nav-link btn btn-primary" href="#timeline" data-toggle="tab" style="color:white;">Segments</a></li>
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
                <th style="color:  white; background-color: blue; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: blue; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">Start <br>Once</th>
                <th style="color:  white; background-color: darkcyan; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: darkcyan; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">Start <br>Once</th><th style="color:  white; background-color: blue; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: blue; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">Start <br>Once</th>
                <th style="color:  white; background-color: darkcyan; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: darkcyan; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">Start <br>Once</th><th style="color:  white; background-color: blue; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: blue; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">Start <br>Once</th>
                <th style="color:  white; background-color: darkcyan; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: darkcyan; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">Start <br>Once</th>

                <th style="color:  white; background-color: blue; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: blue; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">Start <br>Once</th>
                <th style="color:  white; background-color: darkcyan; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: darkcyan; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">Start <br>Once</th> <th style="color:  white; background-color: blue; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: blue; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">Start <br>Once</th>
                <th style="color:  white; background-color: darkcyan; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: darkcyan; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">Start <br>Once</th> <th style="color:  white; background-color: blue; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: blue; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: blue; max-width: 30px;">Start <br>Once</th>
                <th style="color:  white; background-color: darkcyan; max-width: 20px;">Avg. <br>ttf</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">First <br> Death</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">1 Star</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">2 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">3 Stars</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">DPP</th>
                <th style="color:  white; background-color: darkcyan; max-width: 50px;">Finish <br> Level</th>
                <th style="color:  white; background-color: darkcyan; max-width: 30px;">Start <br>Once</th>

            </tr>
        </thead>
        <tbody>
              @foreach(range(1, 99) as $y)

            <tr>
                <td>{{$loop->index + 1}} </td>
                <td>{{ \Carbon\Carbon::today()->subDays($loop->index)->diffForHumans() }} </td>

                <td>
                    100
                </td>
                <td>
                {{\App\Models\UserGameData::sum('ShowedAds')}}
                </td>
                <td>  
                {{\App\Models\UserGameData::sum('ShowedAds')}}</td>
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
                <td>100</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>50</td>
                <td>10</td>
                <td>25</td>
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
                <td>100</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>50</td>
                <td>10</td>
                <td>25</td>
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
                <td>100</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>50</td>
                <td>10</td>
                <td>25</td>
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
                <td>100</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>50</td>
                <td>10</td>
                <td>25</td>
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
                <td>100</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>50</td>
                <td>10</td>
                <td>25</td>
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
                <td>100</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>{{\App\Models\UserGameData::sum('ShowedAds')}}</td>
                <td>50</td>
                <td>10</td>
                <td>25</td>
                <td> 1</td>
                <td>260</td>
                <td>600</td>
                <td>40</td>
                <td>500</td>
                <td>1250</td>
                <td>1200</td>
                <td>100</td>

    
            </tr>
           @endforeach

        </tbody>
    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <table id="example2" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                <th style="max-width: 20px;">Cohort</th>
                <th style="max-width: 60px;">End <br> Date</th>
                <th style="max-width: 50px;">Spender</th>
                <th style="max-width: 30px;">Ads <br> Lover</th>
                <th style="max-width: 40px;">Hyper <br> Active</th>
                <th style="max-width: 30px;">Vip <br>Cooling</th>
                <th style="max-width: 30px;">Vip<br> Cold</th>
                <th style="max-width: 30px;">Cooling <br>User</th>
                <th style="max-width: 40px;">Cold <br> User</th>
                <th style="max-width: 50px;">VIP <br> Dead</th>
                <th style="max-width: 40px;">Dead <br> User</th>
                <th style="max-width: 30px;">Newbie</th>
                <th style="max-width: 30px;">Veteran</th>
                <th style="max-width: 30px;">Casual <br> User</th>
                <th style="max-width: 30px;">Referall</th>
                <th style="max-width: 30px;">Leaderboard</th>
                <th style="max-width: 20px;">End of <br>Road</th>

                
            </tr>
        </thead>
        <tbody>
              @foreach(range(1, 31) as $y)

            <tr>
                <td>{{$loop->index + 1}} </td>
                <td>{{ \Carbon\Carbon::today()->subDays($loop->index)->diffForHumans() }} </td>

                <td>
                    100
                </td>
                <td>
                {{\App\Models\UserGameData::sum('ShowedAds')}}
                </td>
                <td>  
                {{\App\Models\UserGameData::sum('ShowedAds')}}</td>
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


    
            </tr>
           @endforeach

        </tbody>
    </table>
                  </div>
                  <!-- /.tab-pane -->

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
              @foreach(range(1, 31) as $y)

            <tr>
                <td>{{$loop->index + 1}} </td>
                <td>{{ \Carbon\Carbon::today()->subDays($loop->index)->diffForHumans() }} </td>

                <td>
                    100
                </td>
                <td>
                {{\App\Models\UserGameData::sum('ShowedAds')}}
                </td>
                <td>  
                {{\App\Models\UserGameData::sum('ShowedAds')}}</td>
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
                <td>
                {{\App\Models\UserGameData::sum('ShowedAds')}}
                </td>
                <td>  
                {{\App\Models\UserGameData::sum('ShowedAds')}}</td>
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
           @endforeach

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



@endsection

@endsection