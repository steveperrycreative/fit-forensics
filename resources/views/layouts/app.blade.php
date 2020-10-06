<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="flex h-screen overflow-hidden bg-gray-100">
    <div class="flex flex-shrink-0">
        <div class="flex flex-col w-64">

            <div class="flex flex-col flex-1 h-0 bg-blue-800">
                <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <a href="{{ url('/') }}" class="text-2xl font-semibold text-white">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    <nav class="flex-1 px-2 mt-5 space-y-1 bg-blue-800">
                        <a href="/"
                            class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-blue-900 rounded-md group focus:outline-none focus:bg-blue-700">
                            <svg class="w-6 h-6 mr-3 text-blue-400 transition duration-150 ease-in-out group-focus:text-blue-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>

                        <a href="#"
                            class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-blue-300 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700">
                            <svg class="w-6 h-6 mr-3 text-blue-400 transition duration-150 ease-in-out group-hover:text-blue-300 group-focus:text-blue-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Team
                        </a>

                        <a href="/"
                            class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-blue-300 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700">
                            <svg class="w-6 h-6 mr-3 text-blue-400 transition duration-150 ease-in-out group-hover:text-blue-300 group-focus:text-blue-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            Investigations
                        </a>

                        <a href="#"
                            class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-blue-300 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700">
                            <svg class="w-6 h-6 mr-3 text-blue-400 transition duration-150 ease-in-out group-hover:text-blue-300 group-focus:text-blue-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Calendar
                        </a>

                        <a href="#"
                            class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-blue-300 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700">
                            <svg class="w-6 h-6 mr-3 text-blue-400 transition duration-150 ease-in-out group-hover:text-blue-300 group-focus:text-blue-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            Documents
                        </a>

                        <a href="#"
                            class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-blue-300 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700">
                            <svg class="w-6 h-6 mr-3 text-blue-400 transition duration-150 ease-in-out group-hover:text-blue-300 group-focus:text-blue-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Reports
                        </a>
                    </nav>
                </div>
                <div class="flex flex-shrink-0 p-4 border-t border-blue-700">
                    <a href="#" class="flex-shrink-0 block w-full group">
                        <div class="flex items-center">
                            {{-- @guest
                                <a href="{{ route('login') }}">{{ __('Login') }}
                                </a>
                                @if(Route::has('register'))
                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                <a href="#">
                                    {{ Auth::user()->name }}
                                </a>

                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="hidden">
                                    @csrf
                                </form>
                                @endguest--}}
                            <div>
                                <img class="inline-block w-12 h-12 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium leading-5 text-white">
                                    Tom Cook
                                </p>
                                <p
                                    class="text-xs font-medium leading-4 text-blue-300 transition duration-150 ease-in-out group-hover:text-blue-100">
                                    View profile
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="flex flex-col flex-1 w-0 overflow-hidden">
        <main class="relative z-0 flex-1 overflow-y-auto focus:outline-none" tabindex="0">
            <div class="pt-2 pb-6 md:pt-6 md:pb-20">
                @yield('content')
            </div>
        </main>
    </div>
</div>

</body>
</html>
