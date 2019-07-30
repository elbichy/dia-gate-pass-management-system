<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Defence Intelligence Agency | Gate Pass Management System </title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    {!! MaterializeCSS::include_css() !!}
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
            <div class="nav-wrapper blue darken-2">
                <a href="#!" style="margin-left: 20px;" class="hide-on-med-and-down">Defence Intelligence Agency Gate Pass system</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger right"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="#">Home</a></li>
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
                    <a href="#" style="margin-right: 14px;" data-target='notifications'  class="personnel-dropdown-trigger right hide-on-small-only">
                        <i style="margin-right: 0px;" class="material-icons left">notifications</i>
                        {!! auth()->user()->unreadNotifications->count() > 0 ? '<sup class="red lighten-2 notificationCount">'.auth()->user()->unreadNotifications->count().'</sup>' : '<sup class="red blue notificationCount">0</sup>' !!}
                    </a>
                    <!-- Dropdown Structure -->
                    <ul id='notifications' class='dropdown-content staff-notifications' style="z-index: -100;">
                        @foreach(auth()->user()->unreadNotifications as $notificationCollection)
                            @foreach($notificationCollection->data as $notificationItem)
                            <li class="light-blue darken-2">
                                <a href="#" class="white-text">
                                    <div class='notMsg'>
                                        <p>{{$notificationItem['msg']}}</p>
                                        <sub class="white-text">{{Carbon\Carbon::parse($notificationCollection->created_at)->diffForHumans()}}</sub>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        @endforeach
                    </ul>
                </ul>
                <ul> {{-- FOR MOBILE --}}
                    <a  href="#" style="margin-left: 14px;" data-target='notifications'  class="personnel-dropdown-trigger left hide-on-med-and-up">
                        <i style="margin-right: 0px;" class="material-icons left">notifications</i>
                        {!! auth()->user()->unreadNotifications->count() > 0 ? '<sup class="red lighten-2 notificationCount">'.auth()->user()->unreadNotifications->count().'</sup>' : '<sup class="red blue notificationCount">0</sup>' !!}
                    </a>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
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
    </div>
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

    @yield('content')

    {{-- @can('isOwner') --}}
    <script>
            // CHECK FOR NEW NOTIFICATION EVERY SECOND
            window.setInterval(function(){
                loadNotification('{{asset('storage')}}');
            }, 10000);   
        </script>
    {{-- @endcan --}}
</body>
</html>