<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une nouvelle annonce</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navigation Bar -->
    <nav class="bg-red-600 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('proprietaire.dashboard') }}" class="text-white text-2xl font-semibold">🏡 Tableau de bord</a>
            <div class="space-x-6">
                <a href="{{ route('proprietaire.dashboard') }}" class="text-white hover:text-red-200">Tableau de bord</a>
                <a href="{{ route('proprietaire.annonces.create') }}" class="text-white hover:text-red-200">Ajouter une annonce</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-10">
        <h2 class="text-3xl font-extrabold text-center text-red-700 mb-8">➕ Ajouter une nouvelle annonce</h2>

        <!-- Error Display -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-5 rounded-lg mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="font-semibold">⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form for adding new listing -->
        <form action="{{ route('proprietaire.annonces.store') }}" method="POST" class="bg-white shadow-xl rounded-xl p-10 space-y-6 max-w-4xl mx-auto">
            @csrf

            <!-- Nom de l'annonce -->
            <div>
                <label for="name" class="block text-lg font-medium text-gray-800">🏷️ Nom de l'annonce :</label>
                <input id="name" type="text" name="name" class="w-full border border-gray-300 rounded-lg p-4 mt-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Ex. Appartement à Rabat" value="{{ old('name') }}" required>
            </div>

            <!-- Prix (MAD) -->
            <div>
                <label for="prix" class="block text-lg font-medium text-gray-800">💰 Prix (MAD) :</label>
                <input id="prix" type="number" name="prix" class="w-full border border-gray-300 rounded-lg p-4 mt-2 focus:outline-none focus:ring-2 focus:ring-red-500" value="{{ old('prix') }}" required>
            </div>

            <!-- Localisation -->
            <div>
                <label for="localisation" class="block text-lg font-medium text-gray-800">📍 Localisation :</label>
                <input id="localisation" type="text" name="localisation" class="w-full border border-gray-300 rounded-lg p-4 mt-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Ex. Casablanca, Maroc" value="{{ old('localisation') }}" required>
            </div>

            <!-- Disponibilité -->
            <div>
                <label for="disponibilites" class="block text-lg font-medium text-gray-800">📅 Disponibilité :</label>
                <select id="disponibilites" name="disponibilites" class="w-full border border-gray-300 rounded-lg p-4 mt-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="1" {{ old('disponibilites') == 1 ? 'selected' : '' }}>Disponible</option>
                    <option value="0" {{ old('disponibilites') == 0 ? 'selected' : '' }}>Indisponible</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white text-lg font-semibold py-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500">
                💾 Enregistrer l'annonce
            </button>
        </form>
    </div>

</body>
</html>
