
@extends('layouts.app')
@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-100 to-indigo-100 p-6">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
            Créer un compte
        </h2>
        <p class="text-center text-gray-500 mb-8">
            Rejoignez-nous dès aujourd'hui
        </p>

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Nom -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nom complet
                </label>
                <input
                    type="text"
                    name="name"
                      value="{{old('name') }}"

                    placeholder="Entrer votre nom"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                >
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    value="{{old('email') }}"
                    placeholder="[email protected]"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                >
            </div>

            <!-- Mot de passe -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Mot de passe
                </label>
                <input
                    type="password"
                    name="password"
                    placeholder="********"
                    required
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                >
            </div>

            <!-- Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirmer le mot de passe
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="********"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                >
            </div>

            <!-- Bouton -->
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300"
            >
                S'inscrire
            </button>

            <!-- Lien connexion -->
            <p class="text-center text-gray-600">
                Vous avez déjà un compte ?
                <a href="{{ route('show.login') }}"
                   class="text-blue-600 font-semibold hover:underline">
                    Se connecter
                </a>
            </p>
        </form>

    </div>
</div>
@endsection
