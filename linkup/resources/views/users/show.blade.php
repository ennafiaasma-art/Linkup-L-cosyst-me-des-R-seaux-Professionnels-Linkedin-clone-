@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto px-4 py-6">

    <!-- Profile Card -->
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-indigo-500 via-violet-500 to-rose-400"></div>

        <div class="flex items-center gap-6 flex-wrap sm:flex-nowrap">

            <img
                src="{{ $user->image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}"
                class="w-28 h-28 rounded-full object-cover ring-4 ring-slate-100 shrink-0">

            <div>

                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    {{ $user->name }}
                </h1>

                <p class="text-slate-600 mt-1">
                    {{ $user->headline }}
                </p>

                <p class="text-slate-400 text-sm">
                    {{ $user->company }}
                </p>

                @if($user->is_open_to_work)
                    <span class="mt-3 inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs font-semibold px-3 py-1 rounded-full ring-1 ring-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Open To Work
                    </span>
                @endif

            </div>

        </div>

    </div>

    <!-- Posts -->
    <div class="mt-8">

        <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
            Publications
            <span class="text-sm font-medium text-slate-400">({{ $user->posts->count() }})</span>
        </h2>

        <div class="space-y-4">

            @forelse($user->posts as $post)

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">

                    <p class="text-slate-700 leading-7 whitespace-pre-line">
                        {{ $post->content }}
                    </p>

                    <div class="text-xs text-slate-400 mt-3">
                        {{ $post->created_at->diffForHumans() }}
                    </div>

                </div>

            @empty

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-10 text-center">

                    <div class="text-5xl mb-4">
                        📭
                    </div>

                    <p class="text-slate-500">
                        Aucune publication.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection
