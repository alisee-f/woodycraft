<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Puzzle;

class PuzzleController extends Controller
{
    /**
     * Affiche la liste de tous les puzzles.
     */
    public function index()
    {
        $puzzles = Puzzle::all();
        return view('puzzles.index', compact('puzzles'));
    }

    /**
     * Affiche le formulaire de création d'un puzzle.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('puzzles.create', compact('categories'));
    }

    /**
     * Enregistre un nouveau puzzle en base.
     */
    public function store(Request $request)
    {
        // Debug : vérifier que les données arrivent
        // dd($request->all());

        $data = $request->validate([
            'nom' => 'required|max:255',
            'description' => 'required|max:500',
            'image' => 'required|max:255',
            'prix' => 'required|numeric|between:0,999.99',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        // Création du puzzle
        Puzzle::create($data);

        return redirect()->route('puzzles.index')->with('message', "Le puzzle a bien été créé !");
    }

    /**
     * Affiche les détails d'un puzzle.
     */
    public function show(Puzzle $puzzle)
    {
        return view('puzzles.show', compact('puzzle'));
    }

    /**
     * Affiche le formulaire d'édition d'un puzzle.
     */
    public function edit(Puzzle $puzzle)
    {
        $categories = Categorie::all();
        return view('puzzles.edit', compact('puzzle', 'categories'));
    }

    /**
     * Met à jour un puzzle existant.
     */
    public function update(Request $request, Puzzle $puzzle)
    {
        $data = $request->validate([
            'nom' => 'required|max:255',
            'description' => 'required|max:500',
            'image' => 'required|max:255',
            'prix' => 'required|numeric|between:0,999.99',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $puzzle->update($data);

        return back()->with('message', "Le puzzle a bien été modifié !");
    }

    /**
     * Supprime un puzzle.
     */
    public function destroy(Puzzle $puzzle)
    {
        $puzzle->delete();
        return back()->with('message', "Le puzzle a bien été supprimé !");
    }
}
