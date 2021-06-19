@extends('layouts.admin')

@section('title')
    @parent
    Auction edit
@endsection

@section('header')
    Auction edit
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='container-fluid'>
            <div class='row'>
                @if (session('error'))
                    <div class="alert alert-success" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class='col-md-12 mb-5 mt-5 alert alert-info'>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="card col-md-12 mt-5">
                    <div class="card-body">
                        <form class="simple_form new_host" id="new_host" novalidate="novalidate"
                              action="{{ route('admin::auctions::save') }}" accept-charset="UTF-8" method="post">
                            @csrf
                            <input type="hidden" value="{{ old('auction.id') }}" name="auction[id]">
                            <div class="form-group string required auction_price">
                                <label class="string required" for="auction_price">Price<abbr title="required">*</abbr></label>
                                <input class="form-control string required @error('auction.price') is-invalid @enderror"
                                       name="auction[price]" id="auction_price" value="{{ old('auction.price') }}">
                                @error('auction.price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="submit" name="commit" value="Save" class="btn btn-primary"
                                   data-disable-with="Saving...">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
