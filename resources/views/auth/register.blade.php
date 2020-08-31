@extends('layouts.app')

@section('content')
<div>
    <h1>{{ __('Register') }}</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">{{ __('Name') }}</label>
        <input id="name" type="text" class="@error('name') some-error-class @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="email">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="@error('email') some-error-class @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="@error('password') some-error-class @enderror" name="password" required autocomplete="new-password">

        @error('password')
            <span role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="password-confirm">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">

        <button type="submit">
            {{ __('Register') }}
        </button>
    </form>
</div>
@endsection
