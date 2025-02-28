<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Votre hébergement du futur au Maroc</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Styles personnalisés pour le thème marocain */
        .moroccan-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 30L30 0l30 30-30 30L0 30zm15-15l15-15h-15l-15 15h15zm0 30l15 15v-15l-15-15v15zm30 0l-15 15h15l15-15h-15zm0-30l-15-15v15l15 15V15z' fill='%23C8A675' fill-opacity='0.15' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .moroccan-arch {
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }

        .font-moroccan {
            font-family: 'Georgia', serif; /* Police stylisée pour le thème marocain */
        }

        /* Styles pour les icônes dans des cercles */
        .icon-circle {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #f3f4f6; /* Fond gris clair pour les icônes */
        }

        .icon-circle span {
            font-size: 1.2rem; /* Taille des icônes */
        }

        /* Transitions pour les effets de survol */
        .transition-all {
            transition: all 0.3s ease;
        }

        .hover\:scale-105:hover {
            transform: scale(1.05); /* Effet de zoom au survol */
        }
    </style>
</head>
<body class="bg-red-50 min-h-screen flex flex-col">
    <!-- En-tête -->
    <header class="bg-white shadow-md border-b border-red-200">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <a href="index.html" class="text-red-800 font-bold text-2xl font-moroccan">TouriStay Maroc</a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="pages/login.html" class="text-red-800 hover:text-red-600">Connexion</a>
                <a href="pages/register.html" class="bg-red-800 hover:bg-red-900 text-red-100 px-4 py-2 rounded-lg">Inscription</a>
            </div>
            <button class="md:hidden" id="mobile-menu-button">
                <svg class="w-6 h-6 text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        <div class="hidden bg-white w-full py-2 px-4 md:hidden" id="mobile-menu">
            <a href="pages/login.html" class="block py-2 text-red-800 hover:text-red-600">Connexion</a>
            <a href="pages/register.html" class="block py-2 text-red-800 hover:text-red-600">Inscription</a>
        </div>
    </header>

    <!-- Contenu principal -->
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all hover:scale-101">
            <!-- En-tête avec image en arrière-plan et dégradé existant -->
            <div class="bg-cover bg-center p-6 text-white relative" style="background-image: url('https://via.placeholder.com/800x400');">
                <div class="absolute inset-0 bg-gradient-to-r from-orange-400 to-red-500 opacity-80"></div> <!-- Dégradé existant avec opacité -->
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold font-moroccan">{{ $annonce->name }}</h2>
                    <div class="absolute top-0 right-0 p-4">
                        <span class="text-2xl">🏰</span> <!-- Icône décorative -->
                    </div>
                </div>
            </div>

            <!-- Section de contenu -->
            <div class="p-6 space-y-6">
                <!-- Détails avec icônes et espacement amélioré -->
                <div class="space-y-6">
                    <!-- Localisation -->
                    <div class="flex items-center bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-all">
                        <div class="icon-circle bg-blue-100 mr-4">
                            <span class="text-blue-600">📍</span> <!-- Icône de localisation -->
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Localisation</p>
                            <p class="text-gray-800 font-semibold">{{ $annonce->localisation }}</p>
                        </div>
                    </div>

                    <!-- Prix -->
                    <div class="flex items-center bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-all">
                        <div class="icon-circle bg-green-100 mr-4">
                            <span class="text-green-600">💰</span> <!-- Icône de prix -->
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Prix</p>
                            <p class="text-gray-800 font-semibold">{{ number_format($annonce->prix, 2) }} MAD</p>
                        </div>
                    </div>

                    <!-- Disponibilité -->
                    <div class="flex items-center bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-all">
                        <div class="icon-circle bg-purple-100 mr-4">
                            <span class="text-purple-600">📅</span> <!-- Icône de disponibilité -->
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Disponibilité</p>
                            <p class="{{ $annonce->disponibilites ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                                {{ $annonce->disponibilites ? 'Disponible' : 'Indisponible' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section d'action -->
                <div class="border-t border-gray-200 pt-6">
                    @if ($annonce->disponibilites)
                        <form action="{{ route('touriste.annonces.buy', $annonce->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-all hover:scale-105 flex items-center justify-center">
                                <span class="mr-2">🛒</span> Réserver cette annonce
                            </button>
                        </form>
                    @else
                        <div class="bg-red-100 border border-red-200 rounded-lg p-4 flex items-center">
                            <span class="text-2xl mr-3">⚠️</span> <!-- Icône d'avertissement -->
                            <p class="text-red-600 font-medium">Cette annonce n'est plus disponible et a déjà été réservée.</p>
                        </div>
                    @endif

                    <div class="mt-6 text-center">
                        <a href="{{ route('touriste.annonces.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-all hover:scale-105">
                            <span class="mr-2">⬅</span> Retour à la liste des annonces
                        </a>
                    </div>
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
