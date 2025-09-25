<?php

namespace Tests\Unit;

use App\Models\Puzzle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class PuzzleTest extends TestCase
{
    use RefreshDatabase;

    public function test_puzzle_can_be_created()
    {
        $puzzle = Puzzle::factory()->create([
            'nom' => 'Test Puzzle',
            'categorie' => 'Test Categorie',
            'description' => 'Ceci est un puzzle de test.',
            'prix' => 9.99,
            'image' => 'test_image.png',
        ]);

        $this->assertDatabaseHas('puzzles', [
            'nom' => 'Test Puzzle',
        ]);
    }

    public function test_puzzle_creation_fails_with_missing_data()
    {
        $this->expectException(ValidationException::class);

        $puzzleData = [
            'nom' => '',
            'categorie' => '',
            'description' => '',
            'prix' => '',
            'image' => '',
        ];

        $validator = Validator::make($puzzleData, [
            'nom' => 'required',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric',
            'image' => 'required',
        ]);

        $validator->validate();

        Puzzle::create($puzzleData);
    }

    public function test_puzzle_creation_fails_with_invalid_data()
    {
        $this->expectException(ValidationException::class);

        $puzzleData = [
            'nom' => str_repeat('A', 256), // Nom trop long
            'categorie' => 'Test Categorie',
            'description' => 'Ceci est un puzzle de test.',
            'prix' => -5.99, // Prix négatif
            'image' => 'test_image.png',
        ];

        $validator = Validator::make($puzzleData, [
            'nom' => 'required|max:255',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'image' => 'required',
        ]);

        $validator->validate();

        Puzzle::create($puzzleData);
    }

    public function test_puzzle_creation_fails_with_duplicate_data()
    {
        $puzzleData = [
            'nom' => 'Unique Puzzle',
            'categorie' => 'Test Categorie',
            'description' => 'Ceci est un puzzle de test.',
            'prix' => 9.99,
            'image' => 'test_image.png',
        ];

        Puzzle::create($puzzleData);

        $this->expectException(ValidationException::class);

        $validator = Validator::make($puzzleData, [
            'nom' => 'required|unique:puzzles,nom',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'image' => 'required',
        ]);

        $validator->validate();

        Puzzle::create($puzzleData);
    }

    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_puzzle_can_be_read()
    {
    $puzzle = Puzzle::factory()->create([
        'nom' => 'Test Puzzle',
        'categorie' => 'Test Categorie',
        'description' => 'Ceci est un puzzle de test.',
        'image' => 'Image test',
        'prix' => 9.99,
    ]);

    $foundPuzzle = Puzzle::find($puzzle->id);

    $this->assertNotNull($foundPuzzle);
    $this->assertEquals('Test Puzzle', $foundPuzzle->nom);
    }

    public function test_lire_puzzle_inexistant()
    {
        $this->expectException(ValidationException::class);
        
        $puzzleData = [
            'nom' => '',
            'categorie' => '',
            'description' => '',
            'prix' => '',
            'image' => '',
        ];

        $validator = Validator::make($puzzleData, [
            'nom' => 'required',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric',
            'image' => 'required',
        ]);

        $validator->validate();

        Puzzle::read($puzzleData);

    }

    public function test_lire_fails_with_invalid_data()
    {
        $this->expectException(ValidationException::class);

        $puzzleData = [
            'nom' => str_repeat('A', 256), // Nom trop long
            'categorie' => 'Test Categorie',
            'description' => 'Ceci est un puzzle de test.',
            'prix' => -5.99, // Prix négatif
            'image' => 'test_image.png',
        ];

        $validator = Validator::make($puzzleData, [
            'nom' => 'required|max:255',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'image' => 'required',
        ]);

        $validator->validate();

        Puzzle::read($puzzleData);
    }



















    public function test_puzzle_can_be_updated()
    {
    $puzzle = Puzzle::factory()->create();

    $puzzle->nom = 'Nom mis à jour';
    $puzzle->categorie = 'Categorie mis à jour';
    $puzzle->description = 'Description mis à jour';
    $puzzle->image = 'Image mise à jour';
    $puzzle->prix = 3.99;
    $puzzle->save();

    $this->assertDatabaseHas('puzzles', [
        'id' => $puzzle->id,
        'nom' => 'Nom mis à jour',
        'categorie' => 'Categorie mis à jour',
        'description' => 'Description mis à jour',
        'image' => 'Image mise à jour',
        'prix' => 3.99,
    ]);
    }

    public function test_modifier_fails_with_invalid_data()
    {
        $this->expectException(ValidationException::class);

        $puzzleData = [
            'nom' => str_repeat('A', 256), // Nom trop long
            'categorie' => 'Test Categorie',
            'description' => 'Ceci est un puzzle de test.',
            'prix' => -5.99, // Prix négatif
            'image' => 'test_image.png',
        ];

        $validator = Validator::make($puzzleData, [
            'nom' => 'required|max:255',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'image' => 'required',
        ]);

        $validator->validate();

        Puzzle::update($puzzleData);
    }

    public function test_modifier_puzzle_inexistant()
    {
        $this->expectException(ValidationException::class);
        
        $puzzleData = [
            'nom' => '',
            'categorie' => '',
            'description' => '',
            'prix' => '',
            'image' => '',
        ];

        $validator = Validator::make($puzzleData, [
            'nom' => 'required',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric',
            'image' => 'required',
        ]);

        $validator->validate();

        Puzzle::update($puzzleData);

    }

    public function test_puzzle_can_be_deleted()
    {
    $puzzle = Puzzle::factory()->create();

    $puzzle->delete();

    $this->assertDatabaseMissing('puzzles', [
        'id' => $puzzle->id,
        'nom' => 'Nom supprimé',
        'categorie' => 'Categorie supprimé',
        'description' => 'Description supprimé',
        'image' => 'Image supprimé',
        'prix' => 3.99,
    ]);
    }

    public function test_supprimer_puzzle_inexistant()
    {
        $this->expectException(ValidationException::class);
        
        $puzzleData = [
            'nom' => '',
            'categorie' => '',
            'description' => '',
            'prix' => '',
            'image' => '',
        ];

        $validator = Validator::make($puzzleData, [
            'nom' => 'required',
            'categorie' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric',
            'image' => 'required',
        ]);

        $validator->validate();

        Puzzle::delete($puzzleData);

    }

}
