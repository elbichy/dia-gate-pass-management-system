<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Defence Intelligence Agency | Gate Pass Management System </title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    {!! MaterializeCSS::include_css() !!}

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    {!! MaterializeCSS::include_js() !!}
    <script src="{{asset('js/custom.js')}}"></script>
    <style>
        .container{
            padding:20px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            window.print();
        });
    </script>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>