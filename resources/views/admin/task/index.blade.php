@extends('layouts.admin')

@section('title')
    @parent
    Tasks overview
@endsection

@section('header')
    Tasks overview
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
                    @if(empty($tasks))
                        <div class="alert alert-primary">
                            <h4 class="alert-heading">Nothing here</h4>
                            No tasks
                        </div>
                    @else
                        {{ $tasks->links() }}
                        <div class="card">
                            <div class="table-responsive mb-0">
                                <table class="table table-sm table-nowrap card-table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Queue</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Wallet name</th>
                                        <th scope="col">Host name</th>
                                        <th scope="col">Storage</th>
                                        <th scope="col" colspan="2">Issued host</th>
                                        <th scope="col">Phase</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    @foreach($tasks as $task)
                                        <tr>
                                            <td><a href="{{ route('admin::tasks::show', ['task' => $task]) }}">{{ $task->id }}</a></td>
                                            <td>{{ $task->queue_id }}</td>
                                            <td>
                                                @if($task->phase_status_id === App\Models\PhaseStatus::MOVED)
                                                    <a href="{{$task->link}}">Ready</a>
                                                @else
                                                    @if($task->is_closed)
                                                        Closed
                                                    @else
                                                        Opened
                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ $task->wallet->name }}</td>
                                            <td>{{ $task->storage->host->name }}</td>
                                            <td>{{ $task->storage->path }}</td>
                                            <td>@if($task->issued_host) {{ $task->issued_host->name }} @endif</td>
                                            <td>@if($task->issued_host) {{ $task->issued_at }} @endif</td>
                                            <td>{{$task->phase_status_id}}/4</td>
                                            <td>
                                                <button class="ml-1 btn btn-sm btn-outline-danger btn-delete-tasks" type="button"
                                                        data-target="#tr-{{$task['wallet_id']}}-{{$task['storage_id']}}-{{$task['queue_id']}}" aria-expanded="false">
                                                        <i class="fe fe-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    <a class="ml-1 btn btn-sm btn-outline-info" href="{{ route('admin::tasks::create') }}">
                        <i class="fe fe-building"></i> Add Task
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/admin/tasks.js"></script>
    @csrf
@endsection
