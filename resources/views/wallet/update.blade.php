@extends('layouts.dashboard')

@section('title')
    @parent
    New Wallet
@endsection

@section('header')
    @if(request()->is('*/create'))
        New wallet
    @else
        Edit wallet
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
            </div>
            <div class="row">
                <div class="card col-md-12 mt-5">
                    <div class="card-body">
                        <form class="simple_form new_wallet" id="new_wallet" novalidate="novalidate"
                              action="{{ route('wallet::save') }}" accept-charset="UTF-8" method="post">
                            @csrf
                            <input type="hidden" name="wallet[id]" value="{{ old('wallet.id') }}">
                            <div class="alert alert-dark">
                                <p>
                                    Please check out our
                                    <a target="_BLANK" href="{{ route('faq::index') }}">FAQ</a>
                                    if you don't know how to retrieve your Pool and Farmer keys
                                </p>
                            </div>
                            <div class="form-group string required wallet_name">
                                <label class="string required" for="wallet_name">Name <abbr title="required">*</abbr></label>
                                <input class="form-control string required @error('wallet.name') is-invalid @enderror" type="text" name="wallet[name]"
                                        id="wallet_name" value="{{ old('wallet.name') }}">
                                @error('wallet.name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group string required wallet_master_key">
                                <label class="string required" for="wallet_master_key">Master key <abbr title="required">*</abbr></label>
                                <input class="form-control string required @error('wallet.master_key') is-invalid @enderror" type="text" name="wallet[master_key]"
                                        id="wallet_master_key" value="{{ old('wallet.master_key') }}">
                                <small class="form-text text-muted">Please ensure you are using the *master key* mixing
                                    the keys up will make the plots invalid.
                                </small>
                                @error('wallet.master_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group string required wallet_farmer_key">
                                <label class="string required" for="wallet_farmer_key">Farmer key <abbr title="required">*</abbr></label>
                                <input class="form-control string required @error('wallet.farmer_key') is-invalid @enderror" type="text" name="wallet[farmer_key]"
                                        id="wallet_farmer_key" value="{{ old('wallet.farmer_key') }}">
                                <small class="form-text text-muted">Please ensure you are using the *farmer key* mixing
                                    the keys up will make the plots invalid.
                                </small>
                                @error('wallet.farmer_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group string required wallet_pool_key">
                                <label class="string required" for="wallet_pool_key">Pool key<abbr title="required">*</abbr></label>
                                <input class="form-control string required @error('wallet.pool_key') is-invalid @enderror" type="text" name="wallet[pool_key]"
                                       id="wallet_pool_key" value="{{ old('wallet.pool_key') }}">
                                @error('wallet.pool_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
