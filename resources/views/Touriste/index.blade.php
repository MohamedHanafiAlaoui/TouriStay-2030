

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Votre hébergement du futur au Maroc</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Ajout de styles personnalisés pour le thème marocain */
        .moroccan-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 30L30 0l30 30-30 30L0 30zm15-15l15-15h-15l-15 15h15zm0 30l15 15v-15l-15-15v15zm30 0l-15 15h15l15-15h-15zm0-30l-15-15v15l15 15V15z' fill='%23C8A675' fill-opacity='0.15' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .moroccan-arch {
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }

        .font-moroccan {
            font-family: 'Georgia', serif;
        }
    </style>
</head>
<body class="bg-red-50 min-h-screen flex flex-col">
    <!-- En-tête -->
    <header class="bg-white shadow-md">
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

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-red-800 to-red-600 py-20 text-red-50 moroccan-pattern">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 font-moroccan">Découvrez le Maroc authentique</h1>
            <p class="text-xl md:text-2xl mb-8">Riads traditionnels et expériences uniques au cœur du Maroc</p>

            <!-- Barre de recherche -->
            <div class="bg-white rounded-lg shadow-lg p-4 md:p-6 max-w-4xl mx-auto border-2 border-red-200">
                <form action="{{ route('touriste.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label for="search" class="block text-red-800 text-sm font-medium mb-1">Rechercher par destination et date</label>
                        <input type="text" id="search" name="search" placeholder="Exemple: Marrakech 2025-03-10"
                            class="w-full px-4 py-2 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 text-red-900"
                            value="{{ request('search') }}">
                    </div>

                    <div class="md:self-end">
                        <button type="submit" class="w-full md:w-auto bg-red-700 hover:bg-red-800 text-red-50 font-medium py-2 px-6 rounded-lg transition duration-200">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Annonces populaires -->
    <section class="py-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-red-900 font-moroccan">Destinations populaires au Maroc</h2>

            <!-- Sélection du nombre d'annonces par page -->
            <form method="GET" action="{{ route('touriste.index') }}" class="flex items-center space-x-2">
                <label for="items-per-page" class="text-sm text-red-700">Afficher :</label>
                <select name="per_page" id="items-per-page" class="border border-red-300 rounded-md px-2 py-1 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-red-50 text-red-800" onchange="this.form.submit()">
                    <option value="4" {{ request('per_page') == 4 ? 'selected' : '' }}>4</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                </select>
            </form>
        </div>

        <!-- Liste des annonces -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($annonces as $annonce)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ $annonce->image_url }}" alt="{{ $annonce->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <!-- Évaluation -->
                    <div class="flex items-center text-red-500 mb-1">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="ml-1">{{ $annonce->rating ?? '0.0' }}</span>
                        <span class="text-red-700 text-sm ml-1">({{ $annonce->reviews_count ?? '0' }} avis)</span>
                    </div>
                    <h3 class="text-lg font-semibold text-red-900 mb-1">{{ $annonce->name }}</h3>
                    <p class="text-red-700 mb-2">{{ $annonce->localisation }}</p>
                    <p class="text-red-900 font-bold">{{ $annonce->prix }}€ <span class="text-red-700 font-normal">/ nuit</span></p>

                    <!-- Bouton Voir les détails -->
                    <a href="{{ route('touriste.annonces.show', $annonce->id) }}" class="text-blue-500 hover:underline">Voir les détails</a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-10">
            {{ $annonces->appends(['per_page' => $perPage])->links() }}
        </div>
    </section>

    <!-- Avantages -->
    <section class="py-12 bg-red-100 moroccan-pattern">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-red-900 text-center mb-10 font-moroccan">Pourquoi choisir TouriStay Maroc</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-red-600">
                    <div class="text-red-700 text-3xl mb-4">🏰</div>
                    <h3 class="text-xl font-semibold mb-2 text-red-800">Hébergements authentiques</h3>
                    <p class="text-red-700">Riads traditionnels, kasbahs et maisons d'hôtes sélectionnés avec soin pour une immersion totale.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-red-600">
                    <div class="text-red-700 text-3xl mb-4">🧠</div>
                    <h3 class="text-xl font-semibold mb-2 text-red-800">Expériences culturelles</h3>
                    <p class="text-red-700">Découvrez l'artisanat local, la cuisine traditionnelle et les coutumes marocaines avec nos hôtes.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-red-600">
                    <div class="text-red-700 text-3xl mb-4">🌟</div>
                    <h3 class="text-xl font-semibold mb-2 text-red-800">Service personnalisé</h3>
                    <p class="text-red-700">Assistance locale 24/7, conseils de voyage et recommandations par des experts du Maroc.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section régions -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-red-900 text-center mb-10 font-moroccan">Explorez les régions du Maroc</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="relative group overflow-hidden rounded-lg shadow-lg h-64">
                    <img src="https://via.placeholder.com/400x300" alt="Marrakech" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-red-900 to-transparent opacity-80"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-red-50">
                        <h3 class="text-xl font-bold mb-1">Marrakech</h3>
                        <p class="text-sm">La ville rouge aux mille palais</p>
                    </div>
                </div>

                <div class="relative group overflow-hidden rounded-lg shadow-lg h-64">
                    <img src="https://via.placeholder.com/400x300" alt="Fès" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-red-900 to-transparent opacity-80"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-red-50">
                        <h3 class="text-xl font-bold mb-1">Fès</h3>
                        <p class="text-sm">La capitale spirituelle et culturelle</p>
                    </div>
                </div>

                <div class="relative group overflow-hidden rounded-lg shadow-lg h-64">
                    <img src="https://via.placeholder.com/400x300" alt="Chefchaouen" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-red-900 to-transparent opacity-80"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-red-50">
                        <h3 class="text-xl font-bold mb-1">Chefchaouen</h3>
                        <p class="text-sm">La ville bleue nichée dans les montagnes</p>
                    </div>
                </div>

                <div class="relative group overflow-hidden rounded-lg shadow-lg h-64">
                    <img src="https://via.placeholder.com/400x300" alt="Essaouira" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-red-900 to-transparent opacity-80"></div>
                    <div class="absolute bottom-0 left-0 p-4 text-red-50">
                        <h3 class="text-xl font-bold mb-1">Essaouira</h3>
                        <p class="text-sm">La cité des alizés en bord de mer</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="#" class="inline-block px-6 py-3 bg-red-700 hover:bg-red-800 text-red-50 rounded-lg font-medium transition duration-200">Découvrir toutes les régions</a>
            </div>
        </div>
    </section>

    <!-- Témoignages -->
    <section class="py-12 bg-red-800 text-red-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 font-moroccan">Ce que disent nos voyageurs</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-red-700 p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-red-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>
                    </div>
                    <p class="italic mb-4">"Notre riad à Marrakech était un véritable havre de paix. L'accueil chaleureux et les conseils de notre hôte nous ont permis de découvrir le Maroc authentique."</p>
                    <div class="font-semibold">Sophie et Pierre, France</div>
                </div>

                <div class="bg-red-700 p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-red-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>
                    </div>
                    <p class="italic mb-4">"La kasbah près de Ouarzazate était magnifique. Les paysages désertiques, l'architecture traditionnelle et la cuisine locale ont rendu notre séjour inoubliable."</p>
                    <div class="font-semibold">John et Maria, États-Unis</div>
                </div>

                <div class="bg-red-700 p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="flex text-red-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>
                    </div>
                    <p class="italic mb-4">"L'expérience à Chefchaouen était magique. Les ruelles bleues, le calme des montagnes et notre maison traditionnelle ont fait de ce séjour un moment unique."</p>
                    <div class="font-semibold">Ahmed et Fatima, Émirats Arabes Unis</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Abonnement à la newsletter -->
    <section class="py-12 bg-red-100">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-red-900 mb-4 font-moroccan">Restez informé des meilleures offres</h2>
            <p class="text-red-700 mb-6 max-w-2xl mx-auto">Inscrivez-vous à notre newsletter pour recevoir des idées de voyage au Maroc, des offres exclusives et des conseils de voyage personnalisés.</p>

            <form class="max-w-md mx-auto">
                <div class="flex flex-col md:flex-row gap-2">
                    <input type="email" placeholder="Votre adresse email" class="flex-1 px-4 py-2 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <button type="submit" class="bg-red-700 hover:bg-red-800 text-red-50 px-6 py-2 rounded-lg font-medium transition duration-200">S'abonner</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-red-900 text-red-100 py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 font-moroccan">TouriStay Maroc</h3>
                    <p class="text-red-200 mb-4">Votre plateforme d'hébergements authentiques et d'expériences uniques au Maroc.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-red-200 hover:text-red-50">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path></svg>
                        </a>
                        <a href="#" class="text-red-200 hover:text-red-50">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"></path></svg>
                        </a>
                        <a href="#" class="text-red-200 hover:text-red-50">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Découvrir</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-red-200 hover:text-red-50">Comment ça marche</a></li>
                        <li><a href="#" class="text-red-200 hover:text-red-50">Destinations populaires</a></li>
                        <li><a href="#" class="text-red-200 hover:text-red-50">Types d'hébergements</a></li>
                        <li><a href="#" class="text-red-200 hover:text-red-50">Expériences exclusives</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Hôtes</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-red-200 hover:text-red-50">Devenir hôte</a></li>
                        <li><a href="#" class="text-red-200 hover:text-red-50">Guide de l'hôte</a></li>
                        <li><a href="#" class="text-red-200 hover:text-red-50">Responsabilités</a></li>
                        <li><a href="#" class="text-red-200 hover:text-red-50">Communauté d'hôtes</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Assistance</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-red-200 hover:text-red-50">Centre d'aide</a></li>
                        <li><a href="#" class="text-red-200 hover:text-red-50">Contactez-nous</a></li>
                        <li><a href="#" class="text-red-200 hover:text-red-50">Conditions d'utilisation</a></li>
                        <li><a href="#" class="text-red-200 hover:text-red-50">Politique de confidentialité</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-red-800 mt-8 pt-8 text-center">
                <p>&copy; 2030 TouriStay Maroc. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Script pour les fonctionnalités dynamiques -->
    <script>
        // Données d'exemple pour les annonces
        const listings = [
            {
                id: 1,
                title: "Riad traditionnel au cœur de la médina",
                location: "Marrakech",
                price: 120,
                rating: 4.8,
                reviews: 125,
                image: "https://via.placeholder.com/300x200"
            },
            {
                id: 2,
                title: "Kasbah rénovée avec vue sur les montagnes",
                location: "Ouarzazate",
                price: 95,
                rating: 4.7,
                reviews: 89,
                image: "https://via.placeholder.com/300x200"
            },
            {
                id: 3,
                title: "Maison bleue traditionnelle",
                location: "Chefchaouen",
                price: 85,
                rating: 4.9,
                reviews: 112,
                image: "https://via.placeholder.com/300x200"
            },
            {
                id: 4,
                title: "Appartement moderne vue sur mer",
                location: "Essaouira",
                price: 75,
                rating: 4.6,
                reviews: 78,
                image: "https://via.placeholder.com/300x200"
            },
            {
                id: 5,
                title: "Dar au cœur de la médina ancienne",
                location: "Fès",
                price: 110,
                rating: 4.8,
                reviews: 145,
                image: "https://via.placeholder.com/300x200"
            },
            {
                id: 6,
                title: "Villa avec piscine privée",
                location: "Agadir",
                price: 150,
                rating: 4.9,
                reviews: 92,
                image: "https://via.placeholder.com/300x200"
            },
            {
                id: 7,
                title: "Chambre d'hôtes dans palmeraie",
                location: "Zagora",
                price: 65,
                rating: 4.7,
                reviews: 64,
                image: "https://via.placeholder.com/300x200"
            },
            {
                id: 8,
                title: "Tente berbère de luxe dans le désert",
                location: "Merzouga",
                price: 130,
                rating: 4.9,
                reviews: 110,
                image: "https://via.placeholder.com/300x200"
            }
        ];

        // Variables pour la pagination
        let currentPage = 1;
        let itemsPerPage = 4;

        // Sélection des éléments DOM
        const listingsContainer = document.getElementById("listings-container");
        const prevPageBtn = document.getElementById("prev-page");
        const nextPageBtn = document.getElementById("next-page");
        const currentPageEl = document.getElementById("current-page");
        const itemsPerPageSelect = document.getElementById("items-per-page");
        const mobileMenuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");

        // Fonction pour afficher les annonces sur la page actuelle

    </script>
</body>

</html>
