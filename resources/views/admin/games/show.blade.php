

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
                <li class="list-group-item">
         <b>Users</b> <a class="pull-right">1</a>
                </li>
              </ul>
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