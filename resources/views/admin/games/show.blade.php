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
 

@switch($game['id'])
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
              <h3 class="profile-username text-center">{{$game['name']}}</h3>

              <p class="text-muted text-center">Last updated: {{\Carbon\Carbon::now()->diffForHumans()}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>App ID</b>
                  <br> 
                  <a>{{$game['appID']}}</a>
                  <br>
                </li>
                <li class="list-group-item">
                  <b>App Secret</b>
                  <br> 
                  <a>{{$game['secret']}}</a>
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

 

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    var markers = [
 
        {     
        "title": 'test',
        "lat": '19.38476904761318',
        "lng": '-99.16648936441923',
        "description": 'test'
    },
    
    ];
    window.onload = function () {
        LoadMap();
    }
    function LoadMap() {
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            // zoom: 8, //Not required.
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var infoWindow = new google.maps.InfoWindow();
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
 
        //Create LatLngBounds object.
        var latlngbounds = new google.maps.LatLngBounds();
 
        for (var i = 0; i < markers.length; i++) {
            var data = markers[i]
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title
            });
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + data.description + "</div>");
                    infoWindow.open(map, marker);
                });
            })(marker, data);
 
            //Extend each marker's position in LatLngBounds object.
            latlngbounds.extend(marker.position);
        }
 
        //Get the boundaries of the Map.
        var bounds = new google.maps.LatLngBounds();
 
        //Center map and adjust Zoom based on the position of all markers.
        map.setCenter(latlngbounds.getCenter());
        map.fitBounds(latlngbounds);
    }
</script>
<div id="dvMap" style="width: 100%; height: 400px">
</div>


<script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-VZUr01EdXUPZfUcj_UilKvo1DjmfGG0&callback=initMap">
                        </script>

<br>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Worlds</a></li>
              <li><a href="#timeline" data-toggle="tab">Levels</a></li>
              <li><a href="#settings" data-toggle="tab">Level Interfaces</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">       
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Creation Date</th>

                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                     @forelse($worlds as $world)
                       @if($world['gameId'] == $gameid)
                  <tr>
                    <td>{{$world['id']}}</td>
                    <td>{{$world['name']}}</td>
                    <td>{{Carbon\Carbon::parse($world['creationDate'])->format('d-m-Y')}}<span>
                     

                    </span></td>
             
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
                        
                        <a href="#" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i>

</a>
                      </div>
                    </td>
                  </tr>           
                  @endif
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
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <!-- Level Interfaces Tab -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
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
              <h3 class="box-title">Cohort Data</h3>
            </div>

<table id="example1" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
                <th>E-mail</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger</td>
                <td>Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
                <td>t.nixon@datatables.net</td>
                <td>Tiger</td>
                <td>Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
                <td>t.nixon@datatables.net</td>
            </tr>
            

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
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
                <th>E-mail</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger</td>
                <td>Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
                <td>t.nixon@datatables.net</td>
                <td>Tiger</td>
                <td>Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
                <td>t.nixon@datatables.net</td>
            </tr>
            

        </tbody>
    </table>
        </div>
      </div>
    </div>
  </div>


<div class="content">
    <div class="row">
        <div class="col-lg-6">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">General Dificulty</h3>

       
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Cohort</th>
                    <th>Death per level</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                     @forelse($messages as $message)
                       @if($message['gameId'] == $gameid)
                  <tr>
                    <td><a href="pages/examples/invoice.html">{{$message['id']}}</a></td>
                    <td><strong>{{strip_tags($message['subject'])}}</strong></td>
                    <td><span>
                      {{strip_tags($message['message'])}}
                    </span></td>
         
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
                        
                        <a href="#" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i>

</a>
                      </div>
                    </td>
                  </tr>           
                  @endif
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
              <!-- /.table-responsive -->
            </div>

            <!-- /.box-footer -->
          </div>
        </div>

<div class="col-lg-6">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">General Monetization</h3>

       
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Cohort</th>
                    <th>Imp per level</th>
                    <th>Free Box claims</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                     @forelse($messages as $message)
                       @if($message['gameId'] == $gameid)
                  <tr>
                    <td><a href="pages/examples/invoice.html">{{$message['id']}}</a></td>
                    <td><strong>{{strip_tags($message['subject'])}}</strong></td>
                    <td><span>
                      {{strip_tags($message['message'])}}
                    </span></td>
                    <td><span>
                      {{strip_tags($message['message'])}}
                    </span></td>
         
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
                        
                        <a href="#" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i>

</a>
                      </div>
                    </td>
                  </tr>           
                  @endif
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
              <!-- /.table-responsive -->
            </div>

            <!-- /.box-footer -->
          </div>
        </div>

<div class="col-lg-12">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">General Engagement</h3>

       
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Initial Retention</th>
                    <th>Current Retention</th>
                    <th>Curren Retention 30 Days</th>
                    <th>Progression Depth top 25%</th>
                    <th>Users Finished</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                     @forelse($messages as $message)
                       @if($message['gameId'] == $gameid)
                  <tr>
                    <td><a href="pages/examples/invoice.html">{{$message['id']}}</a></td>
                    <td><strong>{{strip_tags($message['subject'])}}</strong></td>
                    <td><span>
                     0
                    </span></td>
                    <td><span>
                      0
                    </span></td>         
                    <td><span>
                     0
                    </span></td>                    
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
                        
                        <a href="#" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i>

</a>
                      </div>
                    </td>
                  </tr>           
                  @endif
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
              <!-- /.table-responsive -->
            </div>

            <!-- /.box-footer -->
          </div>
        </div>

<div class="col-lg-12">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Level Progression</h3>

       
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Load Screen</th>
                    <th>Privacy Policy</th>
                    <th>Tutorial Start</th>
                    <th>Tutorial End</th>
                    <th>Main Menu</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                     @forelse($messages as $message)
                       @if($message['gameId'] == $gameid)
                  <tr>
                    <td><a href="pages/examples/invoice.html">{{$message['id']}}</a></td>
                    <td><strong>{{strip_tags($message['subject'])}}</strong></td>
                    <td><span>
                      0
                    </span></td>
                    <td><span>
                      0
                    </span></td>      
                    <td><span>
                      0
                    </span></td>                    
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
                        
                        <a href="#" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i>

</a>
                      </div>
                    </td>
                  </tr>           
                  @endif
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
              <!-- /.table-responsive -->
            </div>

            <!-- /.box-footer -->
          </div>
        </div>

    </div>
</div>



<div class="content">
    <div class="row">
        <div class="col-lg-12">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Messages</h3>

       
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
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
                    <td><a href="pages/examples/invoice.html">{{$message['id']}}</a></td>
                    <td><strong>{{strip_tags($message['subject'])}}</strong></td>
                    <td><span>
                      {{strip_tags($message['message'])}}
                    </span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">{{$message['country']}}</div>
                    </td>          
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">
                        
                        <a href="#" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i>

</a>
                      </div>
                    </td>
                  </tr>           
                  @endif
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
              <!-- /.table-responsive -->
            </div>

            <!-- /.box-footer -->
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
        "scrollX": true
    } );
} );
</script>
@endsection

@endsection