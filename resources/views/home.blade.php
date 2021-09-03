
@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">

        <div class="col-lg-12">
      <div class="col-lg-12">
                   <a class="btn btn-success" href="{{ route('admin.homeresync') }}">
                   Resync All Data
                </a>                   

                <a class="btn btn-primary" href="{{ route('admin.secondsync') }}">
                   Resync Level Proggression
                </a>
      </div>
      <br>
      <br>
<!-- Main content -->
    <section class="content">

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$gamescount}}</h3>

              <p>Games</p>
            </div>
            <div class="icon">
              <i class="fas fa-gamepad"></i>
            </div>
            <a href="/admin/games" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$userscount}}</h3>

              <p>Admins</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-12">
        
        <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{$cohorts}}</h3>

              <p>Cohorts</p>
            </div>
            <div class="icon">
              <i class="fas fa-database"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>       

        <div class="col-lg-4 col-xs-12">
        <div class="small-box" style="background-color:teal; color: white;">
            <div class="inner">
              <h3>{{$records}}</h3>

              <p>Records</p>
            </div>
            <div class="icon">
              <i class="fas fa-archive"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>



        <div class="col-lg-4 col-xs-12">
        <div class="small-box" style="background-color:gray; color:white;">
            <div class="inner">
              <h3>{{$today->sum('sessions_played')}}</h3>

              <p>Sessions Today</p>
            </div>
            <div class="icon">
              <i class="fas fa-sign-in-alt"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-12">
          <canvas id="myChart" width="400" height="100"></canvas>


{{--Data Sources--}}


<script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['{{Carbon\Carbon::today()->subDays(7)->format('l')}}','{{Carbon\Carbon::today()->subDays(6)->format('l')}}','{{Carbon\Carbon::today()->subDays(5)->format('l')}}', '{{Carbon\Carbon::today()->subDays(4)->format('l')}}', '{{Carbon\Carbon::today()->subDays(3)->format('l')}}', '{{Carbon\Carbon::today()->subDays(2)->format('l')}}', '{{Carbon\Carbon::today()->subDays(1)->format('l')}}', 'Today'],
        datasets: [{
            label: 'Players in all games',
            data: [{{$today7->count()}},{{$today6->count()}},{{$today5->count()}}, {{$today4->count()}}, {{$today3->count()}}, {{$today2->count()}}, {{$today1->count()}}, {{$today->count()}}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',  
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
 
        </div>        


<div class="col-lg-7">
<canvas id="myChart2" width="400" height="300"></canvas>
            {{--Data Sources--}}

<script>
var ctx = document.getElementById('myChart2');
var myChart2 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [      
            @for ($i = 0; $i < 30; $i++)
            {{Carbon\Carbon::today()->subDays(30-$i)->format('d')}},
            @endfor
            ],
        datasets: [{
            label: 'Daily Players in all games',
            data:

             [
            @for ($i = 0; $i < 30; $i++)

    {{App\Models\UserData::where('last_activity', Carbon\Carbon::today()->subDays(30-$i)->format('Y-m-d')."T00:00:00")->count()}},
            @endfor

             ],

 fill: true,
   backgroundColor: [

                'rgba(54, 162, 235, 1)'
            ],
    borderColor:'rgba(255, 159, 64, 1)',
    tension: 0.1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>  

</div>

<div class="col-lg-5">

    <canvas id="myChart6" width="400" height="100"></canvas>
            {{--Data Sources--}}

<script>
var ctx = document.getElementById('myChart6');
var myChart6 = new Chart(ctx, {
    type: 'bubble',
    data: {
        labels: [      
            @for ($i = 0; $i < 30; $i++)
            {{Carbon\Carbon::today()->subDays(30-$i)->format('d')}},
            @endfor
            ],
        datasets: [{
            label: 'Daily in app purchases',
            data:

             [
            @for ($i = 0; $i < 30; $i++)

    {{App\Models\UserData::where('last_activity', Carbon\Carbon::today()->subDays(30-$i)->format('Y-m-d')."T00:00:00")->sum('iap')}},
            @endfor

             ],

 fill: false,
    borderColor:'rgba(255, 159, 64, 1)',
    tension: 0.1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script> 

 <canvas id="myChart7" width="400" height="300"></canvas>
            {{--Data Sources--}}

<script>
var ctx = document.getElementById('myChart7');
var myChart7 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [      
            @for ($i = 0; $i < 30; $i++)
            {{Carbon\Carbon::today()->subDays(30-$i)->format('d')}},
            @endfor
            ],
        datasets: [{
            label: 'Daily Sessions',
            data:

             [
            @for ($i = 0; $i < 30; $i++)

    {{App\Models\UserData::where('last_activity', Carbon\Carbon::today()->subDays(30-$i)->format('Y-m-d')."T00:00:00")->sum('sessions_played')}},
            @endfor

             ],

 fill: false,
    backgroundColor:'rgba(75, 192, 192, 1)',
    tension: 0.1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>  
</div>


    <div class="col-lg-8">
        <canvas id="myChart5" width="400" height="100"></canvas>
            {{--Data Sources--}}

<script>
var ctx = document.getElementById('myChart5');
var myChart5 = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [      
            @for ($i = 0; $i < 30; $i++)
            {{Carbon\Carbon::today()->subDays(30-$i)->format('d')}},
            @endfor
            ],
        datasets: [{
            label: 'Daily Showed Ads',
            data:

             [
            @for ($i = 0; $i < 30; $i++)

    {{App\Models\UserData::where('last_activity', Carbon\Carbon::today()->subDays(30-$i)->format('Y-m-d')."T00:00:00")->sum('showed_ads')}},
            @endfor

             ],

 fill: false,
    borderColor: 'rgba(255, 206, 86, 1)',
    tension: 0.1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
       


<canvas id="myChart4" width="400" height="100"></canvas>
            {{--Data Sources--}}

<script>
var ctx = document.getElementById('myChart4');
var myChart4 = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [      
            @for ($i = 0; $i < 30; $i++)
            {{Carbon\Carbon::today()->subDays(30-$i)->format('d')}},
            @endfor
            ],
        datasets: [{
            label: 'Daily Watched Ads',
            data:

             [
            @for ($i = 0; $i < 30; $i++)

    {{App\Models\UserData::where('last_activity', Carbon\Carbon::today()->subDays(30-$i)->format('Y-m-d')."T00:00:00")->sum('watched_ads')}},
            @endfor

             ],

 fill: false,
    borderColor: 'rgba(153, 102, 255, 1)',
    tension: 0.1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
 


</div>
<div class="col-lg-4">
        <canvas id="myChart3" width="100%" height="80"></canvas>
            {{--Data Sources--}}

<script>
var ctx = document.getElementById('myChart3');
var myChart3 = new Chart(ctx, {
    type: 'doughnut',
    data: {
   labels: [
    'Android',
    'UnSupported/Editor',
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [{{App\Models\UserData::where('platform', 'GooglePlay')->count()}}, {{App\Models\UserData::where('platform', 'UnSupported/Editor')->count()}}],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    hoverOffset: 4
  }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
 
        </div>


      </div>


            </section>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent

@endsection