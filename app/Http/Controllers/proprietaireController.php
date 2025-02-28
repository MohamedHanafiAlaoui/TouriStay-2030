<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProprietaireController extends Controller
{
    public function index()
    {
        // Récupérer les annonces du propriétaire actuel
        $annonces = Annonce::where('id_Propriétaire', Auth::id())->get();

        return view('proprietaire.dashboard', compact('annonces'));
    }

    public function createAnnonce()
    {
        return view('proprietaire.annonces.ajouter');
    }

    public function storeAnnonce(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'localisation' => 'required|string|max:255',
            'disponibilites' => 'required|boolean',
        ]);

        $validated['id_Propriétaire'] = Auth::id();

        Annonce::create($validated);

        return redirect()->route('proprietaire.dashboard')->with('success', 'Annonce ajoutée avec succès 🚀');
    }

    public function editAnnonce(Annonce $annonce)
    {
        // Vérifier que l'annonce appartient au propriétaire actuel
        if ($annonce->id_Propriétaire != Auth::id()) {
            return redirect()->route('proprietaire.dashboard')->with('error', 'Vous n\'avez pas l\'autorisation de modifier cette annonce.');
        }

        return view('proprietaire.annonces.edit', compact('annonce'));
    }

    public function updateAnnonce(Request $request, Annonce $annonce)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'localisation' => 'required|string|max:255',
            'disponibilites' => 'required|boolean',
        ]);

        // Vérifier que l'annonce appartient au propriétaire actuel
        if ($annonce->id_Propriétaire != Auth::id()) {
            return redirect()->route('proprietaire.dashboard')->with('error', 'Vous n\'avez pas l\'autorisation de modifier cette annonce.');
        }

        // Mise à jour de l'annonce
        $annonce->update($validated);

        return redirect()->route('proprietaire.dashboard')->with('success', 'Annonce mise à jour avec succès 🚀');
    }

    public function showProfile()
    {
        $proprietaire = Auth::user(); // Utiliser l'utilisateur authentifié (le propriétaire)

        return view('proprietaire.profile', compact('proprietaire'));
    }

    // Modifier le profil du propriétaire
    public function editProfile()
    {
        $proprietaire = Auth::user(); // Utiliser l'utilisateur authentifié (le propriétaire)

        return view('proprietaire.editProfile', compact('proprietaire'));
    }

    public function updateProfile(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'telephone' => 'nullable|string|max:15',
        'description' => 'nullable|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de la photo
    ]);

    $proprietaire = Auth::user();
    // Si l'utilisateur télécharge une nouvelle photo
    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne photo (si elle existe)
        if ($proprietaire->photo) {
            // Vérifier si le fichier existe et supprimer
            $oldPhotoPath = public_path('storage/proprietaires/' . $proprietaire->photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }

        // Stocker la nouvelle photo
        $photoPath = $request->file('photo')->store('public/proprietaires');
        $proprietaire->photo = basename($photoPath); // Sauvegarder seulement le nom du fichier
    }

    // Mettre à jour les informations du propriétaire dans la base de données
    $proprietaire->update($validated);

    // Rediriger vers la page de profil avec un message de succès
    return redirect()->route('proprietaire.profile')->with('success', 'Votre profil a été mis à jour avec succès.');
}


}
