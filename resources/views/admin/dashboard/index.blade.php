@extends('layouts.admin')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@section('title')
    @parent
    Admin Dashboard
@endsection

@section('header')
    Admin Dashboard
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
                                Adminka Dashboard
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
            <div class='row'>
                <div class='container-fluid'>
                    <div class='row'></div>
                    <div class='row'>
                        <div class='col-12'>
                            <div class='card'>
                                <div class='card-header'>
                                    <h4 class='card-header-title'>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, dolor!</h4>
                                </div>
                                <div class='card-body'>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam minus nihil odit porro praesentium quibusdam quidem quos temporibus? Fugit, ullam.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row'></div>
                </div>
            </div>
        </div>
    </div>

@endsection
