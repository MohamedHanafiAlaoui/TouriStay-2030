<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class FavoriController extends Controller
{
    public function toggleFavorite($annonceId)
{

    $user = User::find(Auth::user()->id);

    $annonce = Annonce::findOrFail($annonceId);

    if ($user->favoris()->where('annonce_id', $annonceId)->exists()) {
        $user->favoris()->detach($annonceId);
        return Redirect::back()->with('status', 'Annonce removed from favorites.');

    } else {
        $user->favoris()->attach($annonceId);
        return Redirect::back()->with('status', 'Annonce added to favorites.');

    }

}
}
