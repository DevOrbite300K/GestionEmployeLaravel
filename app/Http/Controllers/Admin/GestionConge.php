<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conge;
use App\Models\Employe;

class GestionConge extends Controller
{
    /**
     * Afficher toutes les demandes de congés.
     */
    public function index()
    {
        $conges = Conge::with('employe')->orderBy('created_at', 'desc')->get();
        return view('base.GestionConge.liste', compact('conges'));
    }

    /**
     * Afficher une demande de congé en détail.
     */
    public function show(string $id)
    {
        $conge = Conge::with('employe')->findOrFail($id);
        return view('base.GestionConge.voir', compact('conge'));
    }

    /**
     * Approuver une demande de congé.
     */
    public function approuver($id)
    {
        $conge = Conge::findOrFail($id);
        $conge->statut = 'approuve';
        $conge->save();

        return redirect()->route('conges.index')->with('success', 'La demande de congé a été approuvée.');
    }

    /**
     * Rejeter une demande de congé.
     */
    public function rejeter($id)
    {
        $conge = Conge::findOrFail($id);
        $conge->statut = 'rejete';
        $conge->save();

        return redirect()->route('conges.index')->with('success', 'La demande de congé a été rejetée.');
    }

    /**
     * Supprimer une demande de congé (optionnel pour admin).
     */
    public function destroy(string $id)
    {
        $conge = Conge::findOrFail($id);
        $conge->delete();

        return redirect()->route('conges.index')->with('success', 'La demande de congé a été supprimée.');
    }

    // 🚨 Pas utile pour l'admin : create, store, edit, update
    // car ce sont les employés qui font les demandes.
}
