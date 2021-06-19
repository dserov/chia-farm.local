@extends('layouts.dashboard')

@section('title')
    @parent
    New Wallet
@endsection

@section('header')
    @if(request()->is('*/create'))
        New plot
    @else
        Edit plot
    @endif
@endsection

@section('content')
    <div class="main-content">
        <!-- HEADER -->
        <div class="header">
            <div class="container-fluid">
                <!-- Body -->
                <div class="header-body">
                    <div class="row align-items-end">
                        <div class="col">
                            <h6 class="header-pretitle">
                                Overview
                            </h6>
                            <h1 class="header-title">
                                @yield('header')
                            </h1>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ route('dashboard::index') }}">Back to dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                @if( session('error'))
                    <div class="col-md-12 alert alert-warning" role="alert">
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                @if($wallets->isEmpty())
                    <div class="col-md-12 alert alert-warning" role="alert">
                        <strong>First, you need to add wallet!</strong>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="card col-md-12 mt-5">
                    <div class="card-body">
                        <form class="simple_form new_plot" id="new_plot" novalidate="novalidate"
                              action="{{ route('plots::save') }}" accept-charset="UTF-8" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $orderId }}">
                            <div class="form-group select optional wallet_id">
                                <label class="select optional" for="wallet_id">Wallet</label>
                                <select class="form-control select optional @error('wallet_id') is-invalid @enderror" name="wallet_id" id="wallet_id">
                                    @foreach($wallets as $wallet)
                                        <option value="{{ $wallet->id }}" label="{{ $wallet->name }}">{{$wallet->name}}</option>
                                    @endforeach
                                </select>
                                @error('wallet_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="form-text text-muted">Select wallet</small>
                            </div>
                            {{--<script src="https://www.recaptcha.net/recaptcha/api.js?render=6LcDaL4aAAAAAEpzv1Zrjq94R_awI_a2QEl-shn4"></script>--}}
                            <script>
                                // Define function so that we can call it again later if we need to reset it
                                // This executes reCAPTCHA and then calls our callback.
                                // function executeRecaptchaForNewOrder() {
                                //     grecaptcha.ready(function () {
                                //         grecaptcha.execute('6LcDaL4aAAAAAEpzv1Zrjq94R_awI_a2QEl-shn4', {action: 'new_order'}).then(function (token) {
                                //             setInputWithRecaptchaResponseTokenForNewOrder('g-recaptcha-response-data-new-order', token)
                                //         });
                                //     });
                                // };
                                // Invoke immediately
                                // executeRecaptchaForNewOrder()

                                // Async variant so you can await this function from another async function (no need for
                                // an explicit callback function then!)
                                // Returns a Promise that resolves with the response token.
                                async function executeRecaptchaForNewOrderAsync() {
                                    return new Promise((resolve, reject) => {
                                        grecaptcha.ready(async function () {
                                            resolve(await grecaptcha.execute('6LcDaL4aAAAAAEpzv1Zrjq94R_awI_a2QEl-shn4', {action: 'new_order'}))
                                        });
                                    })
                                };

                                var setInputWithRecaptchaResponseTokenForNewOrder = function (id, token) {
                                    var element = document.getElementById(id);
                                    element.value = token;
                                }

                            </script>
                            <input type="hidden" name="g-recaptcha-response-data[new_order]"
                                   id="g-recaptcha-response-data-new-order"
                                   data-sitekey="6LcDaL4aAAAAAEpzv1Zrjq94R_awI_a2QEl-shn4"
                                   class="g-recaptcha g-recaptcha-response "
                                   value="03AGdBq26uE4fgkgT10mFBmiU2yIJpJ6zOOWRijXF8ULNETPpXcCVpxxC7LlsEdoeHeXDocYdeNoy0NUhWl9zVGsqN2EAN2n6WUnAqdgx7At2_D7gSypbq8Fcht7Q0wUzvZmrP_XvtRbAohBE0Tx6kFeT2lS_IL0xqsJo2u9XiXX544rgqqrqnMBjzY243TC4b0W-CCa0kMf3buj3-aOJ9bFIBueGoE4P6lkSW6QQEJWih0qnN5HR3R9mXoYHNLvvT2gVJSZ3HWm7V8sbdz9TxjQsv-k2Bf66IZp_8NU1tvHHyU13XLjh31ZYF20X1qGjxZbzYv0OudHldJ-RqJlyiuwRiikiesBhdi4lH_HRFgRziZYJ4gxUWCl-h0aOozOOXcHI3MAzsga8kgFEkyoqK077TGGxkIlW7iHPS8STtJv2k8A1RkYFq_RE5G0sxH6BALYXvOLX31YsWzkVYQdgYJHfCMjQQOO_WHA"
                                   style="">

                            <input type="submit" name="commit" value="Save" class="btn btn-primary"
                                   data-disable-with="Saving...">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
