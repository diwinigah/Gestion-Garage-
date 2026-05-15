<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technicien;


class TechnicienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $techniciens = Technicien::paginate(10);
        return view('techniciens.index', compact('techniciens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('techniciens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'specialite' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'statut' => 'required|in:actif,inactif,conge',
        ]);

        Technicien::create($validatedData);

        return redirect()->route('techniciens.index')->with('success', 'Technicien créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $technicien = Technicien::findOrFail($id);
        return view('techniciens.show', compact('technicien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $technicien = Technicien::findOrFail($id);
        return view('techniciens.edit', compact('technicien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'specialite' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
            'statut' => 'required|in:actif,inactif,conge',
        ]);

        $technicien = Technicien::findOrFail($id);
        $technicien->update($validatedData);

        return redirect()->route('techniciens.index')->with('success', 'Technicien mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $technicien = Technicien::findOrFail($id);
        
        // Détacher toutes les réparations associées
        $technicien->reparations()->update(['technicien_id' => null]);
        
        // Supprimer le technicien
        $technicien->delete();

        return redirect()->route('techniciens.index')->with('success', 'Technicien supprimé avec succès.');
    }
}
