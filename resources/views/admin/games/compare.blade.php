

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

        <a href="/admin/games/{{$game['id']}}" class="btn btn-md btn-primary">Back to game</a>
      </h1>
      <ol class="breadcrumb"> 
        <li><a href="#">Active Users By Region</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
 

@switch($game['id'])
    @case(5)
          <img class="card-img-top" src="/img/american.jpg" alt="Card image cap" width="100%"> 
        @break

    @case(6)
    <center>
        <img class="card-img-top" src="/img/rescue.jpg" alt="Card image cap" style="max-height: 100px;">
        </center> 
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
              <h3 class="profile-username text-center">Rescue Robots</h3>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
 
      </div>
      <!-- /.row -->

    </section>

<div class="content">

    <div class="row">
        <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Cohort 1</h3>
            </div>

<table id="example1" class="display nowrap" style="width:100%">
        <thead>
            <tr>

                <th>End</th>
                <th>Deaths</th>
                <th>Impressions</th>
                <th>Box Claims</th>
                <th> Retention</th>
                <th>7 Day </th>
                <th>30 Day </th>
                <th>Active Users</th>
                <th>Progression </th>
                <th>Finished</th>
                <th>LS</th>
                <th>Privacy</th>
                <th>Tut. Start</th>
                <th>Tut.End</th>
                <th>Menu</th>

            </tr>
        </thead>
        <tbody>
            @forelse($cohortdata as $data)

            <tr>
   
                <td>{{ \Carbon\Carbon::today()->subDay()->diffForHumans() }} </td>
                <td> 5</td>
                <td>10</td>
                <td>100</td>
                <td>50</td>
                <td>10</td>
                <td>25</td>
                <td>789</td>
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

    <div class="row">
        <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Cohort 2</h3>
            </div>

<table id="example2" class="display nowrap" style="width:100%">
        <thead>
            <tr>

                <th>End</th>
                <th>Deaths</th>
                <th>Impressions</th>
                <th>Box Claims</th>
                <th> Retention</th>
                <th>7 Day </th>
                <th>30 Day </th>
                <th>Active Users</th>
                <th>Progression </th>
                <th>Finished</th>
                <th>LS</th>
                <th>Privacy</th>
                <th>Tut. Start</th>
                <th>Tut.End</th>
                <th>Menu</th>

            </tr>
        </thead>
        <tbody>
            @forelse($cohortdata as $data)

            <tr>
   
                <td>{{ \Carbon\Carbon::today()->subDay()->diffForHumans() }} </td>
                <td> 5</td>
                <td>10</td>
                <td>100</td>
                <td>50</td>
                <td>10</td>
                <td>25</td>
                <td>789</td>
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


   <div class="row">
        <div class="col-lg-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">New Comparison</h3>
            </div>
                <div class="box-body box-profile">
                    <div class="col-lg-6">   
                        <select class="form-control" control-id="ControlID-24">
                             @forelse($cohortdata as $data)
                          <option>{{$data->ID}}</option>
                            @empty
                            No data to show
                            @endforelse
                        </select>
                        </div>       
                        <div class="col-lg-6">   
                        <select class="form-control" control-id="ControlID-24">
                        @forelse($cohortdata as $data)
                          <option>{{$data->ID}}</option>
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



  </div>


  

  

@section('scripts')
<script>
 $(document).ready(function() {
    $('#example').DataTable( {
        "scrollX": true,

    } );
} );
</script>
<script>
 $(document).ready(function() {
    $('#example1').DataTable( {
        "scrollX": true,
         "searching": false,
             buttons: [
      
    ],
     "paging": false

    } );
} );
</script>
<script>
 $(document).ready(function() {
    $('#example2').DataTable( {
        "scrollX": true,
         "searching": false,
                     buttons: [
      
    ],
     "paging": false
    } );
} );
</script>

<script>
 $(document).ready(function() {
    $('#example3').DataTable( {
        "scrollX": true
    } );
} );
</script>

<script>
 $(document).ready(function() {
    $('#example4').DataTable( {
        "scrollX": true
    } );
} );
</script>

<script>
 $(document).ready(function() {
    $('#example5').DataTable( {
        "scrollX": true
    } );
} );
</script>
@endsection

@endsection