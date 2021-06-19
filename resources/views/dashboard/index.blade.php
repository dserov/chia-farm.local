@extends('layouts.dashboard')

@section('title')
    @parent
    Dashboard
@endsection

@section('header')
    Dashboard
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
                                Dashboard
                            </h1>
                        </div>
                        <div class='col-auto'>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='container-fluid'>
            <div class='row'>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class='col-md-12 mb-5 mt-5 alert alert-info'>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class='row'>
                <div class='container-fluid'>
                    <div class='row'>
                    </div>
                    <div class='row'>
                        <div class='col-12'>
                            <div class='card'>
                                <div class='card-header'>
                                    <h4 class='card-header-title'>Welcome to the Beta</h4>
                                </div>
                                <div class='card-body'>
                                    <p>Thanks for joining-up to the chia-plots.com Beta. I've been working hard these
                                        past
                                        few weeks to get this service up and running and appreciate you taking the time
                                        to
                                        register. If you have any feedback feel free to send me a message any time!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-12 col-lg-6 col-xl'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div class='row align-items-center'>
                                        <div class='col'>
                                            <h6 class='text-uppercase text-muted mb-2'>
                                                Total plots generated
                                            </h6>
                                            <span class='h2 mb-0'>{{ $plotsGeneratedCount }}</span>
                                        </div>
                                        <div class='col-auto'>
                                            <span class='h2 fe fe-dollar-sign text-muted mb-0'></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-12 col-lg-6 col-xl'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div class='row align-items-center'>
                                        <div class='col'>
                                            <h6 class='text-uppercase text-muted mb-2'>
                                                Total GB
                                            </h6>
                                            <span class='h2 mb-0'>{{$plotsGeneratedSize}}</span>
                                        </div>
                                        <div class='col-auto'>
                                            <span class='h2 fe fe-briefcase text-muted mb-0'></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-12 col-lg-6 col-xl'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div class='row align-items-center'>
                                        <div class='col'>
                                            <h6 class='text-uppercase text-muted mb-2'>
                                                Ready for Download
                                            </h6>
                                            <div class='row align-items-center no-gutters'>
                                                <div class='col-auto'>
                                                    <span class='h2 mr-2 mb-0'>{{$plotsReadyForDownload}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-auto'>
                                            <span class='h2 fe fe-clipboard text-muted mb-0'></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-12 col-lg-6 col-xl'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div class='row align-items-center'>
                                        <div class='col'>
                                            <h6 class='text-uppercase text-muted mb-2'>
                                                Average cost/plot
                                            </h6>
                                            <span class='h2 mb-0'>${{ number_format($averageCostPlot, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                    </div>
                    <div class='row'>
                        <div class='col-12'>
                            <div class='card'>
                                <div class='card-header'>
                                    <h4 class='card-header-title'>You referral link is:</h4>
                                </div>
                                <div class='card-body'>
                                    <p><a href="{{\Auth::user()->getReferralLink()}}">{{\Auth::user()->getReferralLink()}}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                    </div>
                    <div class='row'>
                        <div class='col-12 col-lg-6 col-xl'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div class='row align-items-center'>
                                        <div class='col'>
                                            <h6 class='text-uppercase text-muted mb-2'>
                                                Users, registered by you link
                                            </h6>
                                            <span class='h2 mb-0'>{{$referralUsersCount}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-12 col-lg-6 col-xl'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div class='row align-items-center'>
                                        <div class='col'>
                                            <h6 class='text-uppercase text-muted mb-2'>
                                                You referral balance
                                            </h6>
                                            <span class='h2 mb-0'>${{ number_format($referralBalans, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
