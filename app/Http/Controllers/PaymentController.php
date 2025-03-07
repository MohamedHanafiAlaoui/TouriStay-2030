<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // Cette fonction gère l'affichage de la page de paiement
    public function checkout(Request $request)
    {
        


        // Récupération des données de la réservation
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $totalPrice = $request->totalPrice;
        $annonceId = $request->annonce_id;

        // Retourne la vue avec les informations nécessaires
        return view('touriste.payment.checkout', compact('startDate', 'endDate', 'totalPrice', 'annonceId'));
    }

    // Cette fonction gère le traitement du paiement
    public function processPayment(Request $request)
    {
        // Définir la clé API de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                "amount" => $request->amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Paiement depuis l'application Laravel"
            ]);

            if ($charge->status === 'succeeded') {


                $reservation = Reservation::create([
                    'user_id' => Auth::id(),
                    'annonce_id' => $request->annonce_id,
                    'start_date' => $request->startDate,
                    'end_date' => $request->endDate,
                    'total_price' => $request->amount,
                    'payment_status' => 'paid',
                ]);

                return view('touriste.dashboard');
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement du paiement : ' . $e->getMessage());

            dd($e->getMessage());
            return view('touriste.dashboard')->with('error', 'Une erreur s\'est produite : ' . $e->getMessage());
        }
    }
}
