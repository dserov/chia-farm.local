@extends('layouts.dashboard')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@section('title')
    @parent
    Dashboard
@endsection

@section('header')
    Dashboard
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
                                Ready to Download
                            </h1>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-primary" href="{{ route('plots::text') }}">Download links as text</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
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
                            <h4 class="alert-heading">Too bad...</h4>
                            Nothing is ready yet, check back later.
                        </div>
                    @else
                        <table class="table table-sm table-nowrap card-table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Link</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{$task->id}}</td>
                                        <td>
                                            <a href="{{$task->link}}">Download</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
