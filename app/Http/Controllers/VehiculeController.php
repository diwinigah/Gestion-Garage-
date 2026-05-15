<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Vehicule;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
    public function index(Request $request)
    { 
        $query = Vehicule::latest();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('immatriculation', 'like', '%' . $search . '%');
        }

        $vehicules = $query->paginate(10);
        return view('vehicules.index', compact('vehicules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'immatriculation' => 'required|string|unique:vehicules,immatriculation',
        'marque' => 'required|string',
        'modele' => 'required|string',
        'couleur' => 'nullable|string',
        'annee' => 'nullable|integer',
        'kilometrage' => 'nullable|integer',
        'carrosserie' => 'nullable|string',
        'energie' => 'nullable|string',
        'boite' => 'nullable|string',
        'image' => 'nullable|image|max:2048', // 2MB max
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('vehicules', 'public');
    }

    $vehicule = Vehicule::create($validated);

    return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté avec succès.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // retourne le véhicule correspondant à l'id ou une erreur 404 ,
        $vehicule = Vehicule::findOrFail($id);
        $vehicule->load(['reparations' => function($query) {
            $query->with(['technicien' => function($q) {
                $q->without('reparations');
            }]);
        }]);
        return view('vehicules.show', compact('vehicule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // retourne la vue d'édition avec le véhicule correspondant à l'id
        $vehicule = Vehicule::findOrFail($id);
        return view('vehicules.edit', compact('vehicule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // valide les données (immatriculation unique sauf pour ce véhicule)
        // puis met à jour le véhicule et le retourne
        $vehicule = Vehicule::findOrFail($id);

        $validatedData = $request->validate([
            'immatriculation' => 'required|unique:vehicules,immatriculation,' . $vehicule->id,
            'marque' => 'required|string',
            'modele' => 'required|string',
            'couleur' => 'nullable|string',
            'annee' => 'nullable|integer',
            'kilometrage' => 'nullable|integer',
            'carrosserie' => 'nullable|string',
            'energie' => 'nullable|string',
            'boite' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|max:2048',
            ]);
            $validatedData['image'] = $request->file('image')->store('vehicules', 'public');
        }

        $vehicule->update($validatedData);

        return redirect()->route('vehicules.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // supprime le véhicule correspondant à l'id
        $vehicule = Vehicule::findOrFail($id);
        $vehicule->delete();
        return redirect()->route('vehicules.index')->with('success', 'Véhicule supprimé avec succès.');
    } 
      }