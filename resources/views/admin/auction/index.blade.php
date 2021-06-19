@extends('layouts.admin')

@section('title')
    @parent
    Auctions overview
@endsection

@section('header')
    Auctions overview
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
                @if(session('error'))
                    <div class='col-md-12 mb-5 mt-5 alert alert-info'>
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    @if($auctions->isEmpty())
                        <div class="alert alert-primary">
                            <h4 class="alert-heading">Nothing here</h4>
                            No auctions
                        </div>
                    @else
                        {{ $auctions->links() }}
                        <div class="card">
                            <div class="table-responsive mb-0">
                                <table class="table table-sm table-nowrap card-table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    @foreach($auctions as $auction)
                                        <tr>
                                            <td>{{ $auction->id }}</td>
                                            <td>{{ $auction->price }}</td>
                                            <td>
                                                <a class="ml-1 btn btn-sm btn-outline-info" href="{{ route('admin::auctions::update', ['auction' => $auction]) }}">
                                                    <i class="fe fe-edit"></i>
                                                </a>
                                                <a class="ml-1 btn btn-sm btn-outline-danger" rel="nofollow" href="#" onclick="event.preventDefault();
                                                if (confirm('Are you sure you want to delete auction #{{ $auction->id }}?')) { document.getElementById('delete-auction-{{ $auction->id }}').submit(); }">
                                                    <i class="fe fe-trash"></i>
                                                </a>
                                                <form id="delete-auction-{{ $auction->id }}" action="{{ route('admin::auctions::delete', [$auction]) }}" method="POST" class="d-none">
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
                    <a class="ml-1 btn btn-sm btn-outline-info" href="{{ route('admin::auctions::create') }}">
                        <i class="fe fe-building"></i> Add auction
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
