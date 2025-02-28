<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'annonce - Propriétaire</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- For FontAwesome Icons -->
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-red-600 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <!-- Dashboard Link -->
                <a href="{{ route('proprietaire.dashboard') }}" class="text-white text-xl font-semibold">
                    🏠 Tableau de bord
                </a>
            </div>

            <div class="flex items-center space-x-6">
                <!-- Profile and User Info -->
                <div class="flex items-center text-white space-x-2">
                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?s=40' }}" alt="User Avatar" class="w-8 h-8 rounded-full">
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                </div>

                <!-- Dropdown for Profile and Logout -->
                <div class="relative">
                    <button class="text-white hover:text-gray-200 focus:outline-none">
                        <i class="fas fa-caret-down"></i>
                    </button>

                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-10 hidden">
                        <div class="py-2 px-4">
                            <!-- Show Profile Link -->
                            <a href="{{ route('profile.show') }}" class="block text-gray-700 hover:text-blue-500">👤 Voir le Profil</a>
                        </div>
                        <div class="py-2 px-4">
                            <!-- Edit Profile Link -->
                            <a href="{{ route('profile.edit') }}" class="block text-gray-700 hover:text-blue-500">📝 Modifier le Profil</a>
                        </div>
                        <div class="py-2 px-4 border-t">
                            <!-- Logout Link -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left text-red-600 hover:text-red-700">🚪 Se Déconnecter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <!-- Main Container -->
    <div class="container mx-auto px-6 py-8">

        <!-- Header -->
        <h2 class="text-2xl font-bold mb-6">🖊️ Modifier l'annonce: "{{ $annonce->name }}"</h2>

        <!-- Errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to Edit the Listing -->
        <form action="{{ route('proprietaire.annonces.update', $annonce->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div>
                <label class="block text-sm font-medium">🏷️ Nom de l'annonce :</label>
                <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name', $annonce->name) }}" required>
            </div>

            <!-- Price Field -->
            <div>
                <label class="block text-sm font-medium">💰 Prix (MAD) :</label>
                <input type="number" name="prix" class="w-full border rounded p-2" value="{{ old('prix', $annonce->prix) }}" required>
            </div>

            <!-- Location Field -->
            <div>
                <label class="block text-sm font-medium">📍 Localisation :</label>
                <input type="text" name="localisation" class="w-full border rounded p-2" value="{{ old('localisation', $annonce->localisation) }}" required>
            </div>

            <!-- Availability Field -->
            <div>
                <label class="block text-sm font-medium">📅 Disponibilité :</label>
                <select name="disponibilites" class="w-full border rounded p-2">
                    <option value="1" {{ $annonce->disponibilites ? 'selected' : '' }}>Disponible</option>
                    <option value="0" {{ !$annonce->disponibilites ? 'selected' : '' }}>Indisponible</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                💾 Mettre à jour l'annonce
            </button>
        </form>
    </div>

    <!-- Script for Dropdown -->
    <script>
        const dropdownButton = document.querySelector('nav .relative button');
        const dropdownMenu = document.querySelector('nav .relative .absolute');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
