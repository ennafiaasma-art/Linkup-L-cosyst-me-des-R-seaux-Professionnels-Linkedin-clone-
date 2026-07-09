@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-8">

        <h1 class="text-2xl font-bold mb-6">
            Modifier mon profil
        </h1>

        <form action="{{ route('profile.update') }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-5">

                <label class="block mb-2 font-medium">
                    Headline
                </label>

                <input
                    type="text"
                    name="headline"
                    value="{{ old('headline', auth()->user()->headline) }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-medium">
                    Entreprise
                </label>

                <input
                    type="text"
                    name="company"
                    value="{{ old('company', auth()->user()->company) }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-medium">
                    URL de l'image
                </label>

                <input
                    type="url"
                    name="image_url"
                    value="{{ old('image_url', auth()->user()->image_url) }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <button
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">

                Enregistrer

            </button>

        </form>

    </div>

</div>

@endsection
