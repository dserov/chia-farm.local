@extends("layouts.main")

@section("content")
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="header mt-md-5">
                    <div class="header-body">
                        <div class="header-title">
                            <h1>Frequently Asked Questions</h1>
                        </div>
                        <p class="header-subtitle">Have any questions about the Chia blockchain, Chia farming or Chia plotting that are not already answered then feel free to send us an email.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Where can I find my Chia Farmer key and my Pool key</h4>
                    </div>
                    <div class="card-body">
                        <h5>Linux and MacOS</h5>
                        <p>To find your farmer and pool keys on Linux or MacOS you can use the following command.</p>
                        <pre>chia keys show | grep 'Pool\|Farmer'</pre>
                        <hr>
                        <h5>Windows</h5>
                        <p>Finding your farmer and pool keys on Windows is a bit trickier.</p>
                        <ol>
                            <li>Open the Command Prompt by going to Start and typing cmd and pressing enter.</li>
                            <li>
                                Paste the following command in the line
                                <code>%APPDATA%/../Local/chia-blockchain/app-1.1.2/resources/app.asar.unpacked/daemon/chia.exe keys show</code>
                            </li>
                            <li>
                                <strong>Never share your private keys</strong>
                                ,only public keys are safe to be shared. You will find your keys in the output.
                            </li>
                            <li>If you got an error on the first line you might be on an other version of chia application.</li>
                            <li>
                                To figure out which version you need type
                                <code>cd %APPDATA%/../Local/chia-blockchain/</code>
                                followed by
                                <code>dir</code>
                            </li>
                            <li>Hopefully you will see a version number that looks like app-1.0.5 or app-1.0.6 etc. Replace the version number in the command on line 2 and try it again.</li>
                            <li>If nothing works shoot us a message and we will look over it together</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Is it safe to share my Chia Farmer key and Pool key?</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            Sharing your
                            <strong>public keys</strong>
                            is always safe. But don't trust our word for it, just ask around on the Chia forums or look up other resources. Your
                            <strong>private keys should never be shared.</strong>
                            Your private keys protect your Chia, if you give those out anybody can use your wallet to send transactions.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">What is the average Chia plot generation time</h4>
                    </div>
                    <div class="card-body">
                        <p>The plot generation time differs based on the used Chia software version and the various hardware we employ. The average plot generation time is currently around 7 hours per plot. This is not including any waiting time before the plot starts. Plots are always started staggered so there is some delay between the creation of an order and the actual starting time of the plotting process.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">I selected the wrong currency while paying for my order, can I try again?</h4>
                    </div>
                    <div class="card-body">
                        <p>Sure thing! If you go to your Coingate payment URL and press "Cancel" the payment will be cancelled. If you wait a minute and try to press the "Pay order" button again a new payment will be created and you can pick a different currency.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">Should I use a download manager?</h4>
                    </div>
                    <div class="card-body">
                        <p>Yes, plots are very large files and there is always the chance of network interruption. It's highly recommended you use a download manager so that if something goes wrong you can continue the download where you left off. It can also help your speed if you pick a download manager that has multi-segmenting support. Although do please stick to just a handful of threads so that no rate-limits are imposed on the download. Here are a couple of example applications, you can also check the extension market for your favourite browser.</p>
                        <h5>Linux</h5>
                        <ol>
                            <li><a href="https://aria2.github.io/">Aria2</a></li>
                            <li><a href="https://xtremedownloadmanager.com">XDM</a></li>
                            <li><a href="https://lftp.yar.ru/">LFTP</a></li>
                        </ol>
                        <h5>Windows</h5>
                        <ol>
                            <li><a href="https://www.downthemall.org/">DownloadThemAll!</a></li>
                            <li><a href="https://www.freedownloadmanager.org/download.htm">Free Download Manager</a></li>
                        </ol>
                        <h5>MacOS</h5>
                        <ol>
                            <li><a href="https://mac.eltima.com/download-manager.html">Folx</a></li>
                            <li><a href="https://fiplab.com/apps/download-shuttle-for-mac">Shuttle</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title">I have extra plotting power, can I sell it to you?</h4>
                    </div>
                    <div class="card-body">
                        <p>Not right now I'm afraid. Most plotters are housed on residential ISP lines that are not fast enough to upload the resulting plots to my cloud hosting partners. If you have 10Gbit+ lines there might be an option to work together so do reach out to us if that's the case.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
