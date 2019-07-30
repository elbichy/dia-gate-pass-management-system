<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ config('app.name', 'Defence Intelligence Agency | Gate Pass Management System') }}@isset($title) - {{ $title }}@endisset
    </title>
    <style>
        :root {
            --primary-bg-dark: #164f6b; 
            --primary-bg-mid: #0e75a7; 
            --primary-bg-light: #039be5;  
            
            --primary-trans-bg-dark: #164f6b;
            --primary-trans-bg-light: #039be5;
            
            --secondary-bg-dark: #8d1003; 
            --secondary-bg-light: #c91e0b; 
            
            --switch-dark: #164f6b; 
            --switch-light: #039be5; 

            --button-dark: #164f6b; 
            --button-light: #039be5;
            --button-secondary: #8d1003;
        }
    </style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/wnoty.js')}}"></script>
    {!! MaterializeCSS::include_js() !!}
    <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
    {!! MaterializeCSS::include_css() !!}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/wnoty.css')}}">
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
        <div class="navbar-fixed">
                <nav>
                    <div class="nav-wrapper">
                        <a href="#" class="hide-on-med-and-down" style="margin-left: 20px;">Defence Intelligence Agency Gate Pass system</a>
                        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="dashboard">Home</a></li>
                            @if(auth()->user()->role == 1)
                            <li>
                                <!-- Menu Dropdown Structure -->
                                <a class="dropdown-trigger" href="#!" data-target="manageStaffs">
                                    Manage Staffs<i class="material-icons right">arrow_drop_down</i>
                                </a>
                                <ul id="manageStaffs" class="dropdown-content manageStaffs">
                                    <li><a href="{{route('manageGateReceptionStaff')}}" class="blue-text">Admin Staff</a></li>
                                    <li><a href="{{route('manageGeneralStaff')}}" class="blue-text">General Staff</a></li>
                                </ul>
                            </li>
                            @endif
                            @if(auth()->user()->role == 2)
                                <li><a href="/admin/print-gate-guest-list" target="_blank">Print today guests<i class="material-icons right">print</i></a></li>
                            @endif
                            <li><a href="#">{{auth()->user()->firstname.' '.auth()->user()->lastname}}</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                        <ul class="right">
                            <a href="#" style="margin-right: 14px;" data-target='notifications'  class="admin-dropdown-trigger right hide-on-small-only">
                                <i style="margin-right: 0px;" class="material-icons left">notifications</i>
                                {!! auth()->user()->unreadNotifications->count() > 0 ? '<sup class="red lighten-2 notificationCount">'.auth()->user()->unreadNotifications->count().'</sup>' : '<sup class="red blue notificationCount">0</sup>' !!}
                            </a>
                             <!-- Notifications Dropdown Structure -->
                            <ul id='notifications' class='dropdown-content admin-notifications'>
                                @foreach(auth()->user()->unreadNotifications as $notificationCollection)
                                    @foreach($notificationCollection->data as $notificationItem)
                                    <li class="light-blue darken-2">
                                        <a href="#" class="white-text">
                                            <div class='notMsg'>
                                                <p>{{$notificationItem['msg']}}</p>
                                                <sub class="white-text">
                                                    From: {{$notificationItem['staff']}} ({{$notificationItem['office']}})
                                                    <br /> 
                                                    {{Carbon\Carbon::parse($notificationCollection->created_at)->diffForHumans()}}
                                                </sub>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                @endforeach
                            </ul>
                        </ul>
                        {{-- <ul> 
                            <a  href="#" style="margin-left: 14px;" data-target='notifications'  class="dropdown-trigger left hide-on-med-and-up">
                                <i style="margin-right: 0px;" class="material-icons left">notifications</i>
                                {!! auth()->user()->unreadNotifications->count() > 0 ? '<sup class="red notificationCount">'.auth()->user()->unreadNotifications->count().'</sup>' : '<sup class="red green notificationCount">0</sup>' !!}
                            </a>
                        </ul>  --}}
                    </div>
                </nav>
                <ul class="sidenav" id="mobile-demo">
                    <li><a href="#">{{auth()->user()->firstname.' '.auth()->user()->lastname}}</a></li>
                    @if(auth()->user()->role == 1)
                        <li><a class="dropdown-trigger hide-on-med-and-up" href="#" data-target="dropdown2">Manage Staffs<i class="material-icons right">arrow_drop_down</i></a></li>
                    @endif
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
    <div class="fullWrapper">
        @yield('content')
    </div>

    <script>
        let base_url = '{{ asset('/') }}';
    </script>
    @stack('scripts')
</body>
</html>