<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        return view ('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = $request->validate([
            'nom' => 'required|max:100',
        ]);

        $categorie = new Categorie();
        $categorie->nom = $request->nom;
        $categorie->save();
        return back()->with('message',"La catégorie a bien été créée !");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    //$categorie->load('puzzles'); // charge les puzzles liés
    $categorie = Categorie::with('puzzles')->findOrFail($id);
    return view('categories.show', compact('categorie'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        $data = $request->validate([
            'nom' => 'required|max:100',

        ]);
        
        $categorie->nom = $request->nom;
        $categorie->save();
        return back()->with('message',"La catégorie a bien été modifiée !");     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return back()->with('message',"La catégorie a bien été supprimée !");
    }
}
