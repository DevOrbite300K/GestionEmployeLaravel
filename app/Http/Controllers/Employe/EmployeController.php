<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poste;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\Document;
use App\Models\Conge;
use App\Models\Pointage;
use App\Models\Contrat;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:employe')->only(['bienvenue', 'profileEmploye', 'ModifierProfileEmployePoste', 'ModifierProfileEmployeGet', 'changerMotDePasse', 'changerMotDePasseGet']);
    }

    public function bienvenue()
    {
        $employe = Auth::user();
        $poste = $employe->poste;
        $departement = $poste ? $poste->departement : null;
        $documents = Document::where('employe_id', $employe->id)->get();
        $conges = Conge::where('employe_id', $employe->id)->get();
        $pointages = Pointage::where('employe_id', $employe->id)->get();
        $contrats = Contrat::where('employe_id', $employe->id)->get();

        return view('employe', compact('employe', 'poste', 'departement', 'documents', 'conges', 'pointages', 'contrats'));
    }


    // l'employer actuellement connecter peut voir sont profile

    public function profileEmploye()
    {
        $employe = Auth::user();
        $poste = $employe->poste;
        $departement = $poste ? $poste->departement : null;
        $documents = Document::where('employe_id', $employe->id)->get();

        return view('base.profileEmploye.profile', compact('employe', 'poste', 'departement', 'documents'));
    }

    // employe peut modifier son profile
    public function ModifierProfileEmployePoste(Request $request)
    {
        $employe = Auth::user();
        $request->validate([
            'nom' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:employes,email,' . $employe->id,
            'prenom' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'photo' => 'nullable|image|max:2048',

        ]);

        $employe->nom = $request->input('nom');
        $employe->email = $request->input('email');
        $employe->prenom = $request->input('prenom');
        $employe->telephone = $request->input('telephone');
        $employe->adresse = $request->input('adresse');
        $employe->date_naissance = $request->input('date_naissance');
        
        if ($request->hasFile('photo')) {
                $employe->photo = $request->file('photo')->store('photos', 'public');
        }



        

        $employe->save();

        return redirect()->route('employe.profile')->with('success', 'Profil mis à jour avec succès.');
    }


    // affichage du formulaire de modification de profile
    public function ModifierProfileEmployeGet()
    {
        $employe = Auth::user();
        return view('base.profileEmploye.modifierprofile', compact('employe'));

    }

    // changer le mot de passe
    public function changerMotDePasse(Request $request)
    {
        $employe = Auth::user();
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->input('current_password'), $employe->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $employe->password = Hash::make($request->input('new_password'));
        $employe->save();

        return redirect()->route('employe.profile')->with('success', 'Mot de passe changé avec succès.');
    }

    // le formulaire de changement de passe

    public function changerMotDePasseGet()
    {
        $employe = Auth::user();
        return view('base.profileEmploye.changerMotDePasse', compact('employe'));
    }

    //un employe ne peut voir que ces documents

    public function MesDocuments()
    {
        // Récupérer l'utilisateur connecté
        $employe = Auth::user();

        // Ne récupérer que ses documents
        $documents = Document::where('employe_id', $employe->id)->get();

        return view('base.ProfileEmploye.mesdocuments', compact('documents'));
    }


    // un employe peut uploader un document

    public function UploadDocumentPost(Request $request)
    {

         $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'typefichier' => 'required|string|max:50',
            'chemin' => 'required|file|max:2048', // 2MB max
            
        ]);

        $employe = Auth::user();

        $path = $request->file('chemin')->store('documents', 'public');

        Document::create([
            'nom' => $request->nom,
            'type' => $request->type,
            'typefichier' => $request->typefichier ?? $request->file('chemin')->getClientOriginalExtension(),
            'chemin' => $path,
            'employe_id' => $employe->id,
        ]);

        return redirect()->back()->with('success', 'Document ajouté avec succès.');

    }

    public function UploadDocumentGet()
    {
        // Récupérer l'employé connecté
        $employe = Auth::user();
        // Récupérer tous les documents de cet employé
        $documents = $employe->documents()->latest()->get();
        // Retourner la vue avec les documents et le formulaire d'upload
        return view('base.profileEmploye.upload', compact('documents'));
    }

    // employe vois ces pointage

    public function EmployePointage()
    {
        $employe = Auth::user();

        // Récupérer les pointages de l'employé connecté, triés par date décroissante
        $pointages = Pointage::where('employe_id', $employe->id)
                                ->orderBy('date_pointage', 'desc')
                                ->get();

        return view('base.profileEmploye.mespointages', compact('pointages'));
    }

    // employé peut pointer
    public function EmployePointageGet()
    {
        $employe = Auth::user();
        // Vérifier s'il a déjà pointé aujourd'hui
        $pointage = $employe->pointages()->where('date_pointage', now()->format('Y-m-d'))->first();
        return view('base.profileEmploye.pointer', compact('pointage'));

    }






    // Pointer l'arrivée
    public function EmployePointerArrivee(Request $request)
    {
        $employe = Auth::user();

        // Vérifier s'il a déjà pointé aujourd'hui
        $pointage = $employe->pointages()->where('date_pointage', now()->format('Y-m-d'))->first();
        if ($pointage) {
            return redirect()->back()->with('success', 'Vous avez déjà pointé aujourd\'hui.');
        }

        // Déterminer le statut selon l'heure
        $heure_actuelle = now()->format('H:i:s');
        $statut = ($heure_actuelle > '10:00:00') ? 'en_retard' : 'present';

        // Créer le pointage
        $employe->pointages()->create([
            'date_pointage' => now()->format('Y-m-d'),
            'heure_arrivee' => $heure_actuelle,
            'statut' => $statut,
        ]);

        return redirect()->back()->with('success', 'Pointage effectué avec succès ! Statut: ' . $statut);
    }


    // Pointer le départ
    public function EmployePointerDepart(Request $request)
    {
        $employe = Auth::user();

        // Récupérer le pointage d'aujourd'hui
        $pointage = $employe->pointages()->where('date_pointage', now()->format('Y-m-d'))->first();
        if (!$pointage) {
            return redirect()->back()->with('error', 'Vous n\'avez pas encore pointé votre arrivée.');
        }

        if ($pointage->heure_depart) {
            return redirect()->back()->with('success', 'Vous avez déjà pointé votre départ.');
        }

        $pointage->heure_depart = now()->format('H:i:s');
        $pointage->save();

        return redirect()->back()->with('success', 'Départ enregistré avec succès !');
    }

    // employer peut voir ces contrats

    // employer peut voir ses contrats uniquement
    public function mesContrats()
    {
        // Récupérer l'employé connecté
        $employe = Auth::user();

        // Ne récupérer que les contrats liés à cet employé
        $contrats = Contrat::where('employe_id', $employe->id)->orderBy('date_debut', 'desc')->get();


        return view('base.profileEmploye.mescontrats', compact('contrats'));
    }

    // employe et son poste

    public function monPoste()
    {
        $employe = Auth::user();               // Employé connecté
        $poste = $employe->poste;              // Récupère le poste lié
        $departement = $poste ? $poste->departement : null;  // Récupère le département si poste existe

        return view('base.profileEmploye.monPoste', compact('poste', 'departement'));
    }

    // l'employe peut voir l'historique de son paiement
    public function historiquePaiement()
    {
        // Récupérer l'employé connecté
        $employe = Auth::user();

        // Récupérer les paiements liés à cet employé
        $paiements = Paiement::where('employe_id', $employe->id)->orderBy('date_paiement', 'desc')->get();

        return view('base.profileEmploye.historiquePaiement', compact('paiements'));
    }


    // un employe peut demander congés
    public function DemanderCongePost(Request $request)
    {
        $request->validate([
            'type' => 'required|in:annuel,maladie,sans_solde,maternite,paternite,autre',
            'motif' => 'nullable|string|max:500',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
        ]);

        $employe = Auth::user();

        Conge::create([
            'type' => $request->type,
            'motif' => $request->motif,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'employe_id' => $employe->id,
            // pas besoin de mettre statut, il est par défaut "en_attente"
        ]);

        return redirect()->route('employe.mesconges')->with('success', 'Votre demande de congé a été soumise avec succès et est en attente de validation.');
    }

    // afficher le formulaire de demande conges
    public function DemandeCongeGet()
    {
        return view('base.profileEmploye.demandeConge');
    }



    // un employe peut voir la liste de ces conges
    public function MesConges()
    {
        $employe = Auth::user();
        $conges = Conge::where('employe_id', $employe->id)
                        ->orderBy('date_debut', 'desc')
                        ->get();

        return view('base.profileEmploye.mesConges', compact('conges'));
    }












}
