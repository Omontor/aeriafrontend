
@extends('layouts.admin')
 <link href="/css/iphone.css" rel="stylesheet" type="text/css">
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
           
<div class="col-lg-7">
            <form method="POST" action="{{route('admin.notifications.store')}}">
                   {{ csrf_field() }}
                   <div class="form-group">
                       <label for="title">Title</label>
                       <input type="text" class="form-control" id="title" name="title" placeholder="Title" required onchange="$('#myAnchor').text(this.value)">
                   </div>                   


                   <div class="form-group">
                       <label for="message">Message</label>
                       <textarea class="form-control" name="message" id="" cols="20" rows="10" required onchange="$('#myAnchor2').text(this.value)"></textarea>
                   </div>


                   <div class="form-group">
                       <label for="title">Game</label>

                       <select class="form-control" name="game">
                            @forelse($games as $game)
                            <option value="{{$game->remote_id}}">
                                {{$game->name}}
                            </option>
                            @empty
                            @endforelse
                       </select>
          
                   </div>

                   <button type="submit" class="btn btn-primary btn-block">Send</button>
               </form>
            </div>

<div class="col-lg-5">
<div class="md-iphone-5 md-black-device md-glare">
   <div class="md-body">
      <div class="md-buttons"></div>
      <div class="md-front-camera"></div>
      <div class="md-top-speaker"></div>

      <div class="md-screen">
    
        <!---->


  
          <br>
    <div style="max-height: 50%; background: rgba(255,255,255,.8);  border-radius: 25px;
      padding: 10px;
      width: 100%;
      height: 100px; align-content: center; text-align: center;">
          <h6 id="myAnchor"> <b>This is the title of your notification</b></h6>
           <p id="myAnchor2"> Content</p>
       
        </div>

        <!---->

      </div>

      <button class="md-home-button"></button>
  </div>
</div>



</div>

        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection