<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Reparation;
use App\Models\Technicien;
use App\Models\Vehicule;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'vehicles_total' => Vehicule::count(),
            'vehicles_in_repair' => Vehicule::whereHas('reparations', function ($query) {
                $query->whereIn('statut', ['en_attente', 'en_cours', 'urgent']);
            })->count(),
            'technicians_total' => Technicien::count(),
            'appointments_pending' => Appointment::where('status', 'pending')->count(),
            'appointments_confirmed' => Appointment::where('status', 'confirmed')->count(),
            'appointments_completed' => Appointment::where('status', 'completed')->count(),
        ];

        $monthlyActivity = collect(range(5, 0))->map(function ($monthsAgo) {
            $date = now()->subMonths($monthsAgo);

            return [
                'label' => ucfirst($date->translatedFormat('M')),
                'repairs' => Reparation::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'appointments' => Appointment::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        })->values();

        $latestRepairs = Reparation::with(['vehicule', 'technicien'])->latest()->take(5)->get();
        $latestAppointments = Appointment::latest()->take(5)->get();

        return view('dashboard.index', compact('stats', 'monthlyActivity', 'latestRepairs', 'latestAppointments'));
    }
}
