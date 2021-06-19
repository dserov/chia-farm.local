@extends("layouts.main")

@section("content")
    <div class="pt-7 pb-8 bg-dark bg-ellipses">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-6">
                    <h1 class="display-3 text-center text-white">
                        Speedtest
                    </h1>
                    <p class="lead text-center text-muted">It's important that, once your Chia plots are bought and generated, you can download them in a timely matter. Please do the speedtest so you can see how long your downloads will take.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p id="speedtest-progress">Waiting to start</p>
                    </div>
                    <div class="card-footer">
                        <select class="custom-select" id="dc">
                            @foreach($download_servers as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <a class="btn btn-success mt-2" id="start-speedtest-button" href="#">Start test</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
