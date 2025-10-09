<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'statut', 'mode_paiement'];

    public function puzzles()
    {
        return $this->belongsToMany(Puzzle::class, 'appartient')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appartient()
    {
        return $this->hasMany(Appartient::class); // lien vers la table pivot
    }
}
