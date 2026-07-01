<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkUp - Feed</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="text-orange-400 font-bold text-2xl tracking-wide">LinkUp</span>
            </div>
            <div class="text-gray-600 font-medium">Feed d l-communauté</div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto cp-6 mt-6">



    <div class="bg-white rounded-2xl shadow-md p-5 mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                👋 Welcome
            </h1>

            @auth
                <p class="text-gray-500 mt-1">
                    Hi, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span>
                </p>
            @endauth
        </div>

        <div class="flex flex-wrap gap-3">

            <a href="{{ route('show.login') }}"
               class="px-5 py-2 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200 transition">
                Login
            </a>

            <a href="{{ route('show.register') }}"
               class="px-5 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition shadow">
                Register
            </a>

            @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    class="px-5 py-2 rounded-full bg-red-500 text-white hover:bg-red-600 transition shadow">
                    Logout
                </button>
            </form>
            @endauth

        </div>

    </div>

        @yield('content')
        
    </main>

</body>
</html>
