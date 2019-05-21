@extends('layout.personnel')

@section('content')
<h1>Hello</h1>
<li class="logOutBtn">
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="material-icons right">power_settings_new</i>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>
@endsection
