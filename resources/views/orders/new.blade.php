@extends('layouts.dashboard')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@section('title')
    @parent
    New Order
@endsection

@section('header')
    New Order
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
                                New Order
                            </h1>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ route('orders::index') }}">Back to orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
            </div>
            <div class="row">
                <div class="card col-md-12 mt-5">
                    <div class="card-body">
                        <form class="simple_form new_order" id="new_order" novalidate="novalidate"
                              action="{{ route('orders::save_new') }}" accept-charset="UTF-8" method="post">
                            @csrf
                            <div class="form-group select optional order_auction_id">
                                <label class="select optional" for="order_auction_id">Auction price</label>
                                <select class="form-control select optional @error('order.auction_id') is-invalid @enderror" name="order[auction_id]" id="order_auction_id">
                                    @foreach($auctions as $key => $value)
                                        <option value="{{ $key }}" label="${{ number_format($value, 2) }}" @if(($auctionId ?? old('order.auction_id')) == $key) selected @endif></option>
                                    @endforeach
                                </select>
                                @error('order.auction_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group integer required order_plot_amount">
                                <label class="integer required" for="order_plot_amount">Plot
                                    amount <abbr title="required">*</abbr></label>
                                <input class="form-control numeric integer required @error('order.plot_amount') is-invalid @enderror" type="number" step="1"
                                        name="order[plot_amount]" id="order_plot_amount" value="{{ old('order.plot_amount') ?? '1' }}">
                                @error('order.plot_amount')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="form-text text-muted">Maximum amount of plots available left for this
                                    auction is: {{ $auction_max_count }}
                                </small>
                            </div>
                            <div class="form-group select optional order_download_server_id">
                                <label class="select optional" for="order_download_server_id">Download server</label>
                                <select class="form-control select optional @error('order.download_server_id') is-invalid @enderror" name="order[download_server_id]" id="order_download_server_id">
                                    @foreach($download_servers as $key => $value)
                                        <option value="{{ $key }}" label="{{ $value }}"></option>
                                    @endforeach
                                </select>
                                @error('order.download_server_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="form-text text-muted">Choose a destination close to you, the closer the
                                    destination the faster your download will (usually) be.
                                </small>
                            </div>
                            <div class="form-group hidden order_auction_id form-group-valid">
                                <input class="form-control is-valid hidden" type="hidden" value="{{ $auctionId ?? old('order.auction_id') }}"
                                        name="order[auction_id]" id="order_auction_id">
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

                            <input type="submit" name="commit" value="Create order" class="btn btn-primary"
                                   data-disable-with="Create order">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
