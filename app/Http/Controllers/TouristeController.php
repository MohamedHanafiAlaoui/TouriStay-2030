<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TouristeController extends Controller
{

    public function index(Request $request)
    {

        $perPage = $request->input('per_page', 10);

        $perPage = in_array($perPage, [4, 10, 25]) ? $perPage : 10;

        $query = Annonce::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;



            if (isset($search)) {
                $query->where('localisation', 'LIKE', '%' . $search . '%');



            }

            if (isset($search) ) {
                $query->orWhere('disponibilites', 'LIKE', '%' . $search . '%');
            }

            if (isset($search) && is_numeric($search)) {
                $query->orWhere('prix', '<=',$search);
            }


        }

        $annonces = $query->paginate($perPage);

        if ($annonces->isEmpty()) {
            $message = "Patience, aucune annonce ne correspond à votre recherche.";
        } else {
            $message = null;
        }
        return view('touriste.index', compact('annonces', 'perPage', 'message'));
    }



    public function indexAnnonces()
    {
        // Récupérer toutes les annonces disponibles
        $annonces = Annonce::where('disponibilites', true)->latest()->paginate(10);

        return view('touriste.annonces.index', compact('annonces'));
    }
    public function showAnnonce(Annonce $annonce)
    {
        return view('touriste.annonces.show', compact('annonce'));
    }

    public function buyAnnonce(Request $request, Annonce $annonce)
    {

        if (!$annonce->disponibilites) {
            return redirect()->route('touriste.annonces.show', $annonce)->with('error', 'Cette annonce est déjà réservée.');
        }

        $annonce->update([
            'id_Touriste' => Auth::id(),
            'disponibilites' => false
        ]);

        return redirect()->route('touriste.annonces.show', $annonce)->with('success', 'Félicitations ! Vous avez réservé cette annonce.');
    }

    public function dashboard()
    {

        $touriste = Auth::user();
        return view('touriste.dashboard', compact('touriste'));
    }
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $touriste = Auth::user();
        User::where('id', Auth::id())->update($validated);

        return redirect()->route('touriste.dashboard')->with('success', 'Votre profil a été mis à jour avec succès.');
    }


}
