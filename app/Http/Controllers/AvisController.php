<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Puzzle;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function store(Request $request, $puzzle_id)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'required|string|max:1000',
        ]);

        Avis::create([
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'user_id' => Auth::id(),
            'puzzle_id' => $puzzle_id,
        ]);

        return redirect()->back()->with('success', 'Merci pour votre avis !');
    }

    public function apresCommande($id)
    {
        $panier = Panier::with(['appartient.puzzle'])
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->where('statut', 'valide') // ou "commandé", selon ta logique
            ->firstOrFail();

        return view('avis.apreScommande', compact('panier'));
    }
}
