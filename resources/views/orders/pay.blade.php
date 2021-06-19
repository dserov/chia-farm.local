@extends('layouts.dashboard')

@section('title')
    @parent
    Order pay
@endsection

@section('header')
    Order pay
@endsection

@section('content')
    <div class='main-content'>
        <!-- HEADER -->
        <div class='header'>
            <div class='container-fluid'>
                <!-- Body -->
                <div class='header-body'>
                    <div class='row align-items-end'>
                        <div class='col'>
                            <h6 class='header-pretitle'>
                                Overview
                            </h6>
                            <h1 class='header-title'>
                                @yield('header')
                            </h1>
                        </div>
                        <div class='col-auto'>
                            ${{ number_format($order->price * $order->plot_amount, 2)}} - ${{ number_format(\Auth::user()->balans, 2) }} = ${{ number_format($order->price * $order->plot_amount - \Auth::user()->balans, 2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='container-fluid'>
            <div class='row'>
                @if(session('success'))
                    <div class='col-md-12 mb-5 mt-5 alert alert-info'>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class='col-md-12 mb-5 mt-5 alert alert-warning'>
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <iframe id="iframe_payment" src="/cryptobox_payment.php?order_id={{$order->id}}" frameborder="0" style="height: 1200px"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('iframe_payment').onload = function () {
            setTimeout(iResize, 350);
            // Safari and Opera need a kick-start.
            // let iSource = document.getElementById('iframe_payment').src;
            // document.getElementById('iframe_payment').src = '';
            // document.getElementById('iframe_payment').src = iSource;
        };

        function iResize() {
            document.getElementById('iframe_payment').style.height = '1200px';
            document.getElementById('iframe_payment').contentWindow.document.body.style.backgroundColor = 'transparent';
                // document.getElementById('iframe_payment').contentWindow.document.body.offsetHeight + 'px';
        }
    </script>
@endsection
