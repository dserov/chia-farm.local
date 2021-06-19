@extends('layouts.auth')

@section('content')
    <h1 class='display-4 text-center mb-3'>{{ __('Sign up') }}</h1>
    <form class="simple_form new_user" id="new_user" novalidate="novalidate" action="{{ route('register') }}"
          accept-charset="UTF-8" method="post">
        @csrf
        <div class='form-inputs'>
            <div class="form-group email required user_email">
                <input class="form-control string email required @error('email') is-invalid @enderror"
                       autocomplete="email" autofocus="autofocus"
                       required="required" aria-required="true"
                       placeholder="Email" type="email" value="{{ old('email') }}"
                       name="email" id="user_email"/>
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group password required user_password">
                <input class="form-control password required @error('password') is-invalid @enderror"
                       autocomplete="new-password"
                       required="required" aria-required="true"
                       placeholder="Password" type="password"
                       name="password" id="password"/>
                <small class="form-text text-muted">8 characters minimum</small>
                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group password required user_password_confirmation @error('password_confirmation') is-invalid @enderror">
                <input
                        class="form-control password required" autocomplete="new-password" required="required"
                        aria-required="true" placeholder="Type your password again" type="password"
                        name="password_confirmation" id="user_password_confirmation"/>
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class='form-actions'>
            <input type="submit" name="commit" value="{{ __('Sign up') }}" class="btn btn btn-primary"
                   data-disable-with="Registering"/>
        </div>
    </form><a href="/login">Log in</a>
@endsection
