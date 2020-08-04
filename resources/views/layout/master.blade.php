<!DOCTYPE html>
<html lang="en">

    <title>E-Bazaar DKI 2</title>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{URL::asset('js/jquery.mask.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/dashboard.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
    </head>
    <body>
        @include('layout.header')
            <div class="container">
                <br>
                <br>
                @yield('content')
            </div>
        @include('layout.footer')
    </body>
</html>
