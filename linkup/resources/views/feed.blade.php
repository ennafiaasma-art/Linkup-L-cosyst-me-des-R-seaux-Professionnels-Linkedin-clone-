@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-4 py-10 antialiased">

    <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] p-6 mb-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">

        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 flex items-center gap-2">
                <span class="animate-bounce">👋</span> Welcome
            </h1>

            @auth
                <p class="text-sm text-gray-500 mt-1.5 font-medium">
                    Content de te revoir,
                    <span class="text-indigo-600 font-semibold bg-indigo-50 px-2.5 py-0.5 rounded-md text-xs tracking-wide">
                        {{ Auth::user()->name }}
                    </span>
                </p>
            @endauth
        </div>


        <div class="flex flex-wrap gap-3">


                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf

                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-semibold rounded-full bg-rose-50 text-rose-600 hover:bg-rose-100 border border-rose-100 transition-all duration-200 active:scale-95">
                        Logout
                    </button>
                </form>
                          

                @guest
          @if(Route::has('login'));
                <a href="{{ route('show.login') }}"
                   class="px-5 py-2.5 text-sm font-semibold rounded-full text-gray-700 hover:bg-gray-100 border border-gray-200 transition-all duration-200 active:scale-95">
                    Login
                </a>
                @endif
@if(Route::has('register'))
                <a href="{{ route('show.register') }}"
                   class="px-5 py-2.5 text-sm font-semibold rounded-full bg-indigo-600 text-white hover:bg-indigo-700 transition-all duration-200 shadow-sm shadow-indigo-200 active:scale-95">
                    Register
                </a>
            @endif
            @endguest

        </div>

    </div>

    <div class="space-y-6">

        @forelse($posts as $post)

            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] overflow-hidden transition-all duration-300 hover:shadow-[0_8px_30px_-4px_rgba(0,0,0,0.08)]">

                <div class="flex items-center justify-between p-6 pb-4">

                    <div class="flex items-center gap-3.5">

                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full blur opacity-10 group-hover:opacity-30 transition duration-300"></div>
                            <img
                                src="{{ $post->user->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}"
                                alt="{{ $post->user->name }}"
                                class="relative w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                        </div>

                        <div>
                            <h2 class="font-bold text-gray-900 hover:text-indigo-600 transition cursor-pointer leading-tight">
                                {{ $post->user->name }}
                            </h2>

                            <p class="text-[13px] font-medium text-gray-400 mt-0.5 flex items-center flex-wrap gap-1">
                                <span>{{ $post->user->headline }}</span>
                                @if($post->user->company)
                                    <span class="text-gray-300">•</span>
                                    <span class="text-indigo-500 font-semibold bg-indigo-50/50 px-1.5 py-0.2 rounded">{{ $post->user->company }}</span>
                                @endif
                            </p>
                        </div>

                    </div>

                    <button
                        class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-gray-50 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                        </svg>
                    </button>

                </div>

                <div class="px-6 pb-5">
                    <p class="text-gray-700 text-[15px] leading-relaxed tracking-normal whitespace-pre-line">
                        {{ $post->content }}
                    </p>
                </div>

                <div class="border-t border-gray-50 px-4 py-2 bg-gray-50/40">

                    <div class="grid grid-cols-3 gap-1">

                        <button
                            class="flex items-center justify-center gap-2 py-2.5 rounded-xl hover:bg-white hover:shadow-sm text-gray-500 hover:text-indigo-600 transition-all duration-200 group font-medium text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:scale-110">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.303-.546 1.303-1.254V4.845c0-.708-.555-1.245-1.264-1.245A2.75 2.75 0 004 6.35v6.155a2.78 2.78 0 002.633 2.75H18a2 2 0 002-2V8a2 2 0 00-2-2h-3.729a3.75 3.75 0 00-3.513 2.459l-.328.985A1.25 1.25 0 017.242 10.5H6.633z" />
                            </svg>
                            <span>Like</span>
                        </button>

                        <button
                            class="flex items-center justify-center gap-2 py-2.5 rounded-xl hover:bg-white hover:shadow-sm text-gray-500 hover:text-indigo-600 transition-all duration-200 group font-medium text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:scale-110">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785 4.75 4.75 0 003.424-1.378c.29-.156.63-.106.956.024A10.142 10.142 0 0012 20.25z" />
                            </svg>
                            <span>Comment</span>
                        </button>

                        <button
                            class="flex items-center justify-center gap-2 py-2.5 rounded-xl hover:bg-white hover:shadow-sm text-gray-500 hover:text-indigo-600 transition-all duration-200 group font-medium text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:scale-110">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                            </svg>
                            <span>Share</span>
                        </button>

                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-3xl border border-gray-100 p-12 text-center shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)]">
                <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    📢
                </div>
                <h2 class="text-xl font-bold text-gray-800">
                    Aucun post disponible
                </h2>
                <p class="text-gray-400 text-sm mt-1.5 max-w-sm mx-auto">
                    Soyez la première personne à partager quelque chose avec la communauté.
                </p>
            </div>

        @endforelse

    </div>

</div>

@endsection
