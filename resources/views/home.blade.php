@extends('layouts.app')

@section('content')
<div>

    <header class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        <h1 class="text-2xl font-semibold text-gray-900">{{ __('Dashboard') }}</h1>
    </header>

    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
        @if (session('status'))
            <div>
                {{ session('status') }}
            </div>
        @endif

        {{ __('You are logged in!') }}
    </div>
    
</div>
@endsection
