<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
// ajoute la propriété $fillable pour tous les champs de la table vehicules
// et ajoute la relation hasMany vers Reparation
{
    protected $fillable = [
        'immatriculation',
        'marque',
        'modele',
        'couleur',
        'annee',
        'kilometrage',
        'carrosserie',
        'energie',
        'boite',
        'image',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? route('image.serve', ['path' => $this->image]) : null;
    }

    public function reparations()
    {
        return $this->hasMany(Reparation::class);
    }
}
