@extends('base/adminBase')

@section('title', 'Admin - Gestion des Employés')

@section('content')


<div class="card welcome-card">
                <div class="card-body">
                    <h2 class="card-title">Bienvenue dans HR Manager</h2>
                    <hr>
                    <p class="card-text">
                        Gestion complète de votre personnel avec notre système intégré. Suivez les présences, gérez les congés,
                        consultez les évaluations et bien plus encore à partir d'une interface unique et intuitive.
                    </p>
                    <p class="card-text">
                        Utilisez le menu latéral pour accéder aux différentes fonctionnalités de gestion des employés.
                    </p>
                </div>
</div>

<!-- Section employés récents -->
<h3 class="section-title">Employés Récents</h3>
            
<div class="card employee-table">
    <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Poste</th>
                                    <th>Département</th>
                                    <th>Date d'embauche</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" width="40" height="40" alt="Photo">
                                            <div class="ms-3">
                                                <p class="fw-bold mb-0">Marie Dupont</p>
                                                <p class="text-muted mb-0">marie.dupont@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Développeuse Frontend</td>
                                    <td>IT</td>
                                    <td>12/05/2021</td>
                                    <td><span class="status-badge bg-active">Actif</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary me-1"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" width="40" height="40" alt="Photo">
                                            <div class="ms-3">
                                                <p class="fw-bold mb-0">Jean Martin</p>
                                                <p class="text-muted mb-0">jean.martin@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Commercial</td>
                                    <td>Ventes</td>
                                    <td>23/08/2020</td>
                                    <td><span class="status-badge bg-onleave">En congé</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary me-1"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" width="40" height="40" alt="Photo">
                                            <div class="ms-3">
                                                <p class="fw-bold mb-0">Sophie Leroy</p>
                                                <p class="text-muted mb-0">sophie.leroy@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Responsable RH</td>
                                    <td>Ressources Humaines</td>
                                    <td>05/01/2019</td>
                                    <td><span class="status-badge bg-active">Actif</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary me-1"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                </table>
        </div>
    </div>
</div>
    
@endsection