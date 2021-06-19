<!DOCTYPE html>
<html>
<head>
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'>
    <title>
        @section('title')Chia Plots - @show
    </title>
    <meta content='width=device-width,initial-scale=1' name='viewport'>
    <meta name="csrf-token" content="{{csrf_token()}}" >
    <link rel="stylesheet" media="all"
          href="/assets/application-12a9f60b4a6c861ac6d006963ae1d290ca71aa1f0d6b757d5333b92a6827c68c.css"
          data-turbolinks-track="reload"/>
    {{--<script src="/packs/js/application-f82b56a7c4b6401d21fb.js" data-turbolinks-track="reload"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
@include('blocks.admin.dashboard.navigation')
@yield('content')
</body>
</html>
