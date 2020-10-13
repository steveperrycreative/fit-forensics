@extends('layouts.app')

@section('content')

<div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8 space-y-8">

    <header class="space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">{{ $investigation->title }}</h1>
            <div class="flex space-x-4">
                <a href="/investigations/{{ $investigation->id }}/search" class="bg-orange-800 text-orange-100 text-sm rounded px-4 py-2">Search for files</a>
                <a href="/investigations/{{ $investigation->id }}/carve" class="bg-green-800 text-green-100 text-sm rounded px-4 py-2">Carve all files</a>
                <a href="/investigations/{{ $investigation->id }}/parse" class="bg-blue-800 text-blue-100 text-sm rounded px-4 py-2">Parse all files</a>
            </div>
        </div>

        @if (session('status'))
            <div class="bg-teal-300 border border-teal-800 text-teal-800 px-4 py-2 rounded text-center">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-300 border border-red-800 text-red-800 px-4 py-2 rounded text-center">
                {{ session('error') }}
            </div>
        @endif

    </header>

    <section class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Hash
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Original Offset
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Carved At
                            </th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Odd row -->
                        @foreach($investigation->files as $file)
                            @if($loop->iteration % 2 == 0)
                                <tr class="bg-gray-50">
                            @else
                                <tr class="bg-white">
                            @endif
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                    {{ $file->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $file->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ ucfirst($file->type) }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $file->hash }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $file->original_offset }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ Carbon\Carbon::parse($file->created_at)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <a href="/files/{{ $file->id }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection
