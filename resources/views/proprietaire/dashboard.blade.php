<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Propriétaire</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- For FontAwesome Icons -->
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-red-600 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <!-- رابط لوحة التحكم -->
            <a href="{{ route('proprietaire.dashboard') }}" class="text-white text-xl font-semibold">
                🏠 Tableau de bord
            </a>

            <!-- روابط التنقل -->
            <div class="flex space-x-6">
                <a href="{{ route('proprietaire.profile.show') }}" class="text-white hover:text-gray-200">
                    📌 Mon Profil
                </a>
                <a href="{{ route('proprietaire.annonces.create') }}" class="text-white hover:text-gray-200">
                    ➕ Ajouter Annonce
                </a>
            </div>

            <!-- قائمة الملف الشخصي -->
            <div class="relative">
                <button id="dropdownBtn" class="flex items-center text-white space-x-2 focus:outline-none">
                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?s=40' }}"
                         alt="User Avatar" class="w-8 h-8 rounded-full">
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                    <i class="fas fa-caret-down"></i>
                </button>

                <!-- القائمة المنسدلة -->
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-10 hidden">
                    <a href="{{ route('proprietaire.profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        📝 Profil
                    </a>
                    <a href="{{ route('proprietaire.profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        ✏️ Modifier Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="border-t">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                            🚪 Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>


    <script>
        document.getElementById('dropdownBtn').addEventListener('click', function () {
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        });
    </script>


    <!-- Main Container -->
    <div class="container mx-auto px-6 py-8">

        <!-- Header -->
        <h2 class="text-4xl font-bold text-gray-800 mb-8">
            <span class="text-blue-500">🏡</span> Tableau de bord - Propriétaire
        </h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6">
                <p class="text-lg">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Add New Listing Button -->
        <div class="mb-6">
            <a href="{{ route('proprietaire.annonces.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-plus-circle mr-2"></i> Ajouter une nouvelle annonce
            </a>
        </div>

        <!-- Listings Table -->
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            @if($annonces->isEmpty())
                <div class="text-center p-8">
                    <p class="text-lg text-gray-600">😔 Vous n’avez encore publié aucune annonce.</p>
                </div>
            @else
                <table class="min-w-full text-left table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-3 px-6 text-sm font-semibold text-gray-600">🏷️ Nom</th>
                            <th class="py-3 px-6 text-sm font-semibold text-gray-600">💰 Prix (MAD)</th>
                            <th class="py-3 px-6 text-sm font-semibold text-gray-600">📍 Localisation</th>
                            <th class="py-3 px-6 text-sm font-semibold text-gray-600">📅 Disponibilité</th>
                            <th class="py-3 px-6 text-sm font-semibold text-gray-600">⚙️ Actions</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm">
                        @foreach($annonces as $annonce)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 px-6">{{ $annonce->name }}</td>
                                <td class="py-4 px-6">{{ $annonce->prix }} MAD</td>
                                <td class="py-4 px-6">{{ $annonce->localisation }}</td>
                                <td class="py-4 px-6">
                                    @if($annonce->disponibilites)
                                        <span class="text-green-500 font-semibold">Disponible</span>
                                    @else
                                        <span class="text-red-500 font-semibold">Indisponible</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 flex space-x-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('proprietaire.annonces.edit', $annonce->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white py-2 px-4 rounded-lg flex items-center transition duration-300">
                                        <i class="fas fa-edit mr-2"></i> Modifier
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg flex items-center transition duration-300">
                                            <i class="fas fa-trash-alt mr-2"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
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
