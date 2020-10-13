<x-jet-form-section submit="createInvestigation">
    <x-slot name="title">
        {{ __('Investigation Details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Use your current team to create a new investigation.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <x-jet-label value="{{ __('Current Team') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}">

                <div class="ml-4 leading-tight">
                    <div>{{ $this->team->name }}</div>
                    <div class="text-gray-700 text-sm">{{ $this->user->email }}</div>
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="title" value="{{ __('Investigation Title') }}" />
            <x-jet-input id="title" type="text" class="mt-1 block w-full" wire:model="title" autofocus />
            <x-jet-input-error for="title" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="notes" value="{{ __('Notes') }}" />
            <x-jet-input id="notes" type="text" class="mt-1 block w-full" wire:model="notes" />
            <x-jet-input-error for="notes" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="image" value="{{ __('Disk Image') }}" />
            <x-jet-input id="image" type="text" class="mt-1 block w-full" wire:model="image" />
            <x-jet-input-error for="image" class="mt-2" />
            <p class="mt-2 text-sm text-gray-500">
                Copy your disk image to <span class="font-mono text-xs text-indigo-800">/storage/app/disk_images/</span> and enter the filename above, for example image.dd.
            </p>
        </div>

        @if(session('success_message'))
            <div class="col-span-6 sm:col-span-4">
                <div class="rounded-md bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: check-circle -->
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm leading-5 font-medium text-green-800">
                                Investigation created
                            </h3>
                            <div class="mt-2 text-sm leading-5 text-green-700">
                                <p>
                                    View your new investigation <a href="/investigations/{{ $investigation->id }}" class="underline">here</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </x-slot>

    <x-slot name="actions">
        <x-jet-button>
            {{ __('Create') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
