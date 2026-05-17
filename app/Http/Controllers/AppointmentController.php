<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create()
    {
        return view('appointments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:40'],
            'vehicle' => ['required', 'string', 'max:160'],
            'problem_description' => ['required', 'string', 'max:2000'],
            'desired_date' => ['required', 'date', 'after_or_equal:today'],
        ]);

        Appointment::create($validated);

        return redirect()
            ->route('appointments.create')
            ->with('success', 'Votre demande de rendez-vous a bien ete envoyee. Nous vous contacterons rapidement.');
    }

    public function index(Request $request)
    {
        $query = Appointment::query()->with('reparation')->latest('desired_date');

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('full_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('vehicle', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        $appointments = $query->paginate(10)->withQueryString();

        return view('appointments.index', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,repair_created,completed,cancelled'],
        ]);

        $appointment->update($validated);

        return back()->with('success', 'Statut du rendez-vous mis a jour.');
    }
}
