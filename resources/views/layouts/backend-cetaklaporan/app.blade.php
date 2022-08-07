<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GeekGarden Attendance</title>
    @include("layouts.backend-cetaklaporan.stylesheet")

    <style>
        tr,td, th{
            border:1px solid #000;
            text-align: center;
            padding: 4px;
        }
    </style>

</head>
<body>
<header>
    <center>
        <h1>
            Laporan Absensi GeekGarden Software House
        </h1>
    </center>
</header>

@yield('content')
@include('layouts.backend-cetaklaporan.javascript')
</body>
</html>
