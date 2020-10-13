@props(['team', 'component' => 'jet-dropdown-link'])

<form method="POST" action="{{ route('current-team.update') }}">
    @method('PUT')
    @csrf

    <!-- Hidden Team ID -->
    <input type="hidden" name="team_id" value="{{ $team->id }}">

    <a href="#"
        class="text-blue-300 flex items-center px-2 py-2 text-sm font-medium leading-5 text-blue-300 transition duration-150 ease-in-out rounded-md group hover:text-white hover:bg-blue-700 focus:outline-none focus:text-white focus:bg-blue-700"
        onclick="event.preventDefault(); this.closest('form').submit();">
        <div class="flex items-center">
            @if (Auth::user()->isCurrentTeam($team))
                <svg class="mr-2 h-5 w-5 text-blue-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            @endif

            <div class="truncate">{{ $team->name }}</div>
        </div>
    </a>
</form>
