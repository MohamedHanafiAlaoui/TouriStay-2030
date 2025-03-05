<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - TouriStay Maroc</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .profile-picture {
            width: 150px;
            height: 150px;
            border: 4px solid white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- En-tête -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('touriste.index') }}" class="text-red-800 font-bold text-2xl font-moroccan">TouriStay Maroc</a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <!-- Si l'utilisateur est connecté -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 focus:outline-none">
                            <img src="{{ Auth::user()->avatar_url }}" alt="User Avatar" class="w-8 h-8 rounded-full">
                            <span class="text-red-800">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- Menu déroulant -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-red-800 hover:bg-red-50">Profil</a>
                            {{-- <a href="{{ route('reservations.index') }}" class="block px-4 py-2 text-red-800 hover:bg-red-50">Mes réservations</a> --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-red-800 hover:bg-red-50">Déconnexion</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Si l'utilisateur n'est pas connecté -->
                    <a href="{{ route('login') }}" class="text-red-800 hover:text-red-600">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-red-800 hover:bg-red-900 text-red-100 px-4 py-2 rounded-lg">Inscription</a>
                @endauth
            </div>
            <button class="md:hidden" id="mobile-menu-button">
                <svg class="w-6 h-6 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        <div class="hidden bg-white w-full py-2 px-4 md:hidden" id="mobile-menu">
            @auth
                <!-- Menu mobile pour utilisateur connecté -->
                <a href="{{ route('dashboard') }}" class="block py-2 text-red-800 hover:text-red-600">Profil</a>
                <a href="{{ route('touriste.annonces.index') }}" class="block py-2 text-red-800 hover:text-red-600">Mes réservations</a>                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left py-2 text-red-800 hover:text-red-600">Déconnexion</button>
                </form>
            @else
                <!-- Menu mobile pour utilisateur non connecté -->
                <a href="{{ route('login') }}" class="block py-2 text-red-800 hover:text-red-600">Connexion</a>
                <a href="{{ route('register') }}" class="block py-2 text-red-800 hover:text-red-600">Inscription</a>
            @endauth
        </div>
    </header>

    <!-- Profil utilisateur -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-6">

            <!-- Photo de profil -->
            <div class="text-center">
                <img id="profileImage" src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://via.placeholder.com/150' }}"
                     alt="Photo de profil" class="profile-picture rounded-full mx-auto">
                <input type="file" id="profilePicInput" class="hidden">
                <button id="editPicBtn" class="bg-gray-200 p-2 rounded-full mt-2">📸 Changer la photo</button>
            </div>

            <!-- Formulaire de modification -->
            <form action="{{ route('touriste.dashboard.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-500">Nom complet</label>
                        <input type="text" id="name" name="name" value="{{ Auth::user()->name }}"
                               class="w-full px-4 py-2 border rounded-lg bg-gray-100" disabled>
                    </div>
                    <div>
                        <label class="text-gray-500">E-mail</label>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}"
                               class="w-full px-4 py-2 border rounded-lg bg-gray-100" disabled>
                    </div>
                </div>

                <div class="text-center mt-6">
                    <button type="button" id="editBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                        ✏️ Modifier
                    </button>
                    <button type="submit" id="saveBtn" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg hidden">
                        💾 Enregistrer les modifications
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Script pour activer la modification -->
    <script>
        document.getElementById('editBtn').addEventListener('click', function() {
            let inputs = document.querySelectorAll('input[type="text"], input[type="email"]');
            inputs.forEach(input => input.disabled = false);
            inputs.forEach(input => input.classList.remove('bg-gray-100'));
            document.getElementById('editBtn').classList.add('hidden');
            document.getElementById('saveBtn').classList.remove('hidden');
        });

        document.getElementById('editPicBtn').addEventListener('click', function() {
            document.getElementById('profilePicInput').click();
        });
            document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
    </script>

</body>
</html>
