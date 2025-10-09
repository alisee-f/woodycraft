<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


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
        if (!auth()->check()) {
            return redirect()->route('erreur.connexion');
        }
    
        // \Log::info('Ajout au panier : user=' . auth()->id() . ' puzzle=' . $puzzle->id);

        // Récupère le panier en cours
        $panier = Panier::where('user_id', auth()->id())
                        ->where('statut', 'en_cours')
                        ->first();
    
        // S’il n’existe pas, on le crée
        if (!$panier) {
            $panier = new Panier([
                'user_id' => auth()->id(),
                'statut' => 'en_cours',
            ]);
            $panier->save();
            // \Log::info('Nouveau panier créé : ' . $panier->id);
        }

        // \Log::info('Panier trouvé : ' . $panier->id);
    
        // Vérifie si le produit est déjà dans le panier
        $existant = $panier->puzzles()->where('puzzle_id', $puzzle->id)->first();
    
        if ($existant) {
            // Incrémente la quantité
            // \Log::info('Déjà présent, on incrémente');
            $panier->puzzles()->updateExistingPivot($puzzle->id, [
                'quantite' => \DB::raw('quantite + 1')
            ]);
        } else {
            // Ajoute un nouveau produit
            // \Log::info('Nouveau produit ajouté au panier');
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
            'quantite' => 'required|integer|min:0',
        ]);
    
        $panier = Panier::where('user_id', auth()->id())
                        ->where('statut', 'en_cours')
                        ->first();
    
        if (!$panier) {
            return redirect()->route('paniers.index')->with('error', 'Aucun panier trouvé.');
        }
    
        if (!$panier->puzzles()->where('puzzle_id', $puzzle->id)->exists()) {
            return redirect()->route('paniers.index');
        }
    
        // Si quantité = 0 → supprime uniquement ce produit
        if ($request->quantite == 0) {
            $panier->puzzles()->detach($puzzle->id);
        } else {
            // Sinon → met à jour la quantité
            $panier->puzzles()->updateExistingPivot($puzzle->id, [
                'quantite' => $request->quantite
            ]);
        }
    
        // Supprime le panier s’il est vide
        if ($panier->puzzles()->count() == 0) {
            $panier->delete();
        }
    
        return redirect()->route('paniers.index')->with('success', 'Panier mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puzzle $puzzle)
    {
        // Récupère le panier en cours du user connecté
        $panier = Panier::where('user_id', auth()->id())
        ->where('statut', 'en_cours')
        ->first();

        if (!$panier) {
        return redirect()->route('paniers.index')->with('error', 'Aucun panier trouvé.');
        }

        // Vérifie que le produit existe dans le panier
        if ($panier->puzzles()->where('puzzle_id', $puzzle->id)->exists()) {
        // On supprime SEULEMENT la ligne pivot, PAS le panier
        $panier->puzzles()->detach($puzzle->id);
        }

        // Si plus aucun produit dans le panier, on peut le supprimer complètement (optionnel)
        if ($panier->puzzles()->count() == 0) {
        $panier->delete();
        }

        return redirect()->route('paniers.index')->with('success', 'Produit supprimé du panier !');
    }

    
}
