@extends('layouts.app')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp

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
        @auth
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 mb-6">

                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf

                    <div class="flex gap-3">

                        <img src="{{ Auth::user()->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                            class="w-12 h-12 rounded-full object-cover border">

                        <div class="flex-1">

                            <textarea name="content" rows="3" placeholder="What's on your mind?"
                                class="w-full border border-gray-300 rounded-xl p-3 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

                            @error('content')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror

                            <div class="flex justify-end mt-3">

                                <button type="submit"
                                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                                    Publier
                                </button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>
        @endauth

        <div class="space-y-6">

            @forelse($posts as $post)

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

                    <!-- User -->

                    <div class="flex items-center justify-between p-5">

                        <div class="flex items-center gap-3">

                            <a href="{{ route('users.show', $post->user) }}">
                                <img src="{{ $post->user->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}"
                                    class="w-12 h-12 rounded-full object-cover border">
                            </a>
                            <div>

                                <a href="{{ route('users.show', $post->user) }}"
                                    class="font-semibold text-gray-800 hover:text-blue-600">
                                    {{ $post->user->name }}
                                </a>
                                @if($post->user->is_open_to_work)
                                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">
                                        🟢 Open To Work
                                    </span>
                                @endif



                                <p class="text-sm text-gray-500">

                                    {{ $post->user->headline }}

                                    @if($post->user->company)
                                        {{ $post->user->company }}
                                    @endif

                                </p>
                                {{ $post->created_at->diffForHumans() }}

                            </div>

                        </div>
                        <!-- modifier et supprimer -->
                        @auth
                            @if(Auth::id() == $post->user_id)

                                <div class="flex gap-2">

                                    <a href="{{ route('feed', ['edit' => $post->id]) }}"
                                        class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                                        Modifier
                                    </a>

                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="px-3 py-1 bg-red-600 text-white rounded-lg">
                                            Supprimer
                                        </button>
                                    </form>

                                </div>

                            @endif
                        @endauth

                    </div>



                    <!-- Content -->

                    <div class="px-5 pb-5">

                        @if(request('edit') == $post->id)

                            <form action="{{ route('posts.update', $post->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <textarea name="content" rows="4"
                                    class="w-full border border-gray-300 rounded-lg p-3">{{ old('content', $post->content) }}</textarea>

                                @error('content')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror

                                <div class="flex gap-2 mt-3">

                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                        Enregistrer
                                    </button>

                                    <a href="{{ route('feed') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg">
                                        Annuler
                                    </a>

                                </div>

                            </form>

                        @else

                            <p class="text-gray-700 leading-7 whitespace-pre-line">

                                {{ str::limit($post->content, 150, '.... voir plus')}}
                            </p>

                        @endif


                    </div>

                    <!-- Actions -->
                    <!-- like -->

                    <div class="border-t border-gray-200">

                        <div class="flex justify-around items-center py-2 border-t">
                            @php
                                $liked = $post->likes->contains('user_id', auth()->id());
                            @endphp

                            <form action="{{ route('posts.like', $post) }}" method="POST">
                                @csrf

                                <button class="{{ $liked ? 'text-blue-600 font-bold' : 'text-gray-600' }}">
                                    {{ $liked ? '👍 ' : '👍 ' }}
                                    {{ $post->likes()->count() }}
                                    like
                                </button>
                            </form>

                            <!-- comment -->
                            <button type="button" onclick="toggleComments({{ $post->id }})"
                                class="py-3 hover:bg-gray-100 transition font-medium text-gray-600">
                                💬 Commenter
                            </button>

                            <div id="comments-{{ $post->id }}" class="hidden border-t bg-gray-50 p-4">

                                @auth
                                    <form action="{{ route('comments.store', $post) }}" method="POST">
                                        @csrf

                                        <div class="flex items-center gap-3">
                                            <img src="{{ Auth::user()->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                                class="w-10 h-10 rounded-full">
                                            <input type="text" name="content" placeholder="Écrire un commentaire..."
                                                class="flex-1 rounded-full border px-4 py-2 focus:ring-2 focus:ring-blue-500">

                                            <button
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full transition">
                                                Envoyer
                                            </button>
                                        </div>
                                    </form>
                                @endauth

                                <div class="mt-4 space-y-3">
                                    @foreach($post->comments as $comment)

                                        <div class=" flex gap-3">
                                            <img src="{{ $comment->user->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
                                                class="w-10 h-10 rounded-full">

                                            <div class="bg-white shadow-sm rounded-2xl px-4 py-3 flex-1">

                                                <div class="flex justify-between"></div>
                                                <strong>{{ $comment->user->name }}</strong>

                                                <p class="mt-1 text-gray-700">{{ $comment->content }}</p>

                                                <small class="text-gray-500">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </small>
                                            </div>

                                    @endforeach
                                    </div>

                                </div>






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
        <script>
            function toggleComments(postId) {
                document
                    .getElementById('comments-' + postId)
                    .classList.toggle('hidden');
            }
        </script>

@endsection
