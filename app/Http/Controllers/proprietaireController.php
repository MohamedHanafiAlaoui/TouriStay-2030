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
        $proprietaire = Auth::user();
        return view('proprietaire.profile.show', compact('proprietaire'));
    }


    public function editProfile()
    {
        $proprietaire = Auth::user(); // المستخدم الحالي
        return view('proprietaire.profile.edit', compact('proprietaire'));
    }

    public function updateProfile(Request $request)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $proprietaire = Auth::user();
        User::where('id', Auth::id())->update($validated);

        return redirect()->route('proprietaire.profile.show')->with('success', 'Votre profil a été mis à jour avec succès.');
    }



}
