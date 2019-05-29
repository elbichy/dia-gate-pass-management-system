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
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    {!! MaterializeCSS::include_js() !!}
    <script src="{{asset('js/pace.min.js')}}"></script>
    <script src="{{asset('js/wnoty.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
</head>
<body>
    <div class="navbar-fixed">
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="{{route('manageGateReceptionStaff')}}" class="blue-text">Admin Staff</a></li>
            <li><a href="{{route('manageGeneralStaff')}}" class="blue-text">General Staff</a></li>
        </ul>
        <nav>
            <div class="nav-wrapper blue darken-2">
                <a href="#!" class="hide-on-med-and-down" style="margin-left: 20px;">Defence Intelligence Agency Gate Pass system</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="dashboard">Home</a></li>
                    @if(auth()->user()->role == 1)
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Manage Staffs<i class="material-icons right">arrow_drop_down</i></a></li>
                    @endif
                    <li><a href="dashboard/myprofile">{{auth()->user()->firstname.' '.auth()->user()->lastname}}</a></li>
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
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li><a href="dashboard/myprofile">{{auth()->user()->firstname.' '.auth()->user()->lastname}}</a></li>
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

    @if(auth()->user()->role == 1)
        @yield('adminContent')
    @elseif(auth()->user()->role == 2)
        @yield('gateContent')
    @elseif(auth()->user()->role == 3)
        @yield('receptionContent')
    @endif


</body>
</html>