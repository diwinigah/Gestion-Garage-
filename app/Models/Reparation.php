<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    // ajoute la propriété $fillable
// et les relations belongsTo vers Vehicule et Technicien

    protected $fillable = [
        'vehicule_id',
        'technicien_id',
        'date_debut',
        'date_fin',
        'description',
        'statut'
    ];

    protected $dates = [
        'date_debut',
        'date_fin'
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function technicien()
    {
        return $this->belongsTo(Technicien::class);
    }
}