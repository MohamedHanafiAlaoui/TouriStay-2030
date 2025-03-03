<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>

        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    </head>
<body>

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

    <!-- JavaScript للقائمة المنسدلة -->
    <script>
        document.getElementById('dropdownBtn').addEventListener('click', function () {
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        });
    </script>






<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-6">Mon Profil</h1>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <p class="text-lg"><strong>Nom:</strong> {{ $proprietaire->name }}</p>
        <p class="text-lg"><strong>Email:</strong> {{ $proprietaire->email }}</p>
        {{-- <p class="text-lg"><strong>Téléphone:</strong> {{ $proprietaire->telephone }}</p> --}}
        {{-- <p class="text-lg"><strong>Description:</strong> {{ $proprietaire->description }}</p> --}}

        @if($proprietaire->photo)
            <img src="{{ asset('storage/proprietaires/' . $proprietaire->photo) }}"
                 alt="Photo de profil"
                 class="mt-4 w-32 h-32 rounded-full border-2 border-gray-300">
        @else
            <p class="text-gray-500">Aucune photo de profil</p>
        @endif

        <a href="{{ route('proprietaire.profile.edit') }}"
           class="block mt-4 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
           ✏️ Modifier mon profil
        </a>
    </div>
</div>


</body>
</html>
