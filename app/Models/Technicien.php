<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technicien extends Model
{
    //  ajoute la propriété $fillable et une relation hasMany vers Reparation
    protected $fillable = [
        'nom',
        'prenom',
        'specialite',
        'telephone',
        'email',
        'statut'
    ];

    public function reparations()
    {
        return $this->hasMany(Reparation::class);
    }
}
