<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

        <!-- Titre -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">
                Connexion
            </h2>
            <p class="text-gray-500 mt-2">
                Connectez-vous à votre compte
            </p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Adresse e-mail
                </label>
                <input type="email" name="email" required value="{{  old('email') }}" placeholder="Entrez votre e-mail"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <!-- Mot de passe -->
            <div>
                <div class="flex justify-between mb-2">
                    <label class="text-sm font-medium text-gray-700">
                        Mot de passe
                    </label>

                    <a href="#" class="text-sm text-indigo-600 hover:underline">
                        Mot de passe oublié ?
                    </a>
                </div>

                <input type="password" name="password" placeholder="********"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <!-- Remember me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember"
                        class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <span class="text-sm text-gray-600">
                        Se souvenir de moi
                    </span>
                </label>
            </div>

            <!-- Bouton -->
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold transition duration-300">
                Se connecter
            </button>


            @if ($errors->any())
                <ul class="px-4 py-2 bg-red-100 border border-red-300 rounded-lg">
                    @foreach ($errors->all() as $error)
                        <li class="my-2 text-red-600">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            @endif

            <!-- Inscription -->
            <div class="text-center">
                <p class="text-gray-600">
                    Vous n'avez pas de compte ?
                    <a href="{{ route('show.register') }}" class="text-indigo-600 font-semibold hover:underline">
                        Créer un compte
                    </a>
                </p>
            </div>

        </form>

    </div>
</div>
</body>
</html>


