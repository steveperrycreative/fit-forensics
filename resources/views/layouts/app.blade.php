<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    </head>

    <body>

    <div class="flex h-screen overflow-hidden bg-gray-100">
        <div class="flex flex-shrink-0">
            <div class="flex flex-col w-64">

                <div class="flex flex-col flex-1 h-0 bg-blue-800">
                    <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
                        <div class="flex items-center flex-shrink-0 px-4">
                            <a href="{{ url('/investigations') }}" class="text-2xl font-light text-white flex items-center space-x-1">
                                <svg class="w-16 h-16 fill-current" viewBox="0 0 24 24"><path d="M17.81 4.47c-.08 0-.16-.02-.23-.06C15.66 3.42 14 3 12.01 3c-1.98 0-3.86.47-5.57 1.41-.24.13-.54.04-.68-.2-.13-.24-.04-.55.2-.68C7.82 2.52 9.86 2 12.01 2c2.13 0 3.99.47 6.03 1.52.25.13.34.43.21.67-.09.18-.26.28-.44.28zM3.5 9.72c-.1 0-.2-.03-.29-.09-.23-.16-.28-.47-.12-.7.99-1.4 2.25-2.5 3.75-3.27C9.98 4.04 14 4.03 17.15 5.65c1.5.77 2.76 1.86 3.75 3.25.16.22.11.54-.12.7-.23.16-.54.11-.7-.12-.9-1.26-2.04-2.25-3.39-2.94-2.87-1.47-6.54-1.47-9.4.01-1.36.7-2.5 1.7-3.4 2.96-.08.14-.23.21-.39.21zm6.25 12.07c-.13 0-.26-.05-.35-.15-.87-.87-1.34-1.43-2.01-2.64-.69-1.23-1.05-2.73-1.05-4.34 0-2.97 2.54-5.39 5.66-5.39s5.66 2.42 5.66 5.39c0 .28-.22.5-.5.5s-.5-.22-.5-.5c0-2.42-2.09-4.39-4.66-4.39-2.57 0-4.66 1.97-4.66 4.39 0 1.44.32 2.77.93 3.85.64 1.15 1.08 1.64 1.85 2.42.19.2.19.51 0 .71-.11.1-.24.15-.37.15zm7.17-1.85c-1.19 0-2.24-.3-3.1-.89-1.49-1.01-2.38-2.65-2.38-4.39 0-.28.22-.5.5-.5s.5.22.5.5c0 1.41.72 2.74 1.94 3.56.71.48 1.54.71 2.54.71.24 0 .64-.03 1.04-.1.27-.05.53.13.58.41.05.27-.13.53-.41.58-.57.11-1.07.12-1.21.12zM14.91 22c-.04 0-.09-.01-.13-.02-1.59-.44-2.63-1.03-3.72-2.1-1.4-1.39-2.17-3.24-2.17-5.22 0-1.62 1.38-2.94 3.08-2.94 1.7 0 3.08 1.32 3.08 2.94 0 1.07.93 1.94 2.08 1.94s2.08-.87 2.08-1.94c0-3.77-3.25-6.83-7.25-6.83-2.84 0-5.44 1.58-6.61 4.03-.39.81-.59 1.76-.59 2.8 0 .78.07 2.01.67 3.61.1.26-.03.55-.29.64-.26.1-.55-.04-.64-.29-.49-1.31-.73-2.61-.73-3.96 0-1.2.23-2.29.68-3.24 1.33-2.79 4.28-4.6 7.51-4.6 4.55 0 8.25 3.51 8.25 7.83 0 1.62-1.38 2.94-3.08 2.94s-3.08-1.32-3.08-2.94c0-1.07-.93-1.94-2.08-1.94s-2.08.87-2.08 1.94c0 1.71.66 3.31 1.87 4.51.95.94 1.86 1.46 3.27 1.85.27.07.42.35.35.61-.05.23-.26.38-.47.38z"></path><path fill="none" d="M0 0h24v24H0z"></path></svg>
                                <span>{{ config('app.name', 'Laravel') }}</span>
                            </a>
                        </div>
                        <nav class="flex-1 px-2 mt-5 space-y-1 bg-blue-800">
                            <a href="/dashboard"
                                class="text-blue-300 flex items-center px-2 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700">
                                <svg class="w-6 h-6 fill-current mr-3 text-blue-400 transition duration-150 ease-in-out group-focus:text-blue-300" viewBox="0 0 576 512"><path d="M570.24 247.41L323.87 45a56.06 56.06 0 0 0-71.74 0L5.76 247.41a16 16 0 0 0-2 22.54L14 282.25a16 16 0 0 0 22.53 2L64 261.69V448a32.09 32.09 0 0 0 32 32h128a32.09 32.09 0 0 0 32-32V344h64v104a32.09 32.09 0 0 0 32 32h128a32.07 32.07 0 0 0 32-31.76V261.67l27.53 22.62a16 16 0 0 0 22.53-2L572.29 270a16 16 0 0 0-2.05-22.59zM463.85 432H368V328a32.09 32.09 0 0 0-32-32h-96a32.09 32.09 0 0 0-32 32v104h-96V222.27L288 77.65l176 144.56z"></path></svg>
                                Dashboard
                            </a>

                            <a href="/investigations"
                                class="text-blue-300 fill-current flex items-center px-2 py-2 text-sm font-medium leading-5 text-blue-300 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700">
                                <svg class="w-6 h-6 mr-3 text-blue-400 transition duration-150 ease-in-out group-hover:text-blue-300 group-focus:text-blue-300" viewBox="0 0 512 512"><path d="M464 128H272l-54.63-54.63c-6-6-14.14-9.37-22.63-9.37H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V176c0-26.51-21.49-48-48-48zm0 272H48V112h140.12l54.63 54.63c6 6 14.14 9.37 22.63 9.37H464v224z"></path></svg>
                                Investigations
                            </a>

                            <a href="/investigations/create"
                                class="text-blue-300 flex items-center px-2 py-2 text-sm font-medium leading-5 text-blue-300 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700">
                                <svg class="w-6 h-6 mr-3 fill-current text-blue-400 transition duration-150 ease-in-out group-hover:text-blue-300 group-focus:text-blue-300" viewBox="0 0 512 512"><path d="M464,128H272L217.37,73.37A32,32,0,0,0,194.74,64H48A48,48,0,0,0,0,112V400a48,48,0,0,0,48,48H464a48,48,0,0,0,48-48V176A48,48,0,0,0,464,128Zm0,272H48V112H188.12l54.63,54.63A32,32,0,0,0,265.38,176H464ZM247.5,208a16,16,0,0,0-16,16v40H192a16,16,0,0,0-16,16v16a16,16,0,0,0,16,16h39.5v40a16,16,0,0,0,16,16h16a16,16,0,0,0,16-16V312H320a16,16,0,0,0,16-16V280a16,16,0,0,0-16-16H279.5V224a16,16,0,0,0-16-16Z"></path></svg>
                                New Investigation
                            </a>

                            <div class="border-t border-blue-700 -mx-2"></div>

                            <a href="/teams/{{ Auth::user()->currentTeam->id }}"
                                class="text-blue-300 flex items-center px-2 py-2 text-sm font-medium leading-5 text-blue-300 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700">
                                <svg class="w-6 h-6 fill-current mr-3 text-blue-400 transition duration-150 ease-in-out group-hover:text-blue-300 group-focus:text-blue-300" viewBox="0 0 640 512"><path d="M544 224c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80zm0-112c17.6 0 32 14.4 32 32s-14.4 32-32 32-32-14.4-32-32 14.4-32 32-32zM96 224c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80zm0-112c17.6 0 32 14.4 32 32s-14.4 32-32 32-32-14.4-32-32 14.4-32 32-32zm396.4 210.9c-27.5-40.8-80.7-56-127.8-41.7-14.2 4.3-29.1 6.7-44.7 6.7s-30.5-2.4-44.7-6.7c-47.1-14.3-100.3.8-127.8 41.7-12.4 18.4-19.6 40.5-19.6 64.3V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-44.8c.2-23.8-7-45.9-19.4-64.3zM464 432H176v-44.8c0-36.4 29.2-66.2 65.4-67.2 25.5 10.6 51.9 16 78.6 16 26.7 0 53.1-5.4 78.6-16 36.2 1 65.4 30.7 65.4 67.2V432zm92-176h-24c-17.3 0-33.4 5.3-46.8 14.3 13.4 10.1 25.2 22.2 34.4 36.2 3.9-1.4 8-2.5 12.3-2.5h24c19.8 0 36 16.2 36 36 0 13.2 10.8 24 24 24s24-10.8 24-24c.1-46.3-37.6-84-83.9-84zm-236 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm0-176c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64 28.7-64 64-64zM154.8 270.3c-13.4-9-29.5-14.3-46.8-14.3H84c-46.3 0-84 37.7-84 84 0 13.2 10.8 24 24 24s24-10.8 24-24c0-19.8 16.2-36 36-36h24c4.4 0 8.5 1.1 12.3 2.5 9.3-14 21.1-26.1 34.5-36.2z"></path></svg>
                                Team
                            </a>

                            <a href="/teams/create"
                                class="text-blue-300 flex items-center px-2 py-2 text-sm font-medium leading-5 text-blue-300 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700">
                                <svg class="w-6 h-6 mr-3 fill-current text-blue-400 transition duration-150 ease-in-out group-hover:text-blue-300 group-focus:text-blue-300" viewBox="0 0 640 512"><path d="M512 224a128 128 0 1 0 128 128 128 128 0 0 0-128-128zm64 144a5.33 5.33 0 0 1-5.33 5.33h-37.34v37.34A5.33 5.33 0 0 1 528 416h-32a5.33 5.33 0 0 1-5.33-5.33v-37.34h-37.34A5.33 5.33 0 0 1 448 368v-32a5.33 5.33 0 0 1 5.33-5.33h37.34v-37.34A5.33 5.33 0 0 1 496 288h32a5.33 5.33 0 0 1 5.33 5.33v37.34h37.34A5.33 5.33 0 0 1 576 336zM320 256a112 112 0 1 0-112-112 111.94 111.94 0 0 0 112 112zm0-176a64 64 0 1 1-64 64 64.06 64.06 0 0 1 64-64zM96 224a80 80 0 1 0-80-80 80 80 0 0 0 80 80zm0-112a32 32 0 1 1-32 32 32.09 32.09 0 0 1 32-32zm278.26 320H176v-44.8a67.38 67.38 0 0 1 65.4-67.2 203.8 203.8 0 0 0 78.6 16 198.4 198.4 0 0 0 33.94-3.14 157.56 157.56 0 0 1 16-52.84c-1.76.45-3.56.65-5.3 1.18a152.46 152.46 0 0 1-89.4 0c-47.1-14.3-100.3.8-127.8 41.7a114.59 114.59 0 0 0-19.6 64.3V432a48 48 0 0 0 48 48H417a160.27 160.27 0 0 1-42.74-48zM154.8 270.3A83.7 83.7 0 0 0 108 256H84a84.12 84.12 0 0 0-84 84 24 24 0 0 0 48 0 36.11 36.11 0 0 1 36-36h24a35.48 35.48 0 0 1 12.3 2.5 148.37 148.37 0 0 1 34.5-36.2z"></path></svg>
                                New Team
                            </a>

                            <div class="border-t border-blue-700 -mx-2"></div>

                            <!-- Team Switcher -->
                            <div class="block px-2 py-2 text-blue-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                            @endforeach

                            <div class="border-t border-blue-700 -mx-2"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}"
                                    class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-blue-300 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="w-6 h-6 mr-3 fill-current text-blue-400 transition duration-150 ease-in-out group-hover:text-blue-300 group-focus:text-blue-300" viewBox="0 0 512 512"><path d="M96 64h84c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12H96c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h84c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12H96c-53 0-96-43-96-96V160c0-53 43-96 96-96zm231.1 19.5l-19.6 19.6c-4.8 4.8-4.7 12.5.2 17.1L420.8 230H172c-6.6 0-12 5.4-12 12v28c0 6.6 5.4 12 12 12h248.8L307.7 391.7c-4.8 4.7-4.9 12.4-.2 17.1l19.6 19.6c4.7 4.7 12.3 4.7 17 0l164.4-164c4.7-4.7 4.7-12.3 0-17l-164.4-164c-4.7-4.6-12.3-4.6-17 .1z"></path></svg>
                                    {{ __('Logout') }}
                                </a>
                            </form>

                        </nav>
                    </div>

                    <div class="flex flex-shrink-0 p-4 border-t border-blue-700">
                        <a href="/user/profile" class="flex-shrink-0 block w-full group">
                            <div class="flex items-center">
                                <div>
                                    <img class="inline-block w-12 h-12 rounded-full border border-white"
                                        src="https://secure.gravatar.com/avatar/ea2b2aef55fd5d08091e4c03b5adabce"
                                        alt="">
                                </div>
                                <div class="ml-3 relative">
                                    <p class="text-sm font-medium leading-5 text-white">
                                        Steve Perry
                                    </p>
                                    <p class="text-xs font-medium leading-4 text-blue-300 transition duration-150 ease-in-out group-hover:text-blue-100">
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
                    @if (isset($slot))
                        {{ $slot }}
                    @endif
                    @yield('content')
                </div>
            </main>
        </div>
    </div>


{{--        @livewire('navigation-dropdown')--}}

{{--        @stack('modals')--}}
        @livewireScripts
    </body>

</html>
