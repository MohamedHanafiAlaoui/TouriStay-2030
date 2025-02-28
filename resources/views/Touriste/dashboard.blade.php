<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur - TouriStay Maroc</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Styles personnalisés */
        .profile-picture {
            width: 150px;
            height: 150px;
            border: 4px solid white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .hover\:underline:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- En-tête -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <a href="index.html" class="text-red-800 font-bold text-2xl">TouriStay Maroc</a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="reservations.html" class="text-red-800 hover:text-red-600">Mes Réservations</a>
                <a href="settings.html" class="text-red-800 hover:text-red-600">Paramètres</a>
                <a href="logout.html" class="bg-red-800 hover:bg-red-900 text-red-100 px-4 py-2 rounded-lg">Déconnexion</a>
            </div>
            <button class="md:hidden" id="mobile-menu-button">
                <svg class="w-6 h-6 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        <div class="hidden bg-white w-full py-2 px-4 md:hidden" id="mobile-menu">
            <a href="reservations.html" class="block py-2 text-red-800 hover:text-red-600">Mes Réservations</a>
            <a href="settings.html" class="block py-2 text-red-800 hover:text-red-600">Paramètres</a>
            <a href="logout.html" class="block py-2 text-red-800 hover:text-red-600">Déconnexion</a>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Section de l'en-tête du profil -->
            <div class="bg-gradient-to-r from-orange-400 to-red-500 p-6 text-white text-center">
                <div class="relative">
                    <img src="https://via.placeholder.com/150" alt="Photo de profil" class="profile-picture rounded-full mx-auto">
                    <button class="absolute bottom-2 right-1/2 transform translate-x-1/2 bg-white text-red-800 p-2 rounded-full shadow-md hover:bg-gray-100 transition-all">
                        <span>✏️</span> <!-- Icône de modification -->
                    </button>
                </div>
                <h1 class="text-3xl font-bold mt-4">John Doe</h1>
                <p class="text-gray-200">john.doe@example.com</p>
            </div>

            <!-- Section des informations du profil -->
            <div class="p-6 space-y-6">
                <!-- Informations personnelles -->
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold text-gray-800">Informations Personnelles</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nom Complet</p>
                            <p class="text-gray-800 font-semibold">John Doe</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="text-gray-800 font-semibold">john.doe@example.com</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Téléphone</p>
                            <p class="text-gray-800 font-semibold">+212 6 12 34 56 78</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Adresse</p>
                            <p class="text-gray-800 font-semibold">123 Rue Principale, Casablanca, Maroc</p>
                        </div>
                    </div>
                </div>

                <!-- Réservations récentes -->
                <div class="space-y-4">
                    <h2 class="text-2xl font-bold text-gray-800">Réservations Récentes</h2>
                    <div class="space-y-4">
                        <!-- Réservation 1 -->
                        <div class="bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-all">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-800 font-semibold">Riad Al Mamlaka</p>
                                    <p class="text-sm text-gray-500">12/10/2023 - 15/10/2023</p>
                                </div>
                                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Voir les détails</a>
                            </div>
                        </div>
                        <!-- Réservation 2 -->
                        <div class="bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-all">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-800 font-semibold">Appartement en Bord de Mer</p>
                                    <p class="text-sm text-gray-500">20/11/2023 - 25/11/2023</p>
                                </div>
                                <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline">Voir les détails</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bouton de modification du profil -->
                <div class="text-center">
                    <a href="edit-profile.html" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-all hover:scale-105">
                        <span class="mr-2">✏️</span> Modifier le Profil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script pour le menu mobile -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
