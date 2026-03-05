<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Puzzle;

class PuzzleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $puzzles = Puzzle::all();
        return response()->json($puzzles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|max:255',
            'description' => 'required|max:500',
            'image' => 'required|max:255',
            'prix' => 'required|numeric|between:0,999.99',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        // Création du puzzle
        $puzzle = Puzzle::create($data);

        return response()->json($puzzle, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $puzzle = Puzzle::findOrFail($id);
        return response()->json($puzzle, 201);
    }

    /**
     * Update the specified resource in storage.
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

        return response()->json($puzzle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puzzle $puzzle)
    {
        $puzzle->delete();
        return response()->json(['message'=>'test']);
    }
}
