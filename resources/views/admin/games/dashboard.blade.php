<div id="load"></div>
@extends('layouts.admin')
  

@section('content')
<div class="content">
    <div class="row">

        <div class="col-lg-12">
        <h1>  {{$game->name}}</h1>

    <a href="#" onclick="addData(barChart, 'Daily Showed Ads', '#ff0000', [
            @for ($i = 0; $i < 30; $i++)


    {{App\Models\UserData::where('game_id', $game->remote_id)->where('last_activity', Carbon\Carbon::today()->subDays(30-$i)->format('Y-m-d')."T00:00:00")->sum('showed_ads')}},
            @endfor

             ]);" class="btn btn-xs btn-primary">Showed Ads</a>


    <a href="#" onclick="addData(barChart, 'Daily Watched Ads', '#0e7fe1', [
            @for ($i = 0; $i < 30; $i++)



    {{App\Models\UserData::where('game_id', $game->remote_id)->where('last_activity', Carbon\Carbon::today()->subDays(30-$i)->format('Y-m-d')."T00:00:00")->sum('watched_ads')}},
            @endfor

             ]);" class="btn btn-xs btn-primary">Watched Ads</a>    



    <a href="#" onclick="addData(barChart, 'Daily Watched Ads', '#ffc83d', [
            @for ($i = 0; $i < 30; $i++)



   
    {{App\Models\UserData::where('game_id', $game->remote_id)->where('last_activity', Carbon\Carbon::today()->subDays(30-$i)->format('Y-m-d')."T00:00:00")->sum('iap')}},
            @endfor

             ]);" class="btn btn-xs btn-primary">In App Purchases</a>





<canvas id="barChart" width="400" height="200"></canvas>

<script>
    
    var ctx = document.getElementById("barChart");
    
    var barChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [      
            @for ($i = 0; $i < 30; $i++)
            {{Carbon\Carbon::today()->subDays(30-$i)->format('d')}},
            @endfor
            ],
        datasets: [{
            label: 'Daily Players in {{$game->name}}',
            data:

             [
            @for ($i = 0; $i < 30; $i++)

    {{App\Models\UserData::where('game_id', $game->remote_id)->where('last_activity', Carbon\Carbon::today()->subDays(30-$i)->format('Y-m-d')."T00:00:00")->count()}},
            @endfor

             ],

 fill: true,
   backgroundColor: [

                'rgba(54, 162, 235, 0)'
            ],
    borderColor:'rgba(255, 159, 64, 1)',
    tension: 0.1
        }]
    }
});



function addData(chart, label, color, data) {
        chart.data.datasets.push({
        label: label,
      backgroundColor: color,
      data: data
    });
    chart.update();
}

</script>



<!-- Main content -->
    <section class="content">

      <!-- Small boxes (Stat box) -->
      <div class="row">

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
    data: [{{App\Models\UserData::where('game_id', $game->remote_id)->where('platform', 'GooglePlay')->count()}}, {{App\Models\UserData::where('game_id', $game->remote_id)->where('platform', 'UnSupported/Editor')->count()}}],
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

        <div class="col-lg-8">
          
        <div class="col-lg-12 col-xs-12">
    
        <div class="col-lg-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$cohorts->count()}}</h3>
              <p>Cohorts</p>
            </div>
            <div class="icon">
              <i class="fas fa-gamepad"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
        <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$todaysessions}}</h3>

              <p>Total Sessions</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>

          </div>
        </div>


        <div class="col-lg-6">
                    <div class="small-box" style="background-color:teal; color: white;">
            <div class="inner">
              <h3>{{$showedads->count()}}</h3>

              <p>Showed Ads</p>
            </div>
            <div class="icon">
              <i class="fas fa-archive"></i>
            </div>
          </div>
        </div>       


        <div class="col-lg-6">
                                <div class="small-box" style="background-color:gray; color:white;">
            <div class="inner">
                
              <h3> {{$watchedads->count()}} </h3>
                

              <p>Watched Ads</p>
            </div>
            <div class="icon">
              <i class="fas fa-sign-in-alt"></i>
            </div>
          </div>
        </div>        

        <div class="col-lg-12">
                    <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{$userdata->sum('iap')}}</h3>

              <p>IAPs</p>
            </div>
            <div class="icon">
              <i class="fas fa-database"></i>
            </div>
          </div>
        </div>

    </div>
</div>

                </div>
            </section>
        </div>
    </div>
</div>


@section('scripts')



@endsection

@endsection