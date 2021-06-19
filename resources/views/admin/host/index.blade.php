@extends('layouts.admin')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@section('title')
    @parent
    Hosts overview
@endsection

@section('header')
    Hosts overview
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
                <div class="col-12">
                    @if($hosts->isEmpty())
                        <div class="alert alert-primary">
                            <h4 class="alert-heading">Nothing here</h4>
                            No hosts
                        </div>
                    @else
                        {{ $hosts->links() }}
                        <div class="card">
                            <div class="table-responsive mb-0">
                                <table class="table table-sm table-nowrap card-table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Ip</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Max plots</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">&nbsp;</th>
                                        <th scope="col">Tmp Free</th>
                                        <th scope="col">Plot Free</th>
                                        <th scope="col">Storage Free</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    @foreach($hosts as $host)
                                        <tr>
                                            <td>{{ $host->name }}</td>
                                            <td>{{ $host->ip }}</td>
                                            <td>{{ $host->type }}</td>
                                            <td>{{ $host->plots_count }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a class="ml-1 btn btn-sm btn-outline-info" href="{{ route('admin::hosts::update', [ 'host' => $host]) }}">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <a class="ml-1 btn btn-sm btn-outline-danger" rel="nofollow" href="#" onclick="event.preventDefault();
                                                if (confirm('Are you sure you want to delete host #{{ $host->name }}?')) { document.getElementById('delete-host-{{ $host->id }}').submit(); }">
                                                    <i class="fe fe-trash"></i>
                                                </a>
                                                <form id="delete-host-{{ $host->id }}" action="{{ route('admin::hosts::delete', [ 'host' => $host]) }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                                <a class="ml-1 btn btn-sm btn-outline-info btn-show-storages" href="#">
                                                    <i class="fe fe-building"></i>
                                                </a>
                                                <div class="storages-container p-3 btn-sm">
                                                    @foreach($host->storages as $storage)
                                                        <span>{{$storage->path}}</span>:&nbsp;&nbsp;<span>{{ \App\Helpers\HumanReadable::formatBytes($storage->free_size * 1024 * 1024 * 1024)}}</span>
                                                        <br>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>{{ \App\Helpers\HumanReadable::formatBytes($host->tmp_free * 1024 * 1024 * 1024) }}</td>
                                            <td>{{ \App\Helpers\HumanReadable::formatBytes($host->plot_free * 1024 * 1024 * 1024) }}</td>
                                            <td>{{ \App\Helpers\HumanReadable::formatBytes($host->storages->sum('free_size') * 1024 * 1024 * 1024) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    <a class="ml-1 btn btn-sm btn-outline-info" href="{{ route('admin::hosts::create') }}">
                        <i class="fe fe-building"></i> Add host
                    </a>
                </div>
            </div>
        </div>
    </div>
    <style>
        .btn-show-storages:hover + .storages-container {
            display: block;
        }
        .storages-container:hover {
            display: block;
        }
        .storages-container {
            display: none;
            width: 150px;
            position: absolute;
            background-color: #0a1421;
        }
    </style>
@endsection
