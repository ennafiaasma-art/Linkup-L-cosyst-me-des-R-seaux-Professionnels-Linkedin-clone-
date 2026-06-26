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
                <span class="text-blue-600 font-bold text-2xl tracking-wide">LinkUp</span>
            </div>
            <div class="text-gray-600 font-medium">Feed d l-communauté</div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto cp-6 mt-6">
        @yield('content')
    </main>

</body>
</html>
