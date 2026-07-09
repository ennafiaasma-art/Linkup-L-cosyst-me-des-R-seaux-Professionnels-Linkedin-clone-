@extends('layouts.app')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp

    <div class="max-w-2xl mx-auto px-4 py-6">

        <!-- Welcome Card -->
        @auth
            <div class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-indigo-500 via-violet-500 to-rose-400"></div>

                <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">
                    Welcome back <span class="inline-block">👋</span>
                </h1>

                <p class="text-slate-500 mt-1">
                    Bonjour
                    <span class="font-semibold text-indigo-600">
                        {{ Auth::user()->name }}
                    </span>
                </p>
            </div>
        @endauth

        <!-- Composer -->
        @auth
            <div class="relative overflow-hidden bg-white rounded-2xl shadow-sm border border-slate-200 p-5 mb-6">
                <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-indigo-500 via-violet-500 to-rose-400"></div>

                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf

                    <div class="flex gap-3">

                        <img src="{{ Auth::user()->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                            class="w-12 h-12 rounded-full object-cover ring-2 ring-slate-100">

                        <div class="flex-1">

                            <textarea name="content" rows="3" placeholder="Quoi de neuf ?"
                                class="w-full border border-slate-200 bg-slate-50 rounded-xl p-3 resize-none text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition"></textarea>

                            @error('content')
                                <p class="text-rose-500 text-sm mt-2">{{ $message }}</p>
                            @enderror

                            <div class="flex justify-end mt-3">

                                <button type="submit"
                                    class="bg-indigo-600 text-white text-sm font-semibold px-5 py-2 rounded-lg shadow-sm hover:bg-indigo-700 active:scale-[0.98] transition">
                                    Publier
                                </button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>
        @endauth

        <div class="space-y-5">

            @forelse($posts as $post)

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

                    <!-- User -->

                    <div class="flex items-start justify-between p-5 pb-3">

                        <div class="flex items-center gap-3">

                            <a href="{{ route('users.show', $post->user) }}" class="shrink-0">
                                <img src="{{ $post->user->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}"
                                    class="w-12 h-12 rounded-full object-cover ring-2 ring-slate-100">
                            </a>
                            <div>

                                <div class="flex items-center gap-2 flex-wrap">
                                    <a href="{{ route('users.show', $post->user) }}"
                                        class="font-semibold text-slate-800 hover:text-indigo-600 transition">
                                        {{ $post->user->name }}
                                    </a>
                                    @if($post->user->is_open_to_work)
                                        <span class="inline-flex items-center gap-1 bg-emerald-50 text-emerald-700 text-xs font-semibold px-2 py-0.5 rounded-full ring-1 ring-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Open To Work
                                        </span>
                                    @endif
                                </div>

                                <p class="text-sm text-slate-500 leading-snug">
                                    {{ $post->user->headline }}
                                    @if($post->user->company)
                                        · {{ $post->user->company }}
                                    @endif
                                </p>

                                <p class="text-xs text-slate-400 mt-0.5">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>

                            </div>

                        </div>

                        <!-- modifier et supprimer -->
                        @auth
                            @if(Auth::id() == $post->user_id)

                                <div class="flex gap-2 shrink-0">

                                    <a href="{{ route('feed', ['edit' => $post->id]) }}"
                                        class="px-3 py-1.5 text-xs font-semibold bg-amber-50 text-amber-700 rounded-lg ring-1 ring-amber-200 hover:bg-amber-100 transition">
                                        Modifier
                                    </a>

                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="px-3 py-1.5 text-xs font-semibold bg-rose-50 text-rose-700 rounded-lg ring-1 ring-rose-200 hover:bg-rose-100 transition">
                                            Supprimer
                                        </button>
                                    </form>

                                </div>

                            @endif
                        @endauth

                    </div>

                    <!-- Content -->

                    <div class="px-5 pb-4">

                        @if(request('edit') == $post->id)

                            <form action="{{ route('posts.update', $post->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <textarea name="content" rows="4"
                                    class="w-full border border-slate-200 bg-slate-50 rounded-lg p-3 text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition">{{ old('content', $post->content) }}</textarea>

                                @error('content')
                                    <p class="text-rose-500 text-sm mt-2">{{ $message }}</p>
                                @enderror

                                <div class="flex gap-2 mt-3">

                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                                        Enregistrer
                                    </button>

                                    <a href="{{ route('feed') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold px-4 py-2 rounded-lg transition">
                                        Annuler
                                    </a>

                                </div>

                            </form>

                        @else

                            <p class="text-slate-700 leading-7 whitespace-pre-line">
                                {{ Str::limit($post->content, 150, '.... voir plus') }}
                            </p>

                        @endif

                    </div>

                    <!-- Actions -->
                    <!-- like -->

                    <div class="border-t border-slate-100">

                        <div class="flex justify-around items-center py-1">
                            @php
                                $liked = $post->likes->contains('user_id', auth()->id());
                            @endphp

                            <form action="{{ route('posts.like', $post) }}" method="POST" class="flex-1">
                                @csrf

                                <button class="w-full py-2.5 rounded-lg flex items-center justify-center gap-2 text-sm font-medium transition hover:bg-slate-50 {{ $liked ? 'text-indigo-600' : 'text-slate-500' }}">
                                    <span class="{{ $liked ? 'scale-110' : '' }} transition-transform">
                                        {{ $liked ? '💙' : '🤍' }}
                                    </span>
                                    {{ $post->likes()->count() }}
                                    <span class="hidden sm:inline">like</span>
                                </button>
                            </form>

                            <!-- comment -->
                            <button type="button" onclick="toggleComments({{ $post->id }})"
                                class="flex-1 py-2.5 rounded-lg hover:bg-slate-50 transition font-medium text-sm text-slate-500 flex items-center justify-center gap-2">
                                💬 Commenter
                            </button>
                        </div>

                        <div id="comments-{{ $post->id }}" class="hidden border-t border-slate-100 bg-slate-50/60 p-4">

                            @auth
                                <form action="{{ route('comments.store', $post) }}" method="POST">
                                    @csrf

                                    <div class="flex items-center gap-3">
                                        <img src="{{ Auth::user()->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                            class="w-10 h-10 rounded-full object-cover ring-2 ring-white">
                                        <input type="text" name="content" placeholder="Écrire un commentaire..."
                                            class="flex-1 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">

                                        <button
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-5 py-2 rounded-full transition">
                                            Envoyer
                                        </button>
                                    </div>
                                </form>
                            @endauth

                            <div class="mt-4 space-y-3">
                                @foreach($post->comments as $comment)

                                    <div class="flex gap-3">
                                        <img src="{{ $comment->user->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
                                            class="w-10 h-10 rounded-full object-cover ring-2 ring-white">

                                        <div class="bg-white shadow-sm rounded-2xl px-4 py-3 flex-1">

                                            <strong class="text-sm text-slate-800">{{ $comment->user->name }}</strong>

                                            <p class="mt-1 text-slate-700 text-sm leading-6">{{ $comment->content }}</p>

                                            <small class="text-slate-400 text-xs">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>

                                @endforeach
                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-10 text-center">

                    <div class="text-5xl mb-4">
                        📢
                    </div>

                    <h2 class="text-xl font-bold text-slate-700">
                        Aucun post disponible
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Soyez la première personne à partager quelque chose avec la communauté.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

    <script>
        function toggleComments(postId) {
            document
                .getElementById('comments-' + postId)
                .classList.toggle('hidden');
        }
    </script>

@endsection
