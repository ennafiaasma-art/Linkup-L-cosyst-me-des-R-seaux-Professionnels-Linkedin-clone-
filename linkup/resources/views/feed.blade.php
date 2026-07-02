@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-4">

    <!-- Welcome Card -->
    @auth
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Welcome back 👋
            </h1>

            <p class="text-gray-500 mt-2">
                Bonjour
                <span class="font-semibold text-blue-600">
                    {{ Auth::user()->name }}
                </span>
            </p>
        </div>
    @endauth


    <!-- Posts -->

    <div class="space-y-6">

        @forelse($posts as $post)

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                <!-- User -->

                <div class="flex items-center justify-between p-5">

                    <div class="flex items-center gap-3">

                        <img
                            src="{{ $post->user->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}"
                            alt="{{ $post->user->name }}"
                            class="w-12 h-12 rounded-full object-cover border">

                        <div>

                            <h2 class="font-semibold text-gray-800">
                                {{ $post->user->name }}
                            </h2>

                            <p class="text-sm text-gray-500">

                                {{ $post->user->headline }}

                                @if($post->user->company)
                                    • {{ $post->user->company }}
                                @endif

                            </p>

                        </div>

                    </div>

                    <button
                        class="w-9 h-9 rounded-full hover:bg-gray-100 text-gray-500 transition">
                        ⋮
                    </button>

                </div>


                <!-- Content -->

                <div class="px-5 pb-5">

                    <p class="text-gray-700 leading-7 whitespace-pre-line">
                        {{ $post->content }}
                    </p>

                </div>


                <!-- Actions -->

                <div class="border-t border-gray-200">

                    <div class="grid grid-cols-3">

                        <button
                            class="py-3 hover:bg-gray-100 transition font-medium text-gray-600">
                            👍 Like
                        </button>

                        <button
                            class="py-3 hover:bg-gray-100 transition font-medium text-gray-600">
                            💬 Comment
                        </button>

                        <button
                            class="py-3 hover:bg-gray-100 transition font-medium text-gray-600">
                            📤 Share
                        </button>

                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-10 text-center">

                <div class="text-5xl mb-4">
                    📢
                </div>

                <h2 class="text-xl font-bold text-gray-700">
                    Aucun post disponible
                </h2>

                <p class="text-gray-500 mt-2">
                    Soyez la première personne à partager quelque chose avec la communauté.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection
