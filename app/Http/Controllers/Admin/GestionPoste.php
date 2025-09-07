<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poste;
use App\Models\Employe;

class GestionPoste extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postes = Poste::all();
        return view('base.GestionPoste.liste', compact('postes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $employes = Employe::all();
        return view('base.GestionPoste.ajouter', compact('employes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'employe_id' => 'nullable|exists:employes,id',
        ]);
        Poste::create($request->all());
        return redirect()->route('postes.index')->with('success', 'Poste ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $poste = Poste::findOrFail($id);
        return view('base.GestionPoste.voir', compact('poste'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $poste = Poste::findOrFail($id);
        $employes = Employe::all();
        return view('base.GestionPoste.modifier', compact('poste', 'employes'));
        


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'employe_id' => 'nullable|exists:employes,id',
        ]);
        $poste = Poste::findOrFail($id);
        $poste->update($request->all());
        return redirect()->route('postes.index')->with('success', 'Poste modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $poste = Poste::findOrFail($id);
        $poste->delete();
        return redirect()->route('postes.index')->with('success', 'Poste supprimé avec succès.');
    }


    // lier un employé a un poste
    public function lierEmployePoste(Request $request, string $id)
    {
        $request->validate([
        'employe_id' => 'required|exists:employes,id',
        ]);

        // Récupérer le poste
        $poste = Poste::findOrFail($id);

        // Récupérer l'employé choisi
        $employe = Employe::findOrFail($request->employe_id);

        // Associer le poste à l'employé
        $employe->poste_id = $poste->id;
        $employe->save();

        return redirect()->route('postes.index')->with('success', 'Poste assigné à l\'employé avec succès.');
    }

    // affichage du formulaire d'affectation
    public function lierEmployePosteForm(string $id)
    {
        $poste = Poste::findOrFail($id);
        $employes = Employe::all();
        return view('base.GestionPoste.assignerPoste', compact('poste', 'employes'));
    }

    public function bonjour()
    {
        return view('base.GestionPoste.bonjour');
    }


    // assigner un employé à un poste
    // public function assignerEmployePosteSForm()
    // {
    //     $postes=Poste::all();
    //     $employes=Employe::all();

    //     return view('base.GestionPoste.assignationposte', compact('postes', 'employes'));
    // }

    // public function assignerEmployePoste(Request $request)
    // {
    //     $request->validate([
    //         'employe_id' => 'required|exists:employes,id',
    //         'poste_id' => 'required|exists:postes,id',
    //     ]);

    //     // Récupérer l'employé et le poste
    //     $employe = Employe::findOrFail($request->employe_id);
    //     $poste = Poste::findOrFail($request->poste_id);

    //     // Associer le poste à l'employé
    //     $employe->poste_id = $poste->id;
    //     $employe->save();

    //     return redirect()->route('postes.index')->with('success', 'Poste assigné à l\'employé avec succès.');
    // }

}
