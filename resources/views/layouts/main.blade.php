<!DOCTYPE html>
<html>
<head>
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'>
    <title>@section("title") Buy Chia Plots, fast turnaround time and easy downloads @show</title>
    <meta content='width=device-width,initial-scale=1' name='viewport'>
    <meta content='Buy Chia plots with a few clicks without any technical knowledge, completely self-serviced and with a 24 hour turnaround time.
' name='description'>
    <meta name="csrf-param" content="authenticity_token"/>
    <meta name="csrf-token" content="HaGvmlhC_bb44jKFuWEBXfmxaq3lYgNrhAZXHO_b0j5_S5Q4X6mcb4jAIiXtxEpbPqT_8xrhoJVg5-CZYjh5OA"/>
    <link rel="stylesheet" media="all" href="/assets/application-12a9f60b4a6c861ac6d006963ae1d290ca71aa1f0d6b757d5333b92a6827c68c.css" data-turbolinks-track="reload"/>
    <script src="/packs/js/application-f82b56a7c4b6401d21fb.js" data-turbolinks-track="reload"></script>
    <script src="/packs/js/speedtest-3fbf7e70a343d92fec1a.js" data-turbolinks-track="reload"></script>
    <script async='' data-domain='chia-plots.com' defer='defer' src='https://plausible.io/js/plausible.js'></script>
</head>
<body class='border-top border-top-2 border-primary'>
@include("blocks.menu")
<div class='container'>
    <div class='row'>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }}</li>
            @endforeach
        @endif
    </div>
    <div class='row justify-content-center'>
        <div class='col-12'>
            @yield("content")
        </div>
    </div>
</div>
{{--<script>--}}
    {{--window.fwSettings = {--}}
        {{--'widget_id': 80000004108--}}
    {{--};--}}
    {{--!function() {--}}
        {{--if ("function" != typeof window.FreshworksWidget) {--}}
            {{--var n = function() {--}}
                {{--n.q.push(arguments)--}}
            {{--};--}}
            {{--n.q = [],--}}
                {{--window.FreshworksWidget = n--}}
        {{--}--}}
    {{--}()--}}
{{--// </script>--}}
{{--<script async='' defer='defer' src='https://euc-widget.freshworks.com/widgets/80000004108.js' type='text/javascript'></script>--}}
</body>
</html>
