@extends('layouts.app')

@section('content')
<div>
    <h1>{{ __('Reset Password') }}</h1>

    @if (session('status'))
        <div role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label for="email">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="@error('email') some-error-class @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <button type="submit">
            {{ __('Send Password Reset Link') }}
        </button>
    </form>
</div>
@endsection
