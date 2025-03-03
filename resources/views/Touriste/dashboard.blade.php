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
            <a href="#" class="text-red-800 font-bold text-2xl">TouriStay Maroc</a>
            <button class="bg-red-800 hover:bg-red-900 text-white px-4 py-2 rounded-lg">
                Déconnexion
            </button>
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
    </script>

</body>
</html>
