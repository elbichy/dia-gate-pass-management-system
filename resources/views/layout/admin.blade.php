<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Defence Intelligence Agency | Gate Pass Management System </title>
    <link rel="stylesheet" href="{{asset('css/material-icons.css')}}">
    <link rel="stylesheet" href="{{asset('materialize-css/css/materialize.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/wnoty.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/moment.js')}}"></script>
    <script src="{{asset('js/moment-timezone-with-data-1970-2030.js')}}"></script>
    <script src="{{asset('js/livestamp.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    {!! MaterializeCSS::include_js() !!}
    <script src="{{asset('js/lately.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/pace.min.js')}}"></script>
    <script src="{{asset('js/ion.sound.min.js')}}"></script>
    <script src="{{asset('js/wnoty.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
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
                            <li>
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
    {{-- LOGIN ERR --}}
    @if ($errors->login->has('details'))
        <script>
            $(document).ready(function () {
                    $.wnoty({
                    type: 'error',
                    message: '{{ $errors->login->first('details') }}',
                    autohideDelay: 10000
                    });
                });
        </script>
    @endif
    @if (session()->has('accessError'))
        <script>
        $(document).ready(function () {
                $.wnoty({
                type: 'error',
                message: '{{session('accessError')}}',
                autohideDelay: 5000
                });
            });
        </script>
    @endif
    @if (session()->has('error'))
        <script>
        $(document).ready(function () {
                $.wnoty({
                type: 'error',
                message: '{{session('error')}}',
                autohideDelay: 5000
                });
            });
        </script>
    @endif
    @if (session()->has('noBusinessRecord'))
        <script>
        $(document).ready(function () {
                $.wnoty({
                type: 'info',
                message: '{{session('noBusinessRecord')}}',
                autohideDelay: 5000
                });
            });
        </script>
    @endif
    @if (session()->has('success'))
        <script>
        $(document).ready(function () {
                $.wnoty({
                type: 'success',
                message: '{{session('success')}}',
                autohideDelay: 5000
                });
            });
        </script>
    @endif

    @if(auth()->user()->role == 1)
        @yield('adminContent')
    @elseif(auth()->user()->role == 2)
        @yield('gateContent')
    @elseif(auth()->user()->role == 3)
        @yield('receptionContent')
    @endif

    {{-- @can('isOwner') --}}
    <script>
        // CHECK FOR NEW NOTIFICATION EVERY SECOND
        window.setInterval(function(){
            loadAdminNotification('{{asset('storage')}}');
        }, 2000);   
    </script>
    {{-- @endcan --}}
</body>
</html>