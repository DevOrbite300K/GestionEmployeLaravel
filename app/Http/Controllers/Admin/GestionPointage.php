<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pointage;
use App\Models\Employe;

class GestionPointage extends Controller
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

        $pointages = Pointage::with('employe')->paginate(10);
        return view('base.GestionPointage.liste', compact('pointages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employes = Employe::all();
        return view('base.GestionPointage.ajouter', compact('employes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_pointage' => 'required|date',
            'heure_arrivee' => 'required|date_format:H:i',
            'heure_depart' => 'nullable|date_format:H:i',
            'employe_id' => 'required|exists:employes,id',
        ]);

        // Vérifier si un pointage existe déjà pour cet employé à la même date
        $exists = Pointage::where('employe_id', $request->employe_id)
                        ->where('date_pointage', $request->date_pointage)
                        ->exists();

        if ($exists) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors(['date_pointage' => 'Cet employé a déjà pointé pour cette date.']);
        }


        // Vérifier que l'heure d'arrivée < heure de départ
        if ($request->heure_depart && $request->heure_arrivee > $request->heure_depart) {
                return back()
                    ->withErrors(['heure_depart' => "⚠️ L'heure de départ doit être supérieure à l'heure d'arrivée."])
                    ->withInput();
            }

        // Créer le pointage
        Pointage::create($request->all());

        return redirect()->route('pointages.index')->with('success', 'Pointage ajouté avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pointage = Pointage::with('employe')->findOrFail($id);
        return view('base.GestionPointage.voir', compact('pointage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pointage = Pointage::findOrFail($id);
        $employes = Employe::all();
        // $pointage->heure_arrivee = \Carbon\Carbon::parse($pointage->heure_arrivee)->format('H:i');
        // $pointage->heure_depart = $pointage->heure_depart ? \Carbon\Carbon::parse($pointage->heure_depart)->format('H:i') : null;



        return view('base.GestionPointage.modifier', compact('pointage', 'employes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'date_pointage' => 'required|date',
            'heure_arrivee' => 'required|date_format:H:i',
            'heure_depart' => 'nullable|date_format:H:i',
            'employe_id' => 'required|exists:employes,id',
        ]);

        $pointage = Pointage::findOrFail($id);
        

        // Vérifier que l'heure d'arrivée < heure de départ
        if ($request->heure_depart && $request->heure_arrivee > $request->heure_depart) {
                return back()
                    ->withErrors(['heure_depart' => "⚠️ L'heure de départ doit être supérieure à l'heure d'arrivée."])
                    ->withInput();
            }

        // Créer le pointage
        $pointage->update($request->all());

        return redirect()->route('pointages.index')->with('success', 'Pointage modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pointage=Pointage::find($id);
        $pointage->delete();
        return redirect()->back()->with('success', 'pointage supprimer avec success');
    }

    public function changerLeStatut(Request $request, string $id)
    {
        $request->validate([
            'statut' => 'required|in:present,en_retard,absent',
        ]);

        $pointage = Pointage::findOrFail($id);
        $pointage->update($request->only('statut'));

        return redirect()->back()->with('success', 'Statut du pointage modifié avec succès.');
    }

    // affichage du formulaire qui change le status
    public function afficherFormulaireChangementStatut(string $id)
    {
        $pointage = Pointage::findOrFail($id);
        return view('base.GestionPointage.changerStatut', compact('pointage'));
    }
}
