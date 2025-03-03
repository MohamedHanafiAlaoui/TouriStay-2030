<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon profil</title>

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





    <script>
        document.getElementById('dropdownBtn').addEventListener('click', function () {
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        });
    </script>


    <div class="container">
        <h1 style="text-align: center">Modifier mon profil</h1>

        <form action="{{ route('proprietaire.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg mx-auto">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nom" class="block text-gray-700 font-medium">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $proprietaire->nom) }}"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $proprietaire->email) }}"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200" required>
            </div>
{{--
            <div class="mb-4">
                <label for="telephone" class="block text-gray-700 font-medium">Téléphone</label>
                <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $proprietaire->telephone) }}"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium">Description</label>
                <textarea id="description" name="description"
                          class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">{{ old('description', $proprietaire->description) }}</textarea>
            </div> --}}

            {{-- <div class="mb-4">
                <label for="photo" class="block text-gray-700 font-medium">Photo de profil</label>
                <input type="file" id="photo" name="photo"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
            </div> --}}

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                Mettre à jour mon profil
            </button>
        </form>

    </div>

</body>
</html>
