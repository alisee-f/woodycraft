<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Adresse;

class AdresseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adresse = Adresse::where('user_id', auth()->id())->latest()->first();

        return view('adresses.index', compact('adresse'));
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|integer',
            'rue' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:20',
            'pays' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Création de l’adresse
        Adresse::create([
            'user_id' => $user->id,
            'numero' => $validated['numero'],
            'rue' => $validated['rue'],
            'ville' => $validated['ville'],
            'code_postal' => $validated['code_postal'],
            'pays' => $validated['pays'] ?? 'France',
        ]);

        return redirect()->route('adresses.show')->with('success', 'Adresse enregistrée avec succès !');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Adresse $adresse)
    {
        $user = Auth::user();
        $adresses = Adresse::where('user_id', $user->id)->get();
    
        return view('adresses.show', compact('adresses'));
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
    public function update(Request $request, Adresse $adresse)
    {
        $validated = $request->validate([
            'numero' => 'required|integer',
            'rue' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:20',
            'pays' => 'nullable|string|max:255',
        ]);

        $adresse->update($validated);

        return redirect()->route('adresses.show')->with('success', 'Adresse mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adresse $adresse)
    {
        $adresse->delete();
        return redirect()->route('adresses.show')->with('success', 'Adresse supprimée avec succès.');
    }
}
