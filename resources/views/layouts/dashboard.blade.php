<!DOCTYPE html>
<html>
<head>
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'>
    <title>
        @section('title')Chia Plots - @show
    </title>
    <meta content='width=device-width,initial-scale=1' name='viewport'>
    <link rel="stylesheet" media="all"
          href="/assets/application-12a9f60b4a6c861ac6d006963ae1d290ca71aa1f0d6b757d5333b92a6827c68c.css"
          data-turbolinks-track="reload"/>
    <script src="/packs/js/application-f82b56a7c4b6401d21fb.js" data-turbolinks-track="reload"></script>
    @section('header-scripts') @show
</head>
<body>
@include('blocks.dashboard.navigation')
@yield('content')
</body>
</html>
