@extends('layouts.dashboard')

@section('title')
    @parent
    Profile
@endsection

@section('header')
        Edit profile
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
                              action="{{ route('profile::save') }}" accept-charset="UTF-8" method="post">
                            @csrf
                            <div class="form-group email required user_email">
                                <label class="email required" for="user_email">Email</label>
                                <input class="form-control is-valid string email required @error('email') is-invalid @enderror"
                                       required="required" aria-required="true" type="email" value="{{ $user->email }}"
                                       id="user_email" disabled>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group password optional user_password">
                                <label class="password optional" for="user_password">Password</label>
                                <input class="form-control password optional @error('password') is-invalid @enderror"
                                       autocomplete="new-password" type="password"
                                       name="password" id="user_password">
                                <small class="form-text text-muted">leave it blank if you don't want to change it</small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group password optional user_password_confirmation">
                                <label class="password optional" for="user_password_confirmation">Password
                                    confirmation</label>
                                <input class="form-control password optional @error('password_confirmation') is-invalid @enderror"
                                       autocomplete="new-password"
                                       type="password" name="password_confirmation"
                                       id="user_password_confirmation">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group password required user_current_password">
                                <label class="password required" for="user_current_password">Current
                                    password <abbr title="required">*</abbr></label>
                                <input class="form-control password required @error('current_password') is-invalid @enderror"
                                       autocomplete="current-password"
                                       required="required" aria-required="true"
                                       type="password"
                                       name="current_password"
                                       id="user_current_password">
                                <small class="form-text text-muted">we need your current password to confirm your changes</small>
                                @error('current_password')
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
