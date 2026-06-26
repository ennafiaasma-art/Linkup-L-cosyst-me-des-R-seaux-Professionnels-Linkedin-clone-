@extends('layouts.app') @section('content')
<div class="grid grid-cols-1 gap-6">

    @forelse($posts as $post)
        <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-200">

            <div class="flex items-center space-x-3 mb-4">
                <img src="{{ $post->user->image_url ?? 'https://via.placeholder.com/150' }}"
                     alt="{{ $post->user->name }}"
                     class="w-12 h-12 rounded-full object-cover">
                <div>
                    <h3 class="font-semibold text-gray-900 text-sm">{{ $post->user->name }}</h3>
                    <p class="text-xs text-gray-500">{{ $post->user->headline }}
                        @if($post->user->company) @ {{ $post->user->company }} @endif
                    </p>
                    <p class="text-[10px] text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <p class="text-gray-800 text-sm whitespace-pre-line">
                {{ $post->content }}
            </p>

        </div>
    @empty
        <div class="bg-white p-6 rounded-xl text-center text-gray-500">
            Mazaal makayan 7ta post lyouma. Kun nti l-bdaya!
        </div>
    @endforelse

</div>
@endsection
