@extends('layouts.admin')

@section('title')
    @parent
    Task edit
@endsection

@section('header')
    Task edit
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
                              action="{{ route('admin::tasks::save') }}" accept-charset="UTF-8" method="post">
                            @csrf
                            <div class="form-group string wallet_id">
                                <label class="string" for="wallet_id">Wallet<abbr title="required">*</abbr></label>
                                <select class="form-control string @error('wallet_id') is-invalid @enderror"
                                       name="wallet_id" id="wallet_id">
                                    <option value=""></option>
                                    @foreach($wallets as $wallet)
                                        <option value="{{$wallet->id}}" @if($wallet->id == old('wallet_id')) selected @endif >{{ $wallet->name }} ({{ $wallet->user->name }})</option>
                                    @endforeach
                                </select>
                                @error('wallet_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group string host_id">
                                <label class="string" for="host_id">Host<abbr title="required">*</abbr></label>
                                <select class="form-control string @error('host_id') is-invalid @enderror"
                                       name="host_id" id="host_id">
                                </select>
                                @error('host_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group string storage_id">
                                <label class="string" for="storage_id">Storage<abbr title="required">*</abbr></label>
                                <select class="form-control string @error('storage_id') is-invalid @enderror"
                                       name="storage_id" id="storage_id">
                                </select>
                                @error('storage_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group string required queue_id">
                                <label class="string required" for="queue_id">Queue ID <abbr title="required">*</abbr></label>
                                <input class="form-control string required @error('queue_id') is-invalid @enderror"
                                       name="queue_id" id="queue_id" value="{{ old('queue_id') }}">
                                @error('queue_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group string required tasks_count">
                                <label class="string required" for="tasks_count">Need tasks count</label>
                                <input class="form-control string required @error('tasks_count') is-invalid @enderror"
                                       name="tasks_count" id="tasks_count" value="{{ old('tasks_count') }}">
                                @error('tasks_count')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="submit" name="commit" value="Create tasks" class="btn btn-primary"
                                   data-disable-with="Creating...">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/admin/tasks.js"></script>
@endsection
