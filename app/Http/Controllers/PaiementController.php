<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Adresse;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Panier;

class PaiementController extends Controller
{
    public function index($adresseId = null)
    {
        $user = Auth::user();

        // Si une adresse est passée dans l’URL, on la récupère
        if ($adresseId) {
            $adresse = Adresse::where('user_id', $user->id)
                              ->where('id', $adresseId)
                              ->first();
        } else {
            // Sinon, on prend la première adresse du user
            $adresse = $user->adresses()->first();
        }

        // Récupération du panier
        $panier = $user->paniers()->with('puzzles')->where('statut', 'en_cours')->first();

        $total = 0;
        if ($panier && $panier->puzzles) {
            foreach ($panier->puzzles as $puzzle) {
                $total += $puzzle->pivot->quantite * $puzzle->prix;
            }
        }

        return view('paiements.index', compact('adresse', 'panier', 'total'));
    }

        public function cheque($adresseId = null)
    {
        $user = Auth::user();

        $adresse = $adresseId
            ? $user->adresses()->where('id', $adresseId)->first()
            : $user->adresses()->first();

        $panier = $user->paniers()->with('puzzles')->where('statut', 'en_cours')->first();

        $total = 0;
        if ($panier && $panier->puzzles) {
            foreach ($panier->puzzles as $puzzle) {
                $total += $puzzle->pivot->quantite * $puzzle->prix;
            }
        }

        $panier->update([
            'statut' => 'valide',
            'mode_paiement' => 'cheque',
        ]);

        $pdf = Pdf::loadView('paiements.facture', compact('user', 'adresse', 'panier', 'total'))
            ->setPaper('a4', 'portrait')
            ->save(storage_path("app/public/factures/Facture-{$panier->id}.pdf"));

        return redirect()->route('avis.apresCommande', $panier->id);
    }

        public function paypal($adresseId = null)
    {
        $user = Auth::user();

        $panier = $user->paniers()->where('statut', 'en_cours')->first();
        $panier->update([
            'statut' => 'valide',
            'mode_paiement' => 'paypal',
        ]);
        return redirect()->route('avis.apresCommande', $panier->id);
    }

}
