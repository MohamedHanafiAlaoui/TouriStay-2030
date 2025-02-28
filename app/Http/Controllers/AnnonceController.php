<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annonces = Annonce::with(['proprietaire', 'touriste'])->get();
        return response()->json($annonces);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Formulaire de création d\'une annonce']);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'id_Propriétaire' => 'required|exists:users,id',
            'id_Touriste' => 'nullable|exists:users,id',
            'disponibilites' => 'required|boolean',
            'localisation' => 'required|string|max:255',
        ]);

        $annonce = Annonce::create($validated);

        return response()->json($annonce, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Annonce $annonce)
    {
        $annonce->load(['proprietaire', 'touriste']);
        return response()->json($annonce);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Annonce $annonce)
    {
        return response()->json($annonce);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Annonce $annonce)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'prix' => 'sometimes|numeric',
            'id_Propriétaire' => 'sometimes|exists:users,id',
            'id_Touriste' => 'nullable|exists:users,id',
            'disponibilites' => 'sometimes|boolean',
            'localisation' => 'sometimes|string|max:255',
        ]);

        $annonce->update($validated);

        return response()->json($annonce);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annonce $annonce)
    {
        $annonce->delete();
        return response()->json(['message' => 'Annonce supprimée avec succès']);
    }
}
