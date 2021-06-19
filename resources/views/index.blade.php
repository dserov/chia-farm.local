@extends("layouts.main")

@section("content")
    <div class='pt-7 pb-8 bg-dark bg-ellipses'>
        <div class='container-fluid'>
            <div class='row justify-content-center'>
                <div class='col-md-10 col-lg-8 col-xl-6'>
                    <h1 class='display-3 text-center text-white'>Buy Chia plots
                    </h1>
                    <p class='lead text-center text-muted'>Want to farm on the Chia network but don't feel like getting
                        specific hardware just for plotting? Tell us how many plots you want and we will get you a
                        download link within 24 hours. No technical skills necessary!
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class='container-fluid'>
        @if($auctions->isEmpty())
            <div class='row'>
                <div class='col-12'>
                    <div class='alert alert-warning'>
                        <h4 class='alert-heading'>All auctions are sold out</h4>
                        <p>It seems that all auctions are currently sold out. A new auction will be added in
                            14 minutes.
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class='row mt-n7'>
                @foreach($auctions as $auction)
                    <div class="col-12 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-uppercase text-center text-muted my-4">
                                    Auction #{{$auction->id}}
                                </h4>
                                <div class="row no-gutters align-items-center justify-content-center">
                                    <div class="h2 mb-0">$</div>
                                    <div class="col-auto">
                                        <div class="display-2 mb-0">{{ number_format($auction->price, 2) }}</div>
                                    </div>
                                </div>
                                <div class="h6 text-uppercase text-center text-muted mb-5">
                                    / plot
                                </div>
                                <div class="mb-3">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                            <small>Plotting starts in</small>
                                            <small>about 13 hours</small>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                            <small>Download retention</small>
                                            <small>1 month</small>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                            <small>Download limit</small>
                                            <small>3 times</small>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                            <small>Free support</small>
                                            <i class="fe fe-check-circle text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                            <small>Locations</small>
                                            <small><a href="/speedtest">Europe &amp; USA</a></small>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0"></li>
                                    </ul>
                                </div>
                                <div class="row no-gutters align-items-center justify-content-center">
                                    <div class="col-auto">
                                        <h2 class="mb-0">
                                            33 plots left
                                            <!-- 1620279239 -->
                                        </h2>
                                    </div>
                                </div>
                                <a class="btn btn-block btn-light mt-2" href="{{ route('orders::new', [ 'auctionId' => $auction->id]) }}">Buy plots
                                </a></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class='row'>
            <div class='col-12 col-md-6'>
                <!-- Card -->
                <div class='card card-inactive'>
                    <div class='card-body'>
                        <!-- Title -->
                        <h3 class='text-center'>Fully automated plotting service
                        </h3>
                        <!-- Text -->
                        <p class='text-muted text-center'>All our systems are completed automated and fully
                            self-service. You can do everything you need to do right from the website without any
                            delays. If you would like some help that's always available as well!
                        </p>
                        <!-- Button -->
                        <div class='text-center'>
                            <a class='btn btn-outline-secondary'
                               href='https://newaccount1619860225403.freshdesk.com/support/home'>Check our support
                                portal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-12 col-md-6'>
                <!-- Card -->
                <div class='card card-inactive'>
                    <div class='card-body'>
                        <!-- Title -->
                        <h3 class='text-center'>What is Chia?
                        </h3>
                        <!-- Text -->
                        <p class='text-muted text-center'>Chia is a new blockchain and smart transaction platform,
                            created by Bram Cohen, that is easier to use, more efficient, and secure.
                        </p>
                        <div class='text-center'>
                            <a class='btn btn-outline-secondary' href='/blogs'>Learn more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12'>
                <div class='row'>
                    <div class='col-12'>
                        <h2 class='text-center'>How does it work?</h2>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-6 col-sm-12'>
                        <div class='card info-card'>
                            <div class='card-body text-center'>
                                <div class='row justify-content-center'>
                                    <div class='col-12 col-xl-10'>
                                        <h2 class='mb-2'>Step 1 - Find an auction
                                        </h2>
                                        <p class='text-muted'>Every 12 hours a new auction starts that lasts exactly 12
                                            hours. In these 12 hours we sell the slots that will become available for
                                            plotting at the end of those 12 hours. We never oversell so the plots will
                                            be generated with 24 hours after the starting time. If the most recent
                                            auction sells out you can buy slots on the next one. Every auction might be
                                            priced a bit different depending on market conditions and available
                                            hardware.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-6 col-sm-12'>
                        <div class='card info-card'>
                            <div class='card-body text-center'>
                                <div class='row justify-content-center'>
                                    <div class='col-12 col-xl-10'>
                                        <h2 class='mb-2'>Step 2 - Create your order
                                        </h2>
                                        <p class='text-muted'>
                                            When you are ready to buy some Chia Plots you can create an order and tell
                                            us how many of the available slots you want to purchase. You also give us
                                            your farm and pool keys so we can generate Chia plots for you.
                                            Sharing your
                                            <strong>farm</strong>
                                            and
                                            <strong>pool</strong>
                                            keys is completely safe.
                                            Your plotting will start as soon as the slots become availabe, at the latest
                                            at the end of the auction.

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-6 col-sm-12'>
                        <div class='card info-card'>
                            <div class='card-body text-center'>
                                <div class='row justify-content-center'>
                                    <div class='col-12 col-xl-10'>
                                        <h2 class='mb-2'>Step 3 - Let's plot!
                                        </h2>
                                        <p class='text-muted'>Once the auction is completed your Chia plots will be
                                            generated for you on our dedicated plotting hardware in our datacenter in
                                            Europe. This will take a couple of hours the current average plot speed is
                                            7.36 hours but this will differ between plotting machines and Chia releases.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-6 col-sm-12'>
                        <div class='card info-card'>
                            <div class='card-body text-center'>
                                <div class='row justify-content-center'>
                                    <div class='col-12 col-xl-10'>
                                        <h2 class='mb-2'>Step 4 - Download your plots
                                        </h2>
                                        <p class='text-muted'>After the plotting is completed we will transfer your
                                            plots to our download server and send you a link. With this link you have 14
                                            days to download your plots and start farming them using the Chia harvester
                                            on your own personal computer or server.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='pt-4 pb-4 bg-dark bg-ellipses'>
        <div class='container-fluid'>
            <div class='row justify-content-center'>
                <div class='col-md-12'>
                    <h1 class='display-3 text-center text-white'>1829 plots generated will yours be next?
                    </h1>
                </div>
            </div>
        </div>
    </div>
@endsection
