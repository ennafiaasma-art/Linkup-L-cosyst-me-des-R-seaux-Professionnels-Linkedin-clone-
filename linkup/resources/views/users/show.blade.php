@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-8">

        <div class="flex items-center gap-6">

            <img
                src="{{ $user->image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}"
                class="w-28 h-28 rounded-full border">

            <div>

                <h1 class="text-3xl font-bold">
                    {{ $user->name }}
                </h1>

                <p class="text-gray-600">
                    {{ $user->headline }}
                </p>

                <p class="text-gray-500">
                    {{ $user->company }}
                </p>

                @if($user->is_open_to_work)
                    <span class="mt-2 inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full">
                        🟢 Open To Work
                    </span>
                @endif

            </div>

        </div>

    </div>

    <div class="mt-8">

        <h2 class="text-xl font-bold mb-4">
            Publications
        </h2>

        @forelse($user->posts as $post)

            <div class="bg-white rounded-xl shadow p-5 mb-4">

                {{ $post->content }}

                <div class="text-sm text-gray-500 mt-2">
                    {{ $post->created_at->diffForHumans() }}
                </div>

            </div>

        @empty

            <p>Aucune publication.</p>

        @endforelse

    </div>

</div>

@endsection
