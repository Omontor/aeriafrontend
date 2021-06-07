

    @extends('layouts.admin')
    <style type="text/css">
      div.dataTables_wrapper {

        margin: 0 auto;
        padding: 20px;
    }
    </style>
@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <a href="/admin/games" class="btn btn-md btn-primary">Back to all games</a>
      </h1>
      <ol class="breadcrumb"> 
        <li><a href="#">Active Users By Region</a></li>
      </ol>
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
                <li class="list-group-item">
         <b>Users</b> <a class="pull-right">1</a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Worlds</a></li>
              <li><a href="#timeline" data-toggle="tab">Levels</a></li>
     
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">       
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Levels</th>
                    <th>Creation Date</th>
                    <th>Actions</th>
                  </tr>
                  </thead>



                  <tbody>
                     @forelse($worlds as $world)
               
                  <tr>

                    <td>{{$world->ID}}</td>
                    <td>{{$world->Name}}</td>
                    <td>
                      @forelse( \App\Models\Level::where('WorldID', $world->ID)->get() as $test)
                      <ul>
                        <li>{{$test->ID}} {{$test->Name}} </li>
                      </ul>
                      @empty
                      No levels in this world
                      @endforelse
                    </td>
                    <td>{{Carbon\Carbon::parse($world['creationDate'])->format('d-m-Y')}}</td>

             
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
                        
                        <a href="#" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i>

</a>
                      </div>
                    </td>
                  </tr>           
               
                    @empty
                    <tr>
                      <td>
                        No data to show
                      </td>
                    </tr>
                      @endforelse
                  </tbody>
                </table>
              </div>

              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                
      <!-- Levels Tab -->
      <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>World</th>
                    <th>Created At</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                     @forelse(\App\Models\Level::where('WorldID', $world->ID)->get() as $level)
               
                  <tr>
                    <td>{{$level->ID}}</td>
                    <td>{{$level->Name}}</td>
                    <td>{{\App\Models\World::where('ID', $level->WorldID)->first()->Name}}</td>
                    <td>{{Carbon\Carbon::parse($world->CreationDate)->format('d-m-Y')}}</td>             
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
                        
                        <a href="#" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i>

</a>
                      </div>
                    </td>
                  </tr>           
               
                    @empty
                    <tr>
                      <td>
                        No data to show
                      </td>
                    </tr>
                      @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.tab-pane -->

              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>


        <div class="col-lg-8">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Segments</h3>
            </div>

<table id="example2" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Segment Name</th>
                <th>Totals</th>

            </tr>
        </thead>
        <tbody>
            @forelse($cohorts as $data)

            <tr>
                <td>{{$data->ID}}</td>
                <td>{{$data->IAP}}</td>
    
            </tr>
            @empty
            <tr>No data to show</tr>
            @endforelse

        </tbody>
    </table>
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
</div>



    <div class="row">
        <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Cohort Data</h3>
            </div>

<table id="example1" class="display nowrap" style="width:100%">
        <thead>
            <tr>
       
                <th style="max-width: 50px;">End Date</th>
                <th style="max-width: 50px;">Deaths</th>
                <th style="max-width: 50px;">Imp</th>
                <th style="max-width: 50px;">Boxes</th>
                <th style="max-width: 60px;">Retention</th>
                <th style="max-width: 50px;">7DR</th>
                <th style="max-width: 50px;">30DR</th>
                <th style="max-width: 50px;">Users</th>
                <th style="max-width: 50px;">Depth</th>
                <th style="max-width: 50px;">Finished</th>
                <th style="max-width: 50px;">LS</th>
                <th>PP</th>
                <th>Tut. Start</th>
                <th>Tut. End</th>
                <th>Main <br> Menu</th>

            </tr>
        </thead>
        <tbody>
            @forelse($cohorts as $cohort)

            <tr>
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
                <td> {{\App\Models\UserCohort::where('CohortGroupID', $cohort->ID)->count()}} </td>
                <td>260</td>
                <td>600</td>
                <td>40</td>
                <td>500</td>
                <td>1250</td>
                <td>1200</td>
                <td>100</td>

    
            </tr>
            @empty
            <tr>No data to show</tr>
            @endforelse

        </tbody>
    </table>
        </div>
      </div>
    </div>
  </div>


  <div class="content">
    <div class="row">
        <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Level View</h3>
            </div>

<table id="example3" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Level</th>
                <th>Avg. time to finish</th>
                <th>First death</th>
                <th>1 stars</th>      
                <th>2 stars</th>
                <th>3 stars</th>
                <th>Deaths per play</th>
                <th>% finish</th>
                <th>Once</th>

            </tr>
        </thead>
        <tbody>
            @forelse($cohorts as $data)

            <tr>
                <td>{{($loop->index)+1}}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
    
            </tr>
            @empty
            <tr>No data to show</tr>
            @endforelse

        </tbody>
    </table>
        </div>
      </div>
    </div>
  </div>


<div class="content">
    <div class="row">
        <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Resources Spent</h3>
            </div>

<table id="example4" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>World</th>
                <th>Cubes Spent</th>
                <th>% Use of cubes - Weapons upgrade</th>
                <th>% Use of cubes - Ammo</th>      
                <th>% Use of cubes - Health</th>
                <th>% Use of cubes - Gear</th>
                <th>Number of Gems spent</th>
                <th>% Gems converted in Cubes</th>
                <th>Use of gems for Energy and Sim</th>

            </tr>
        </thead>
        <tbody>
            @forelse($cohorts as $data)

            <tr>
                <td>{{($loop->index)+1}}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
    
            </tr>
            @empty
            <tr>No data to show</tr>
            @endforelse

        </tbody>
    </table>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="row">
        <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Monetisation</h3>
            </div>

<table id="example5" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Number of users that have started this level at least once</th>
                <th>Revenue per User</th>
                <th>% of revenues from Ads</th>
                <th>% of revenues from IAP</th>      
                <th>Number of ads seen per user that started the world</th>
                <th>% Ads from Deaths</th>
                <th>% Ads from Ammo</th>
                <th>% Ads from Loot Multiplyer</th>
                <th>% of user that did at least 1 IAP</th>
                <th>IAP for gems</th>
                <th>IAP Main Menu Promotions</th>
                <th>IAP - Shop Special offers</th>
     

            </tr>
        </thead>
        <tbody>
            @forelse($cohorts as $data)

            <tr>
                <td>{{($loop->index)+1}}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
    
            </tr>
            @empty
            <tr>No data to show</tr>
            @endforelse

        </tbody>
    </table>
        </div>
      </div>
    </div>
  </div>


<div class="content">
    <div class="row">
        <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Messages</h3>
            </div>

<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Country</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          @forelse($messages as $message)
            @if($message['gameId'] == $gameid)
            <tr>
                <td>{{$message['id']}}</td>
                <td>{{strip_tags($message['subject'])}}</td>
                <td>{!!$message['message']!!}</td>
                <td>{{$message['country']}}</td>
                <td></td>

            </tr>
            @else
            @endif
            @empty
            <tr>No data to show</tr>
            @endforelse
            

        </tbody>
    </table>
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