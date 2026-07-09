@extends('layouts.app')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp

    <div class="min-h-screen bg-[#f4f2ee]">

    <div class="max-w-xl mx-auto px-4 py-6">

        <!-- Welcome Card -->
        @auth
            <div class="relative overflow-hidden bg-white rounded-lg shadow-sm border border-gray-200 mb-4">
                <div class="h-14 bg-gradient-to-r from-blue-700 to-blue-500"></div>

                <div class="px-4 pb-4 -mt-8">

                    <img src="{{ Auth::user()->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                        class="w-16 h-16 rounded-full object-cover ring-4 ring-white">

                    <div class="flex items-start justify-between mt-2">
                        <div>
                            <h1 class="text-lg font-semibold text-gray-900">
                                {{ Auth::user()->name }}
                            </h1>
                            <p class="text-sm text-gray-500">
                                Bonjour, content de vous revoir 👋
                            </p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="shrink-0 text-xs font-semibold text-blue-700 border border-blue-700 rounded-full px-3 py-1.5 hover:bg-blue-50 transition">
                            Modifier mon profil
                        </a>
                    </div>

                </div>
            </div>
        @endauth

        <!-- Composer -->
        @auth
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">

                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf

                    <div class="flex items-center gap-3">

                        <img src="{{ Auth::user()->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                            class="w-12 h-12 rounded-full object-cover shrink-0">

                        <textarea name="content" rows="1" placeholder="Quoi de neuf ?"
                            class="w-full border border-gray-300 rounded-full px-4 py-3 resize-none text-sm text-gray-700 placeholder:text-gray-500 placeholder:font-medium focus:outline-none focus:ring-2 focus:ring-blue-600 focus:rounded-2xl transition-all"></textarea>

                    </div>

                    @error('content')
                        <p class="text-red-600 text-sm mt-2 ml-[60px]">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-end mt-3">

                        <button type="submit"
                            class="bg-blue-700 text-white text-sm font-semibold px-6 py-1.5 rounded-full hover:bg-blue-800 active:scale-[0.98] transition">
                            Publier
                        </button>

                    </div>

                </form>

            </div>
        @endauth

        <div class="space-y-4">

            @forelse($posts as $post)

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

                    <!-- User -->

                    <div class="flex items-start justify-between px-4 pt-4">

                        <div class="flex items-center gap-3">

                            <a href="{{ route('users.show', $post->user) }}" class="shrink-0">
                                <img src="{{ $post->user->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}"
                                    class="w-12 h-12 rounded-full object-cover">
                            </a>
                            <div>

                                <div class="flex items-center gap-2 flex-wrap">
                                    <a href="{{ route('users.show', $post->user) }}"
                                        class="font-semibold text-gray-900 hover:text-blue-700 hover:underline text-sm">
                                        {{ $post->user->name }}
                                    </a>
                                    @if($post->user->is_open_to_work)
                                        <span
                                            class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-[11px] font-semibold px-2 py-0.5 rounded-full ring-1 ring-green-200">
                                            🟢 Open To Work
                                        </span>
                                    @endif
                                </div>

                                <p class="text-xs text-gray-500 leading-snug">
                                    {{ $post->user->headline }}
                                    @if($post->user->company)
                                        · {{ $post->user->company }}
                                    @endif
                                </p>

                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>

                            </div>

                        </div>

                        <!-- modifier et supprimer -->
                        @auth
                            @if(Auth::id() == $post->user_id)

                                <div class="flex gap-2 shrink-0">

                                    <a href="{{ route('feed', ['edit' => $post->id]) }}"
                                        class="px-2.5 py-1 text-xs font-semibold text-gray-500 rounded-full hover:bg-gray-100 transition">
                                        Modifier
                                    </a>

                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="px-2.5 py-1 text-xs font-semibold text-red-600 rounded-full hover:bg-red-50 transition">
                                            Supprimer
                                        </button>
                                    </form>

                                </div>

                            @endif
                        @endauth

                    </div>

                    <!-- Content -->

                    <div class="px-4 pt-2 pb-3">

                        @if(request('edit') == $post->id)

                            <form action="{{ route('posts.update', $post->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <textarea name="content" rows="4"
                                    class="w-full border border-gray-300 rounded-lg p-3 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600 transition">{{ old('content', $post->content) }}</textarea>

                                @error('content')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror

                                <div class="flex gap-2 mt-3">

                                    <button type="submit"
                                        class="bg-blue-700 hover:bg-blue-800 text-white text-sm font-semibold px-4 py-1.5 rounded-full transition">
                                        Enregistrer
                                    </button>

                                    <a href="{{ route('feed') }}"
                                        class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold px-4 py-1.5 rounded-full transition">
                                        Annuler
                                    </a>

                                </div>

                            </form>

                        @else

                            <p class="text-gray-800 text-sm leading-6 whitespace-pre-line">
                                {{ Str::limit($post->content, 150, '.... voir plus') }}
                            </p>

                        @endif

                    </div>

                    <!-- Actions -->
                    <!-- like -->
                    @php
                        $liked = $post->likes->contains('user_id', auth()->id());
                    @endphp

                    <div class="px-4">
                        <div class="flex items-center justify-between text-xs text-gray-500 pb-1.5 border-b border-gray-100">
                            <span class="flex items-center gap-1">
                                <span class="w-4 h-4 rounded-full bg-blue-600 text-white flex items-center justify-center text-[10px]">👍</span>
                                {{ $post->likes()->count() }}
                            </span>
                            <span>{{ $post->comments->count() }} commentaire{{ $post->comments->count() > 1 ? 's' : '' }}</span>
                        </div>
                    </div>

                    <div class="px-2">

                        <div class="flex items-center py-1">

                            <form action="{{ route('posts.like', $post) }}" method="POST" class="flex-1">
                                @csrf

                                <button
                                    class="w-full py-2.5 rounded-md flex items-center justify-center gap-2 text-sm font-semibold transition hover:bg-gray-100 {{ $liked ? 'text-blue-700' : 'text-gray-600' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5" fill="{{ $liked ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 11v10H4a1 1 0 01-1-1v-8a1 1 0 011-1h3zm0 0l4.5-8a2 2 0 013.5 1.5V9h4.2a2 2 0 011.98 2.28l-1.14 8A2 2 0 0117.58 21H7" />
                                    </svg>
                                    J'aime
                                </button>
                            </form>

                            <!-- comment -->
                            <button type="button" onclick="toggleComments({{ $post->id }})"
                                class="flex-1 py-2.5 rounded-md hover:bg-gray-100 transition font-semibold text-sm text-gray-600 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8-1.06 0-2.078-.163-3.024-.463L3 21l1.539-4.615C3.564 15.088 3 13.598 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Commenter
                            </button>
                        </div>

                        <div id="comments-{{ $post->id }}" class="hidden border-t border-gray-100 px-2 pb-3 pt-3">

                            @auth
                                <form action="{{ route('comments.store', $post) }}" method="POST">
                                    @csrf

                                    <div class="flex items-center gap-2">
                                        <img src="{{ Auth::user()->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                            class="w-9 h-9 rounded-full object-cover shrink-0">
                                        <input type="text" name="content" placeholder="Écrire un commentaire..."
                                            class="flex-1 rounded-full border border-gray-300 bg-gray-50 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition">

                                        <button
                                            class="bg-blue-700 hover:bg-blue-800 text-white text-xs font-semibold px-4 py-2 rounded-full transition shrink-0">
                                            Envoyer
                                        </button>
                                    </div>
                                </form>
                            @endauth

                            <div class="mt-3 space-y-2">
                                @foreach($post->comments as $comment)

                                    <div class="flex gap-2">
                                        <img src="{{ $comment->user->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
                                            class="w-9 h-9 rounded-full object-cover shrink-0">

                                        <div class="bg-gray-100 rounded-2xl px-3 py-2 flex-1">

                                            <strong class="text-xs text-gray-900">{{ $comment->user->name }}</strong>

                                            <p class="text-sm text-gray-800 leading-5">{{ $comment->content }}</p>

                                        </div>
                                    </div>
                                    <div class="pl-11">
                                        <small class="text-gray-400 text-[11px]">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </small>
                                    </div>

                                @endforeach
                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-10 text-center">

                    <div class="text-5xl mb-4">
                        📢
                    </div>

                    <h2 class="text-lg font-bold text-gray-700">
                        Aucun post disponible
                    </h2>

                    <p class="text-gray-500 mt-2 text-sm">
                        Soyez la première personne à partager quelque chose avec la communauté.
                    </p>

                </div>

            @endforelse

        </div>

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
