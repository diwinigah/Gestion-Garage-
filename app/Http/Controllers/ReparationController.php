<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reparation;
use App\Models\Vehicule;
use App\Models\Technicien;


class ReparationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Reparation::with(['vehicule', 'technicien']);

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('vehicule', function($vehiculeQuery) use ($search) {
                    $vehiculeQuery->where('immatriculation', 'like', '%' . $search . '%')
                                  ->orWhere('marque', 'like', '%' . $search . '%')
                                  ->orWhere('modele', 'like', '%' . $search . '%');
                })
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('statut', 'like', '%' . $search . '%');
            });
        }

        $reparations = $query->paginate(10);
        return view('reparations.index', compact('reparations'));
    }

    /**
     * Show the form for creating a new resource.
     */
public function create($vehiculeId)
{
    $vehicule = Vehicule::findOrFail($vehiculeId);
    $techniciens = Technicien::all();

    return view('reparations.create', compact('vehicule', 'techniciens'));
}


    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{  
   $validated = $request->validate([
    'vehicule_id' => 'required|exists:vehicules,id',
    'technicien_id' => 'nullable|exists:techniciens,id',
    'date_debut' => 'required|date',
    'date_fin' => 'nullable|date|after_or_equal:date_debut',
    'description' => 'nullable|string',
]);


    $reparation = Reparation::create($validated);
    return redirect()->route('vehicules.show', $validated['vehicule_id'])
        ->with('success', 'Réparation créée avec succès.');

    // return response()->json($reparation, 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // retourne la réparation correspondant à l'id avec les relations vehicule et technicien
        $reparation = Reparation::with(['vehicule', 'technicien'])->findOrFail($id);
        return view('reparations.show', compact('reparation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // retourne la vue d'édition avec la réparation correspondant à l'id
        $reparation = Reparation::findOrFail($id);
        $techniciens = Technicien::all();
        return view('reparations.edit', compact('reparation', 'techniciens'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $request->validate([
        'vehicule_id'   => 'required|exists:vehicules,id',
        'date_debut'    => 'required|date',
        'date_fin'      => 'nullable|date|after:date_debut',
        'description'   => 'required|string',
        'technicien_id' => 'nullable|exists:techniciens,id',
        'statut'        => 'required|in:en_attente,en_cours,termine,urgent,annule',
    ]);

    $reparation = Reparation::findOrFail($id);
    $reparation->update($request->all());

    return redirect()->route('vehicules.show', $reparation->vehicule_id)
                     ->with('success', 'Réparation mise à jour avec succès !');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // supprime la réparation correspondant à l'id
        $reparation = Reparation::findOrFail($id);
        $reparation->delete();

        return redirect()->route('reparations.index')
                         ->with('success', 'Réparation supprimée avec succès !');

    }
}
