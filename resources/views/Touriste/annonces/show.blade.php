<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Votre hébergement du futur au Maroc</title>

    <!-- Font Awesome 6 Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        /* Custom styles */
        .icon-circle {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="bg-red-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-md border-b border-red-200">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <a href="index.html" class="text-red-800 font-bold text-2xl">TouriStay Maroc</a>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <a href="pages/login.html" class="text-red-800 hover:text-red-600">Connexion</a>
                <a href="pages/register.html" class="bg-red-800 hover:bg-red-900 text-red-100 px-4 py-2 rounded-lg">Inscription</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all hover:scale-101">
            <!-- Header with background image -->
            <div class="bg-cover bg-center p-6 text-white relative" style="background-image: url('https://via.placeholder.com/800x400');">
                <div class="absolute inset-0 bg-gradient-to-r from-orange-400 to-red-500 opacity-80"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold">{{ $annonce->name }}</h2>
                    <div class="absolute top-0 right-0 p-4">
                        <span class="text-2xl">🏰</span>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="p-6 space-y-6">
                <!-- Details with icons -->
                <div class="space-y-6">
                    <!-- Location -->
                    <div class="flex items-center bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-all">
                        <div class="icon-circle bg-blue-100 mr-4">
                            <span class="text-blue-600">📍</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Localisation</p>
                            <p class="text-gray-800 font-semibold">{{ $annonce->localisation }}</p>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="flex items-center bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-all">
                        <div class="icon-circle bg-green-100 mr-4">
                            <span class="text-green-600">💰</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Prix</p>
                            <p class="text-gray-800 font-semibold">{{ number_format($annonce->prix, 2) }} MAD</p>
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="flex items-center bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-all">
                        <div class="icon-circle bg-purple-100 mr-4">
                            <span class="text-purple-600">📅</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Disponibilité</p>
                            <p class="{{ $annonce->disponibilites ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                                {{ $annonce->disponibilites ? 'Disponible' : 'Indisponible' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Section -->
                <div class="border-t border-gray-200 pt-6">
                    <!-- Favorite Toggle Button -->
                    <form action="{{ route('touriste.annonces.favorite.toggle', $annonce->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-2xl transition-all hover:scale-105">
                            <i class="fa-solid {{ auth()->user()->favoris()->where('annonce_id', $annonce->id)->exists() ? 'fa-heart text-red-600' : 'fa-regular fa-heart text-gray-400' }}"></i>
                        </button>
                    </form>

                    <!-- Reserve Button -->
                    @if ($annonce->disponibilites)
                        <form action="{{ route('touriste.annonces.buy', $annonce->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-all hover:scale-105 flex items-center justify-center">
                                <span class="mr-2">🛒</span> Réserver cette annonce
                            </button>
                        </form>
                    @else
                        <div class="bg-red-100 border border-red-200 rounded-lg p-4 flex items-center">
                            <span class="text-2xl mr-3">⚠️</span>
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
</body>
</html>
