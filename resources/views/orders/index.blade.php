@extends('layouts.dashboard')

@section('title')
    @parent
    Order overview
@endsection

@section('header')
    Order overview
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
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ route('orders::new', [0]) }}">New Order</a>
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
                @if(session('error'))
                    <div class='col-md-12 mb-5 mt-5 alert alert-warning'>
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    @if($orders->isEmpty())
                        <div class="alert alert-primary">
                            <h4 class="alert-heading">Nothing here</h4>
                            Seems you have no orders yet, why not create some now?
                        </div>
                    @else
                        <div class="card">
                            <div class="table-responsive mb-0">
                                <table class="table table-sm table-nowrap card-table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="d-none d-md-table-cell">ID</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th class="d-none d-xl-table-cell">Plots completed</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    @foreach($orders as $order)
                                        <tr>
                                            <th class="d-none d-md-table-cell" scope="row">Order #{{ $order->id }}</th>
                                            <td>${{ number_format($order->price * $order->plot_amount, 2) }}</td>
                                            <td>{{ $order->status->name }}</td>
                                            <td class="d-none d-xl-table-cell">{{$order->plot_completed}}/{{$order->plot_amount}}</td>
                                            <td>
                                                <a class="btn btn-white btn-sm" href="{{ route('orders::show', ['order' => $order]) }}">Show details</a>
                                                @if($order->status_id == \App\Models\Status::PAYED)
                                                    <a class="ml-1 btn btn-sm btn-outline-info" href="{{route('plots::create', [ 'order_id' => $order->id ])}}">
                                                        <i class="fe fe-wallet"></i> Make plot
                                                    </a>
                                                @endif
                                                @if(
                                                    $order->status_id != \App\Models\Status::PAYED &&
                                                    $order->status_id != \App\Models\Status::PLOT_READY &&
                                                    $order->status_id != \App\Models\Status::PLOT_QUEUED
                                                    )
                                                    <a class="ml-1 btn btn-sm btn-outline-success"
                                                       href="{{ route('orders::pay', ['order' => $order]) }}">
                                                        <i class="fe fe-money"></i> Pay with Crypto</a>
                                                    <a class="ml-1 btn btn-sm btn-outline-danger" rel="nofollow"
                                                       href="#"
                                                       onclick="event.preventDefault();
                                                       if (confirm('Are you sure you want to delete order #{{$order->id}}?')) { document.getElementById('delete-order-{{$order->id}}').submit(); }">
                                                        <i class="fe fe-trash"></i>
                                                        Delete order
                                                    </a>
                                                    <form id="delete-order-{{$order->id}}" action="{{ route('orders::delete', ['order' => $order]) }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                @endif
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
