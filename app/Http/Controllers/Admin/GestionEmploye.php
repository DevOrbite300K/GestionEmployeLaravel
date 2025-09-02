<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employe;
use Illuminate\Support\Facades\Hash;
use App\Models\Departement;
use App\Models\Poste;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;


use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployesExport;

class GestionEmploye extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin|rh')->only(['create', 'store', 'edit', 'update', 'index']);
        $this->middleware('role:admin|rh')->only(['assign_role']);
        $this->middleware('role:admin|rh')->only(['exportExcel']);
        $this->middleware('role:admin|rh')->only(['exportPDF']);

        // seul admin peut supprimer
        $this->middleware('role:admin')->only(['destroy']);

        // seul admin peut assigner un role
        $this->middleware('role:admin')->only(['showAssignRoleForm', 'assignRoleToEmployee']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $search = $request->input('search');

        // Initialiser la requête
        $query = Employe::query();

        // Filtrer si recherche
        if ($search) {
            $query->where('nom', 'like', "%{$search}%")
                ->orWhere('prenom', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        // Pagination avec ordre
        $employes = $query->orderBy('created_at', 'desc')
                        ->paginate(3)
                        ->withQueryString();

        // afficher la liste des employés
        return view('base/GestionEmploye/liste', compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('base/GestionEmploye/ajouter');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // 1️ Validation des champs obligatoires
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:employes,email',
            'password' => 'required|string|min:6|confirmed', // nécessite password_confirmation
        ]);

        // 2️ Hash du mot de passe
        $validated['password'] = Hash::make($validated['password']);

        // 3️ Création de l'employé
        $employe = Employe::create($validated);

        // 4️ Redirection avec message de succès
        return redirect()->route('employes.index')
                        ->with('success', 'Employé créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $employe = Employe::findOrFail($id);
        return view('base/GestionEmploye/voir', compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $employe = Employe::findOrFail($id);
        $departements = Departement::all();
        $postes = Poste::all();
        return view('base/GestionEmploye/modifier', compact('employe', 'departements', 'postes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employe = Employe::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:employes,email,'.$employe->id,
            'password' => 'nullable|string|min:6|confirmed',
            'prenom' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'matricule' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'date_embauche' => 'nullable|date',
            'photo' => 'nullable|image|max:2048',
            'departement_id' => 'nullable|exists:departements,id',
            'poste_id' => 'nullable|exists:postes,id',
            'est_responsable' => 'nullable|boolean',
        ]);

        // Hash du mot de passe si présent
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Gestion de l'upload de photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($employe->photo && Storage::disk('public')->exists($employe->photo)) {
                Storage::disk('public')->delete($employe->photo);
            }

            // Stocker la nouvelle photo sur le disque public
            $validated['photo'] = $request->file('photo')->store('employes', 'public');
        }
        // Vérifie le rôle avant de mettre à jour
        if (auth()->user()->hasRole('admin')) {
            if ($request->boolean('est_responsable')) {
                $departementId = $request->departement_id ?? $employe->departement_id;

                Employe::where('departement_id', $departementId)
                    ->where('id', '!=', $employe->id)
                    ->update(['est_responsable' => false]);
            }

            $validated['est_responsable'] = $request->boolean('est_responsable');
        } else {
            // Si pas admin, garde la valeur actuelle en DB
            unset($validated['est_responsable']);
        }

        // Mise à jour
        $employe->update($validated);

        return redirect()->route('employes.index')->with('success', 'Employé modifié avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }




    // assinger un role a un employe
    public function assignRoleToEmployee(Request $request, string $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $employe = Employe::findOrFail($id);
        $employe->roles()->attach($request->input('role_id'));

        return redirect()->route('employes.show', $id)->with('success', 'Role assigne avec succes.');
    }


    //formulaire pour assigner un role a un employe
    public function showAssignRoleForm(string $id)
    {
        $employe = Employe::findOrFail($id);
        $roles = Role::all();

        return view('base/GestionEmploye/assignerRole', compact('employe', 'roles'));
    }


    // exporter la liste des employes
    public function exportExcel()
    {
        return Excel::download(new EmployesExport, 'employes.xlsx');
    }

    public function exportPDF()
    {
        $employes = Employe::all();
        $pdf = Pdf::loadView('base/GestionEmploye/pdf', compact('employes'));
        return $pdf->download('employes.pdf');
    }

}
