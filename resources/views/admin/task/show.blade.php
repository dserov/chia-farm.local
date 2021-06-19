@extends('layouts.admin')

@section('title')
    @parent
    Task view
@endsection

@section('header')
    Task view
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
                        <div class="form-group string required task_id">
                            <label class="string required" for="task_id">ID</label>
                            <input class="form-control string required" name="task_id" id="task_id" value="{{ $task->id }}">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group string required queue_id">
                            <label class="string required" for="queue_id">Queue ID</label>
                            <input class="form-control string required" name="queue_id" id="queue_id" value="{{ $task->queue_id }}">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group string required is_closed">
                            <label class="string required" for="is_closed">Status</label>
                            @if($task->phase_status_id === App\Models\PhaseStatus::MOVED)
                                <br><a class="form-control string required" href="{{$task->link}}">Ready</a>
                            @else
                                <input class="form-control string required" name="is_closed" id="is_closed" value="@if($task->is_closed)Closed @else Opened @endif">
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group string required wallet_name">
                            <label class="string required" for="wallet_name">Wallet name</label>
                            <input class="form-control string required" name="wallet_name" id="wallet_name" value="{{ $task->wallet->name }}">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group string required host_name">
                            <label class="string required" for="host_name">Host name</label>
                            <input class="form-control string required" name="host_name" id="host_name" value="{{ $task->storage->host->name }}">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group string required storage_path">
                            <label class="string required" for="storage_path">Storage</label>
                            <input class="form-control string required" name="storage_path" id="storage_path" value="{{ $task->storage->path }}">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group string required issued_host_name">
                            <label class="string required" for="issued_host_name">Issued host</label>
                            <input class="form-control string required" name="issued_host_name" id="issued_host_name" value="@if($task->issued_host) {{ $task->issued_host->name }} @endif">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group string required issued_at">
                            <label class="string required" for="issued_at">Issued at</label>
                            <input class="form-control string required" name="issued_at" id="issued_at" value="@if($task->issued_host) {{ $task->issued_at }} @endif">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group string required phase_status_id">
                            <label class="string required" for="phase_status_id">Phase</label>
                            <input class="form-control string required" name="phase_status_id" id="phase_status_id" value="{{$task->phase_status_id}}/4">
                        </div>
                    </div>
                    @if($task->last_error)
                        <div class="card-body">
                            <div class="form-group string required last_error">
                                <label class="string required" for="last_error">Last Error</label>
                                <input class="form-control string required is-invalid" name="last_error" id="last_error" value="{{$task->last_error}}">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
