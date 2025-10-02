<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;
    protected $fillable = ['statut', 'mode_paiement', 'utilisateur_id'];

    public function puzzles()
    {
        return $this->belongsToMany(Puzzle::class, 'appartient')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
}
