<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departement;
class GestionDepartement extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer tous les départements
        $departements = Departement::all();
        return view('base.GestionDepartement.liste', compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('base.GestionDepartement.ajouter');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nom' => 'required|string|max:255',
            'emplacement' => 'required|string|max:255',
            'date_creation' => 'required|date',
        ]);

        Departement::create($request->all());

        return redirect()->route('departements.index')->with('success', 'Département ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $departement = Departement::findOrFail($id);
        return view('base.GestionDepartement.voir', compact('departement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $departement = Departement::findOrFail($id);
        return view('base.GestionDepartement.modifier', compact('departement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nom' => 'required|string|max:255',
            'emplacement' => 'required|string|max:255',
            'date_creation' => 'required|date',
        ]);

        $departement = Departement::findOrFail($id);
        $departement->update($request->all());

        return redirect()->route('departements.index')->with('success', 'Département modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $departement = Departement::findOrFail($id);
        $departement->delete();

        return redirect()->route('departements.index')->with('success', 'Département supprimé avec succès.');
    }
}
