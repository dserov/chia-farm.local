@extends("layouts.main")

@section("content")
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a class="avatar" href="#!">
                                    <img alt="..." class="avatar-img rounded-circle" src="https://en.gravatar.com/userimage/4774533/48803d0206f206891c77b124e1e4f96b.jpg?size=200">
                                </a>
                            </div>
                            <div class="col ml-n2">
                                <!-- Title -->
                                <h4 class="mb-1">What is the Chia blockchain and how do I get started?</h4>
                                <!-- Time -->
                                <p class="card-text small text-muted">
                                    <span class="fe fe-clock"></span>
                                    <time datetime="2021-05-24">24th of April 2021</time>
                                </p>
                            </div>
                            <div class="col-auto">
                                <!-- Dropdown -->
                                <div class="dropdown">
                                    <a aria-expanded="false" aria-haspopup="true" class="dropdown-ellipses dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                        <i class="fe fe-more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#!">
                                            Action
                                        </a>
                                        <a class="dropdown-item" href="#!">
                                            Another action
                                        </a>
                                        <a class="dropdown-item" href="#!">
                                            Something else here
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="mb-3">Chia is a new blockchain and smart transaction platform much like others such as Ethereum and Tron. The project was founded in August 2017 by Bram Cohen, the inventor of the BitTorrent protocol. Chia's blockchain relies on a new consensus mechanism called Proof-of-Space and Time (PoST) to secure the network and reach a consensus on transaction verification. The network also introduces a new native cryptocurrency token, XCH, that serves to reward network participants that help secure the chain.</p>
                    <p class="mb-3">Chia was created out of frustration with the current ‘miner-heavy’ blockchain landscape. Bitcoin miners, for example, currently use over 129 terawatt hours annually to keep the blockchain secure. That’s as much energy usage as the whole country of Norway. Chia wanted to be the ‘green’ blockchain by not requiring miners to have specialized hardware and enabling all Chia users to help protect the network by farming.</p>
                    <p class="mb-3">On the Chia blockchain you can participate on the network by farming plots. A “Plot” is a new concept and can be best imagined as a gigantic Bingo card with millions of numbers written on it. Every few minutes the network will define some criteria which decides which cards are eligible to be looked at and what number they should find on said cards. If one of your cards is eligible and you have the best number you get the block reward. As a farmer you can have multiple of these Bingo cards and use them at the same time. The more cards you have the bigger the chance that you will be eligible to get the block reward.</p>
                    <p class="mb-3">Farming can be done quite easily on any PC or laptop. You could even use a small Raspberry Pi 4 with an external disk attached to save on energy costs. The most important thing is that the device is always running and that you have enough free disk space to store the plots you want to farm. Creating the Bingo cards themselves though requires specialised hardware for the best performance. You need a CPU with high frequency and very fast storage. This is the one point which makes Chia a bit hard to get started with.</p>
                    <p class="mb-3">To solve these issues we created chia-plots.com. We generate the plots and send you a download link so you can start farming on your own PC or laptop without having to invest in specialised hardware specifically for the plotting process.</p>
                    <p class="mb-3">Just create a free account on the website, tell us how many Chia plots you want to receive and pay using crypto-currencies or Paypal.</p>
                    <p class="mb-3">You can use <a href="https://chiacalculator.com/">Chia Calculator</a> to see how soon you recoup your investment costs based on the current network details such as netspace and price.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
