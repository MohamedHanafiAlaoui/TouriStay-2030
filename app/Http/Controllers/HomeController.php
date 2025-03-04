<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirectUser()
    {

        $user = Auth::user();
        switch ($user->role_id) {
            case 1:

                return redirect()->route('admin.dashboard');
            case 2:
                return redirect()->route('proprietaire.dashboard');
            case 3:
                return redirect()->route('touriste.dashboard');
            default:

                return abort(403, 'Unauthorized access');
        }
    }
}
