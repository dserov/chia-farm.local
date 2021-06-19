@extends('layouts.admin')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@section('title')
    @parent
    Host edit
@endsection

@section('header')
    Host edit
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
                              action="{{ route('admin::hosts::save') }}" accept-charset="UTF-8" method="post">
                            @csrf
                            <input type="hidden" value="{{ old('host.id') }}" name="host[id]">
                            <div class="form-group string required host_name">
                                <label class="string required" for="host_name">Hostname<abbr title="required">*</abbr></label>
                                <input class="form-control string required @error('host.name') is-invalid @enderror"
                                       name="host[name]" id="host_name" value="{{ old('host.name') }}">
                                @error('host.name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group string required host_ip">
                                <label class="string required" for="host_ip">Ip address <abbr title="required">*</abbr></label>
                                <input class="form-control string required @error('host.ip') is-invalid @enderror"
                                       name="host[ip]" id="host_ip" value="{{ old('host.ip') }}">
                                @error('host.ip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group string host_type">
                                <label class="string" for="host_type">Role <abbr title="required">*</abbr></label>
                                <select class="form-control string @error('host.type') is-invalid @enderror"
                                       name="host[type]" id="host_type">
                                    @foreach($hostTypes as $hostType)
                                        <option value="{{$hostType}}" @if($hostType == old('host.type')) selected @endif >{{$hostType}}</option>
                                    @endforeach
                                </select>
                                @error('host.type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group string host_wallet_id">
                                <label class="string" for="host_wallet_id">Wallet</label>
                                <select class="form-control string @error('host.wallet_id') is-invalid @enderror"
                                       name="host[wallet_id]" id="host_wallet_id">
                                    <option value=""></option>
                                    @foreach($wallets as $wallet)
                                        <option value="{{$wallet->id}}" @if($wallet->id == old('host.wallet_id')) selected @endif >{{$wallet->name}}</option>
                                    @endforeach
                                </select>
                                @error('host.wallet_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group string required host_plots_count">
                                <label class="string required" for="host_plots_count">Max plots count</label>
                                <input class="form-control string required @error('host.plots_count') is-invalid @enderror"
                                       name="host[plots_count]" id="host_plots_count" value="{{ old('host.plots_count') }}">
                                @error('host.plots_count')
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
