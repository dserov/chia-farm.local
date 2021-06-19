@extends('layouts.auth')

@section('content')
    <h1 class='display-4 text-center mb-3'>Log in</h1>
    <form class="simple_form new_user" id="new_user" novalidate="novalidate" action="{{ route('login') }}"
          accept-charset="UTF-8" method="post">
        @csrf
        <div class='form-inputs'>
            <div class="form-group email optional user_email">
                <label class="email optional"
                       for="user_email">Email</label>
                <input class="form-control string email optional @error('email') is-invalid @enderror"
                       autocomplete="email" autofocus="autofocus"
                       type="email" value="{{ old('email') }}" name="email" id="user_email"/>
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group password optional user_password">
                <label class="password optional"
                       for="user_password">Password</label>
                <input
                        class="form-control password optional @error('password') is-invalid @enderror"
                        autocomplete="current-password" type="password"
                        name="password" id="user_password"/>
                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <fieldset class="form-group boolean optional user_remember_me">
                <div class="form-check">
                    <input name="remember" type="hidden" value="0"/>
                    <input class="form-check-input boolean optional" type="checkbox" value="1" name="remember"
                           id="user_remember" {{ old('remember') ? 'checked' : '' }}/>
                    <label class="form-check-label boolean optional"
                           for="user_remember">Remember me</label>
                </div>
            </fieldset>
        </div>
        <div class='form-actions'>
            <input type="submit" name="commit" value="Log in" class="btn btn btn-primary" data-disable-with="Log in"/>
        </div>
    </form><a href="{{ route('register') }}">Sign up</a>
    <br>
    @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
        </a>
    @endif
@endsection
