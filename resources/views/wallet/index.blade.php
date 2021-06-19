@extends('layouts.dashboard')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@section('title')
    @parent
    Wallet overview
@endsection

@section('header')
    Wallet overview
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
                <div class="col-12">
                    @if(session('success'))
                        <div class="col-md-12 alert alert-info" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if( session('error'))
                        <div class="col-md-12 alert alert-warning" role="alert">
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('wallet::create') }}" class="btn btn-outline-secondary mb-4">Add new wallet</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if(!$wallets->isEmpty())
                        <div class="card">
                            <div class="table-responsive mb-0">
                                <table class="table table-sm table-nowrap card-table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="d-none d-md-table-cell">ID</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    @foreach($wallets as $wallet)
                                        <tr>
                                            <th class="d-none d-md-table-cell" scope="row">Wallet #{{ $wallet->id }}</th>
                                            <td>{{ $wallet->name }}</td>
                                            <td>
                                                <a class="ml-1 btn btn-sm btn-outline-success" href="{{ route('wallet::update', [$wallet]) }}">
                                                    <i class="fe fe-money"></i> Edit wallet</a>
                                                <a class="ml-1 btn btn-sm btn-outline-danger" rel="nofollow"
                                                   href="#"
                                                   onclick="event.preventDefault();
                                                   if (confirm('Are you sure you want to delete wallet #{{$wallet->name}}?')) { document.getElementById('delete-wallet-{{$wallet->id}}').submit(); }">
                                                    <i class="fe fe-trash"></i>
                                                    Delete wallet
                                                </a>
                                                <form id="delete-wallet-{{$wallet->id}}" action="{{ route('wallet::delete', [$wallet]) }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
