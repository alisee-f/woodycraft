<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;
use App\Models\Puzzle;

class PanierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer le panier en cours de l'utilisateur connecté
    $panier = Panier::where('user_id', auth()->id())
    ->where('statut', 'en_cours')
    ->with('puzzles')
    ->first();

    // Si aucun panier trouvé
    if (!$panier || $panier->puzzles->isEmpty()) {
    return view('paniers.index', ['puzzles' => [], 'total' => 0]);
    }

    // Calculer le total
    $total = 0;
    foreach ($panier->puzzles as $puzzle) {
    $total += $puzzle->pivot->quantite * $puzzle->prix;
    }

    return view('paniers.index', [
    'puzzles' => $panier->puzzles,
    'total' => $total
]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Puzzle $puzzle)
    {
        // Récupérer ou créer le panier en cours de l'utilisateur
    $panier = Panier::firstOrCreate([
        'user_id' => auth()->id(),
        'statut' => 'en_cours',
    ]);

    // Vérifier si le puzzle est déjà dans le panier
    if ($panier->puzzles()->where('puzzle_id', $puzzle->id)->exists()) {
        // Si déjà présent → on incrémente la quantité
        $panier->puzzles()->updateExistingPivot($puzzle->id, [
            'quantite' => \DB::raw('quantite + 1')
        ]);
    } else {
        // Sinon → on l'ajoute avec une quantité de 1
        $panier->puzzles()->attach($puzzle->id, ['quantite' => 1]);
    }

    return redirect()->back()->with('success', 'Puzzle ajouté au panier !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Puzzle $puzzle)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);
    
        $panier = Panier::where('user_id', auth()->id())
                        ->where('statut', 'en_cours')
                        ->firstOrFail();
    
        // Mise à jour de la quantité dans la table pivot
        $panier->puzzles()->updateExistingPivot($puzzle->id, [
            'quantite' => $request->quantite
        ]);
    
        return redirect()->route('paniers.index')->with('success', 'Quantité mise à jour !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puzzle $puzzle)
    {
        $panier = Panier::where('user_id', auth()->id())
                    ->where('statut', 'en_cours')
                    ->firstOrFail();

    // Retirer complètement le puzzle du panier
    $panier->puzzles()->detach($puzzle->id);

    return redirect()->route('paniers.index')->with('success', 'Produit supprimé du panier !');
    }
}
