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
            'adresse' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        Adresse::create([
            'user_id' => $user->id,
            'numero' => $request->numero,
            'adresse' => $request->adresse,
        ]);
        

        return redirect()->route('adresses.show')->with('success', 'Adresse enregistrée !');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Adresse $adresse)
    {
        $user = Auth::user();
        $adresse = $user->adresse;
        return view('adresses.show', compact('adresse'));
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
        $this->authorize('update', $adresse); // sécurité (facultatif)

        $request->validate([
            'adresse' => 'required|string|max:255',
        ]);

        $adresse->update([
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('adresses.show')->with('success', 'Adresse modifiée avec succès.');
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
