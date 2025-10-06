<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdresseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adresse = Adresse::where('user_id', auth()->id())->latest()->first();

        return view('adresse.index', compact('adresse'));
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
        $request->validate([
            'rue' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
            'pays' => 'required|string|max:50',
        ]);

        Adresse::create([
            'user_id' => auth()->id(),
            'numero' => $request->numero,
            'rue' => $request->rue,
            'ville' => $request->ville,
            'code_postal' => $request->code_postal,
            'pays' => $request->pays,
        ]);

        return redirect()->route('adresse.index')->with('success', 'Adresse enregistrée.');
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
    public function update(Request $request, string $id)
    {
        $this->authorize('update', $adresse); // sécurité (facultatif)

        $request->validate([
            'numero' => 'required|string|max:255',
            'rue' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
            'pays' => 'required|string|max:50',
        ]);

        $adresse->update($request->all());

        return redirect()->route('adresse.index')->with('success', 'Adresse mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
