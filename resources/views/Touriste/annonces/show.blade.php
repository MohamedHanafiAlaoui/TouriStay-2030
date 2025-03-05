<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Détails de l'annonce</title>

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

        .hover-scale {
            transition: transform 0.3s ease-in-out;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .gradient-overlay {
            background: linear-gradient(to right, rgba(251, 146, 60, 0.8), rgba(239, 68, 68, 0.8));
        }

        .shadow-soft {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .transition-all {
            transition: all 0.3s ease-in-out;
        }

        .hover-bg-gray-50:hover {
            background-color: #f9fafb;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            width: 90%;
            max-width: 400px;
        }
    </style>
</head>
<body class="bg-red-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-soft">
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
                <form method="POST" action="{{ route('logout') }}">
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

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="bg-white rounded-2xl shadow-soft overflow-hidden hover-scale">
            <div class="flex flex-col md:flex-row">
                <!-- Image Section -->
                <div class="w-full md:w-1/2">
                    <img src="{{ $annonce->image_url }}" alt="House Image" class="w-full h-full object-cover">
                </div>

                <!-- Information Section -->
                <div class="w-full md:w-1/2 p-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $annonce->name }}</h2>

                    <!-- Details with icons -->
                    <div class="space-y-4 mb-6">
                        <!-- Location -->
                        <div class="flex items-center">
                            <div class="icon-circle bg-blue-100 mr-4">
                                <span class="text-blue-600">📍</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Localisation</p>
                                <p class="text-gray-800 font-semibold">{{ $annonce->localisation }}</p>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="flex items-center">
                            <div class="icon-circle bg-green-100 mr-4">
                                <span class="text-green-600">💰</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Prix</p>
                                <p class="text-gray-800 font-semibold">{{ number_format($annonce->prix, 2) }} MAD</p>
                            </div>
                        </div>

                        <!-- Availability -->
                        <div class="flex items-center">
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

                    <!-- Description Section -->
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Description</h3>
                        <p class="text-gray-600">{{ $annonce->description }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="border-t border-gray-200 pt-6 flex space-x-4">
                        <!-- Buy Button -->
                        <button id="reserveButton" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition-all hover:scale-105 flex items-center justify-center">
                            <span class="mr-2">🛒</span> Réserver maintenant
                        </button>

                        <!-- Like Button -->
                        <button id="likeButton" class="like-button bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 px-6 rounded-lg transition-all hover:scale-105 flex items-center justify-center">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Reservation -->
    <div id="reservationModal" class="modal">
        <div class="modal-content">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Réserver cette annonce</h3>
            <form id="reservationForm" action="" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="startDate" class="block text-sm font-medium text-gray-700">Date de début</label>
                    <input type="date" id="startDate" name="startDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="endDate" class="block text-sm font-medium text-gray-700">Date de fin</label>
                    <input type="date" id="endDate" name="endDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <p class="text-sm text-gray-600">Prix par nuit : <span id="pricePerNight">{{ number_format($annonce->prix, 2) }} MAD</span></p>
                    <p class="text-lg font-bold text-gray-800">Total : <span id="totalPrice">0.00 MAD</span></p>
                </div>
                <input type="hidden" id="totalPriceHidden" name="totalPrice">
                <div class="flex justify-end space-x-4">
                    <button type="button" id="cancelButton" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">Annuler</button>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">Confirmer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-red-800 text-white py-6 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm">© 2030 TouriStay Maroc. Tous droits réservés.</p>
            <div class="flex justify-center space-x-4 mt-2">
                <a href="#" class="text-white hover:text-gray-200">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="text-white hover:text-gray-200">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-white hover:text-gray-200">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </footer>

    <!-- Script for Mobile Menu -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Script for Like Button
        const likeButton = document.getElementById('likeButton');
        likeButton.addEventListener('click', () => {
            likeButton.classList.toggle('liked');
            const icon = likeButton.querySelector('i');
            if (likeButton.classList.contains('liked')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
            }
        });

        // Script for Reservation Modal
        const reserveButton = document.getElementById('reserveButton');
        const reservationModal = document.getElementById('reservationModal');
        const cancelButton = document.getElementById('cancelButton');
        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
        const totalPriceElement = document.getElementById('totalPrice');
        const pricePerNight = {{ $annonce->prix }};

        // Open modal
        reserveButton.addEventListener('click', () => {
            reservationModal.style.display = 'flex';
        });

        // Close modal
        cancelButton.addEventListener('click', () => {
            reservationModal.style.display = 'none';
        });

        // Calculate total price
        const calculateTotalPrice = () => {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            const timeDiff = endDate - startDate;
            const daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
            if (daysDiff > 0) {
                const totalPrice = daysDiff * pricePerNight;
                totalPriceElement.textContent = `${totalPrice.toFixed(2)} MAD`;
                document.getElementById('totalPriceHidden').value = totalPrice.toFixed(2);
            } else {
                totalPriceElement.textContent = '0.00 MAD';
                document.getElementById('totalPriceHidden').value = '0.00';
            }
        };

        // Listen for date changes
        startDateInput.addEventListener('change', calculateTotalPrice);
        endDateInput.addEventListener('change', calculateTotalPrice);

        // Handle form submission
        const reservationForm = document.getElementById('reservationForm');
        reservationForm.addEventListener('submit', (e) => {
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;
            if (!startDate || !endDate) {
                e.preventDefault();
                alert('Veuillez sélectionner une date de début et une date de fin.');
                return;
            }
            const daysDiff = Math.ceil((new Date(endDate) - new Date(startDate)) / (1000 * 60 * 60 * 24));
            if (daysDiff <= 0) {
                e.preventDefault();
                alert('La date de fin doit être après la date de début.');
                return;
            }
            // Redirection vers la page de paiement
        });
    </script>
</body>
</html>
²
