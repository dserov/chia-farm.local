@extends('layouts.auth')

@section('content')
    <h2>Forgot your password?</h2>
    @if (session('status'))
        <div class="col-md-12 mb-5 mt-5 alert alert-info">
            {{ session('status') }}
            You will receive an email with instructions on how to reset your password in a few minutes.
        </div>
    @endif
    <form class="simple_form new_user" id="new_user" novalidate="novalidate" action="{{ route('password.email') }}"
          accept-charset="UTF-8" method="post">
        @csrf
        <div class='form-inputs'>
            <div class="form-group email required user_email">
                <label class="email required" for="user_email">Email <abbr
                            title="required">*</abbr></label>
                <input class="form-control string email required @error('email') is-invalid @enderror"
                       autocomplete="email" autofocus="autofocus"
                       required="required" aria-required="true"
                       type="email" value="{{ old('email') }}" name="email"
                       id="user_email"/>
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class='form-actions'>
            <input type="submit" name="commit" value="Send me reset password instructions" class="btn btn btn-primary"
                   data-disable-with="Send me reset password instructions"/>
        </div>
    </form><a href="{{ route('login') }}">Log in</a>
    <br>
    <a href="{{ route('register') }}">Sign up</a>
@endsection
