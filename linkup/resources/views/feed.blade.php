@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">

    @forelse($posts as $post)

    <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden hover:shadow-xl transition duration-300">

        <!-- Header -->
        <div class="flex items-center justify-between p-5">

            <div class="flex items-center gap-4">

                <img
                    src="{{ $post->user->image_url ?? 'https://via.placeholder.com/150' }}"
                    alt="{{ $post->user->name }}"
                    class="w-14 h-14 rounded-full object-cover border-2 border-blue-500">

                <div>

                    <h2 class="font-semibold text-gray-900 text-lg">
                        {{ $post->user->name }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ $post->user->headline }}

                        @if($post->user->company)
                            • {{ $post->user->company }}
                        @endif
                    </p>

                    <span class="text-xs text-gray-400">
                       

                    </span>

                </div>

            </div>

            <button class="text-gray-400 hover:text-gray-700 text-xl">
                ⋮
            </button>

        </div>

        <!-- Content -->
        <div class="px-5 pb-5">

            <p class="text-gray-700 leading-7 whitespace-pre-line">
                {{ $post->content }}
            </p>

        </div>

        <!-- Footer -->
        <div class="border-t border-gray-100">

            <div class="grid grid-cols-3">

                <button
                    class="py-3 hover:bg-gray-50 transition flex items-center justify-center gap-2 text-gray-600">

                    👍
                    <span class="text-sm font-medium">Like</span>

                </button>

                <button
                    class="py-3 hover:bg-gray-50 transition flex items-center justify-center gap-2 text-gray-600">

                    💬
                    <span class="text-sm font-medium">Comment</span>

                </button>

                <button
                    class="py-3 hover:bg-gray-50 transition flex items-center justify-center gap-2 text-gray-600">

                    ↗️
                    <span class="text-sm font-medium">Share</span>

                </button>

            </div>

        </div>

    </div>

    @empty

    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-10 text-center">

        <div class="text-6xl mb-4">
            📢
        </div>

        <h2 class="text-xl font-semibold text-gray-800">
            Aucun post disponible
        </h2>

        <p class="text-gray-500 mt-2">
            Soyez la première personne à partager quelque chose avec la communauté.
        </p>

    </div>

    @endforelse

</div>

@endsection
