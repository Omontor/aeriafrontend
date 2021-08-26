
@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">

        <div class="col-lg-12">
      <div class="col-lg-12">
                   <a class="btn btn-success" href="{{ route('admin.homeresync') }}">
                   Resync All Data
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

        <div class="col-lg12">
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


      </div>


            </section>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent

@endsection