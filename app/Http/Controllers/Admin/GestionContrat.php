<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contrat;
use App\Models\Employe;

class GestionContrat extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contrats = Contrat::all();
        $employes = Employe::all();
        return view('base.GestionContrat.liste', compact('contrats', 'employes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $employes = Employe::all();
        return view('base.GestionContrat.ajouter', compact('employes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
            'type_contrat' => 'required|in:CDI,CDD,Stage,Alternance,Freelance,Intérim,Autre',
            'date_debut'   => 'required|date',
            'date_fin'     => 'nullable|date|after:date_debut',
            'salaire_base' => 'required|numeric|min:0',
            'statut'       => 'required|in:Actif,Inactif,Suspendu',
            'employe_id'   => 'required|exists:employes,id',
            'fichier'      => 'nullable|mimes:pdf,doc,docx,jpg,png|max:2048', // validation du fichier
        ]);

        $data = $request->except('fichier');

        // Gestion du fichier
        if ($request->hasFile('fichier')) {
            $fileName = time() . '_' . $request->file('fichier')->getClientOriginalName();
            $path = $request->file('fichier')->storeAs('contrats', $fileName, 'public'); // stocke dans storage/app/public/contrats
            $data['fichier'] = $path;
        }

        Contrat::create($data);

        return redirect()->route('contrats.index')->with('success', 'Contrat créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $contrat = Contrat::findOrFail($id);
        $employe = Employe::find($contrat->employe_id);
        return view('base.GestionContrat.voir', compact('contrat', 'employe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contrat = Contrat::findOrFail($id);
        $employes = Employe::all();
        return view('base.GestionContrat.modifier', compact('contrat', 'employes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type_contrat' => 'required|in:CDI,CDD,Stage,Alternance,Freelance,Intérim,Autre',
            'date_debut'   => 'required|date',
            'date_fin'     => 'nullable|date|after:date_debut',
            'salaire_base' => 'required|numeric|min:0',
            'statut'       => 'required|in:Actif,Inactif,Suspendu',
            'employe_id'   => 'required|exists:employes,id',
            'fichier'      => 'nullable|mimes:pdf,doc,docx,jpg,png|max:2048', // validation fichier
        ]);

        $contrat = Contrat::findOrFail($id);

        $data = $request->except('fichier');

        // Gestion du fichier si un nouveau est uploadé
        if ($request->hasFile('fichier')) {
            // Supprimer l'ancien fichier si existant
            if ($contrat->fichier && \Storage::disk('public')->exists($contrat->fichier)) {
                \Storage::disk('public')->delete($contrat->fichier);
            }

            // Stocker le nouveau fichier
            $data['fichier'] = $request->file('fichier')->store('contrats', 'public');
        }


        $contrat->update($data);

        return redirect()->route('contrats.index')->with('success', 'Contrat mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contrat = Contrat::findOrFail($id);
        $contrat->delete();

        return redirect()->route('contrats.index')->with('success', 'Contrat supprimé avec succès.');
    }
}
