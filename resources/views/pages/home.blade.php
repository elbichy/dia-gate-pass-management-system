@extends('layout.app')

@section('content')
  <main>

    <img class="responsive-img" src="{{asset('storage/site/logo100.png')}}" />
    <h2 class="homeHeader white-text" style="margin-bottom:0px;">Welcome to DIA Gate Pass System</h2>
    <h6 class="homeSubtitle white-text">Select the appropriate service you wis to access</h6>
    <div class="homMenuContainer">
      <a href="{{route('adminLogin')}}" class="item z-depth-1">
        <i class="large material-icons">security</i>
        <p>Gate Staff</p>
      </a>
      <a href="{{route('login')}}" class="item z-depth-1">
        <i class="large material-icons">person_pin</i>
        <p>Personnel</p>
      </a>
    </div>
  </main>
@endsection