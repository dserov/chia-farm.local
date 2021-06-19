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
                                Plots for order #{{$order->id}}

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
                <div class="col-md-6 col-sm-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- Title -->
                                    <h6 class="text-uppercase text-muted mb-2">
                                        Order price
                                    </h6>
                                    <!-- Heading -->
                                    <span class="h2 mb-0">
                                    ${{ number_format($order->price * $order->plot_amount, 2) }}
                                    </span>
                                </div>
                                <div class="col-auto">
                                    @if(
                                        $order->status_id != \App\Models\Status::PAYED &&
                                        $order->status_id != \App\Models\Status::PLOT_READY &&
                                        $order->status_id != \App\Models\Status::PLOT_QUEUED
                                    )
                                        <a class="ml-1 btn btn-sm btn-outline-success" data-confirm="Refunds are not possible are you sure you want to continue paying?"
                                           href="{{ route('orders::pay', [$order]) }}">
                                            <i class="fe fe-money"></i> Pay with Crypto</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xl-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <!-- Title -->
                                    <h6 class="text-uppercase text-muted mb-2">
                                        Plots completed
                                    </h6>
                                    <!-- Heading -->
                                    <span class="h2 mb-0">
                                        {{$order->plot_completed}}/{{$order->plot_amount}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="table table-responsive-sm">
                            <table class="table table-sm table-nowrap card-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Plot Phase</th>
                                    <th>
                                        <span class="float-right">Actions</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <th scope="row">Plot #{{$task->id}}</th>
                                        <td>
                                            <div class="badge badge-soft-warning">
                                                @if($task->phase_status_id == \App\Models\PhaseStatus::MOVED)
                                                    Completed
                                                @else
                                                    @if($task->issued_host_id == 0)
                                                        Waiting in queue
                                                    @else
                                                        In progress
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if($task->phase_status_id == \App\Models\PhaseStatus::MOVED)
                                                4/4
                                            @else
                                                {{$task->phase_status_id ?? 0}}/4
                                            @endif
                                        </td>
                                        <td>
                                            <span class="float-right">
                                                @if($task->phase_status_id == \App\Models\PhaseStatus::MOVED)
                                                    <a href="{{$task->link}}">Download</a>
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12 col-xxl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="list-group list-group-flush my-n3">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h5 class="mb-0">
                                                Order created at
                                            </h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="small text-muted">
                                                {{$order->created_at}}
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
    </div>
@endsection
