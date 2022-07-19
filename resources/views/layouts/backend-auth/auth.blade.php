<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>

@include('layouts.backend-dashboard.stylesheet')
</head>
<body class="hold-transition {{($title == 'Login Page')? 'login':'register'}}-page">
@yield('content')
<!-- /.login-box -->

@include('layouts.backend-dashboard.javascript')
</body>
</html>
