<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Employe;

class GestionPaiement extends Controller
{
    /**
     * Afficher la liste de tous les paiements
     */
    public function index()
    {
        // Récupérer tous les paiements avec les infos employé
        $paiements = Paiement::with('employe')->orderBy('date_paiement', 'desc')->get();

        return view('base.GestionPaiement.liste', compact('paiements'));
    }

    /**
     * Afficher le détail d'un paiement
     */
    public function show(string $id)
    {
        $paiement = Paiement::with('employe')->findOrFail($id);

        return view('base.GestionPaiement.voir', compact('paiement'));
    }

    /**
     * Créer un paiement (optionnel si admin veut ajouter manuellement)
     */
    public function create()
    {
        $employes = Employe::all();
        return view('base.GestionPaiement.ajouter', compact('employes'));
    }

    /**
     * Stocker un paiement
     */
    public function store(Request $request)
    {
        $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'date_paiement' => 'required|date',
            'montant' => 'required|numeric|min:0',
            'type_paiement' => 'required|in:salaire,remboursement,prime,indemnite,autre',
            'mode_paiement' => 'required|in:carte,especes,cheque,orangeMoney',
        ]);

        Paiement::create($request->all());

        return redirect()->route('paiements.index')->with('success', 'Paiement ajouté avec succès.');
    }

    /**
     * Afficher le formulaire de modification d'un paiement
     */
    public function edit(string $id)
    {
        $paiement = Paiement::findOrFail($id);
        $employes = Employe::all();

        return view('base.GestionPaiement.modifier', compact('paiement', 'employes'));
    }

    /**
     * Mettre à jour un paiement
     */
    public function update(Request $request, string $id)
    {
        $paiement = Paiement::findOrFail($id);

        $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'date_paiement' => 'required|date',
            'montant' => 'required|numeric|min:0',
            'type_paiement' => 'required|in:salaire,remboursement,prime,indemnite,autre',
            'mode_paiement' => 'required|in:carte,especes,cheque,orangeMoney',
        ]);

        $paiement->update($request->all());

        return redirect()->route('paiements.index')->with('success', 'Paiement mis à jour avec succès.');
    }

    /**
     * Supprimer un paiement
     */
    public function destroy(string $id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé avec succès.');
    }
}
