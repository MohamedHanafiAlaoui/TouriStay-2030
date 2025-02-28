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


    <section class="py-12">
    <h2 class="text-2xl font-bold mb-6"> Annonces disponibles</h2>

    @if ($annonces->isEmpty())
        <p class="text-gray-500">Aucune annonce disponible pour le moment.</p>
    @else
        {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-bold">{{ $annonce->name }}</h3>
                    <p class="text-gray-700"> {{ $annonce->localisation }}</p>
                    <p class="text-blue-600 font-semibold"> {{ number_format($annonce->prix, 2) }} MAD</p>
                    <a href="#" class="text-sm text-blue-500 hover:underline">Voir les détails</a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $annonces->links() }}
        </div> --}}

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="listings-container">
            @foreach ($annonces as $annonce)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="" alt="" class="w-full h-48 object-cover">
                <div class="p-4">
                    <div class="flex items-center text-red-500 mb-1">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="ml-1">4</span>
                        <span class="text-red-700 text-sm ml-1">5</span>
                    </div>
                    <h3 class="text-lg font-semibold text-red-900 mb-1">{{ $annonce->name }}</h3>
                    <p class="text-red-700 mb-2">{{ $annonce->localisation }}</p>
                    <p class="text-red-900 font-bold">{{ number_format($annonce->prix, 2) }} MAD <span class="text-red-700 font-normal">/ nuit</span></p>
                    <a href="{{ route('touriste.annonces.show', $annonce->id) }}" class="text-sm text-blue-500 hover:underline">
                        Voir les détails
                    </a>

                    {{-- <a href="{{route('/annonces/{{$annonce->id}}')}}" class="text-sm text-blue-500 hover:underline">Voir les détails</a> --}}
                </div>
            </div>
            @endforeach
        </div>
    @endif
</section>



</body>

</html>

