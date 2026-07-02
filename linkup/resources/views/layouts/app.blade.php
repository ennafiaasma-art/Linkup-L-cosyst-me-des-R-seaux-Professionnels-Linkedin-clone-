<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkUp</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">

        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

            <!-- Logo -->
            <a href="{{ route('feed') }}"
               class="text-3xl font-bold text-blue-600">
                LinkUp
            </a>

            <!-- Search -->
            <div class="hidden md:block w-96">
                <input
                    type="text"
                    placeholder="Search..."
                    class="w-full px-4 py-2 rounded-full bg-gray-100 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Right -->
            <div class="flex items-center gap-4">

                @guest

                    <a href="{{ route('show.login') }}"
                       class="px-5 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                        Login
                    </a>

                    <a href="{{ route('show.register') }}"
                       class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                        Register
                    </a>

                @endguest


                @auth

                    <div class="flex items-center gap-3">

                        <img
                            src="{{ Auth::user()->image_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                            alt="Profile"
                            class="w-10 h-10 rounded-full object-cover border">

                        <div class="hidden sm:block">

                            <p class="font-semibold text-gray-800">
                                {{ Auth::user()->name }}
                            </p>

                        </div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button
                                class="px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition">
                                Logout
                            </button>

                        </form>

                    </div>

                @endauth

            </div>

        </div>

    </header>

    <!-- Content -->
    <main class="py-8">

        @yield('content')

    </main>

</body>
</html>
