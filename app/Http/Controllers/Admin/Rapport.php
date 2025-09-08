<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Poste;
use App\Models\Departement;
use App\Models\Pointage;
use App\Models\Contrat;
use App\Models\Document;
use App\Models\Conge;
use App\Models\Paiement;

class Rapport extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin|rh')->only(['index']);
    }
    public function index()
    {
        // Derniers 5 employés ajoutés
        $employes = Employe::orderBy('created_at', 'desc')->take(5)->get();

        // Statistiques globales
        $totalEmployes    = Employe::count();
        $totalPostes      = Poste::count();
        $totalDept        = Departement::count();
        $totalContrats    = Contrat::count();
        $totalDocuments   = Document::count();
        $totalConges      = Conge::count();
        $totalPaiements   = Paiement::count();

        // Statuts des congés
        $congesEnAttente  = Conge::where('statut', 'en_attente')->count();
        $congesApprouves  = Conge::where('statut', 'approuve')->count();
        $congesRejetes    = Conge::where('statut', 'rejete')->count();

        // Sommes de paiements
        $sommePaiements   = Paiement::sum('montant');
        $dernierPaiements = Paiement::orderBy('date_paiement', 'desc')->take(5)->get();

        return view('base.GestionRapport.global', compact(
            'employes', 'totalEmployes', 'totalPostes', 'totalDept', 
            'totalContrats', 'totalDocuments', 'totalConges', 'totalPaiements',
            'congesEnAttente', 'congesApprouves', 'congesRejetes',
            'sommePaiements', 'dernierPaiements'
        ));
    }


    // filtrer par statut de pointage
    public function filtrerParStatut($statut)
        {
            $statutsValides = ['en_retard', 'absent', 'present'];
            if (!in_array($statut, $statutsValides)) abort(404);

            $employes = Employe::whereHas('pointages', function($query) use ($statut) {
                $query->where('statut', $statut);
                    // ->whereDate('date_pointage', now()->format('Y-m-d'));
            })->get();

            // Génération du tableau HTML directement
            $html = '<table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Poste</th>
                                <th>Département</th>
                                <th>Statut pointage</th>
                            </tr>
                        </thead>
                        <tbody>';

            if($employes->isEmpty()) {
                $html .= '<tr><td colspan="7" class="text-center">Aucun employé trouvé pour ce statut</td></tr>';
            } else {
                foreach($employes as $employe) {
                    $badgeClass = $statut == 'en_retard' ? 'warning' : ($statut == 'absent' ? 'danger' : 'success');

                    $html .= '<tr>
                                <td>'.$employe->id.'</td>
                                <td>
                                    <img src="'.asset('storage/' . $employe->photo).'" 
                                        alt="'.$employe->nom.' '.$employe->prenom.'" 
                                        class="rounded-circle" width="50" height="50">
                                </td>

                                
                                <td>'.$employe->nom.'</td>
                                <td>'.$employe->prenom.'</td>
                                <td>'.$employe->email.'</td>
                                <td>'.($employe->poste->titre ?? '—').'</td>
                                <td>'.($employe->departement->nom ?? '—').'</td>
                                <td><span class="badge bg-'.$badgeClass.'">'.ucfirst($statut).'</span></td>
                            </tr>';
                }
            }

            $html .= '</tbody></table>';

            return $html;
        }


}
