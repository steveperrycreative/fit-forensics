@extends('layouts.app')

@section('content')

<div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8 space-y-8">

    <div class="bg-white shadow overflow-hidden mt-12 sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                File Information
            </h3>
            <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                Investigation: {{ $file->investigation->title }}
            </p>
        </div>
        <div>
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Activity
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->sport() }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Device
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $data->manufacturer() . ' ' . $data->product() }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Carved filename
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $file->name }}
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        SHA256 Hash
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $file->hash }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Original Offset
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $file->original_offset }} bytes
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Header Data
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <code class="text-xs">
                            {{ $file->header_data }}
                        </code>
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Data
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <code class="text-xs">
                            <?php var_dump($data); ?>
                        </code>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-medium text-gray-500">
                        Attachments
                    </dt>
                    <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul class="border border-gray-200 rounded-md">
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5">
                                <div class="w-0 flex-1 flex items-center">
                                    <!-- Heroicon name: paper-clip -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">
                                      {{ $file->name }}
                                    </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                                        Download
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </div>
            </dl>
        </div>
    </div>


</div>

@endsection
