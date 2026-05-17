<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public const STATUSES = [
        'pending' => 'En attente',
        'confirmed' => 'Confirme',
        'repair_created' => 'Reparation creee',
        'completed' => 'Termine',
        'cancelled' => 'Annule',
    ];

    protected $fillable = [
        'full_name',
        'phone',
        'vehicle',
        'problem_description',
        'desired_date',
        'status',
    ];

    protected $casts = [
        'desired_date' => 'date',
    ];

    public function reparation()
    {
        return $this->hasOne(Reparation::class);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}
