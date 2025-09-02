@extends('base.employeBase')


@section('title', 'Interface Employe')



@section('content')





<!-- Content Row -->
        <div class="row">
            <!-- Documents Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card documents h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Documents</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-file-earmark-text fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contrats Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card contracts h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Contrats</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-file-earmark-medical fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pointages Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card pointages h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pointages (Mois)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">21</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-clock-history fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Congés Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card conges h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Jours de congés</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-calendar-event fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Profile Column -->
            <div class="col-lg-4">
                <!-- Profile Card -->
                <div class="card profile-card text-center mb-4">
                    <div class="card-header">Profil Employé</div>
                    <div class="card-body">
                        <img src="https://via.placeholder.com/120" alt="Photo" class="rounded-circle profile-photo mb-3 shadow">
                        <h4 class="card-title">Marie Dupont</h4>
                        <p class="text-muted">Développeuse Frontend</p>
                        <span class="badge status-badge status-active">Actif</span>

                        <hr>
                        <ul class="list-group list-group-flush text-start">
                            <li class="list-group-item"><i class="bi bi-envelope me-2 text-primary"></i> marie.dupont@example.com</li>
                            <li class="list-group-item"><i class="bi bi-telephone me-2 text-primary"></i> +225 01 23 45 67</li>
                            <li class="list-group-item"><i class="bi bi-card-text me-2 text-primary"></i> Matricule: EMP123</li>
                            <li class="list-group-item"><i class="bi bi-calendar-check me-2 text-primary"></i> Embauche: 12/05/2021</li>
                            <li class="list-group-item"><i class="bi bi-building me-2 text-primary"></i> Département: IT</li>
                            <li class="list-group-item"><i class="bi bi-person-badge me-2 text-primary"></i> Responsable: Oui</li>
                        </ul>

                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary"><i class="bi bi-pencil-square me-2"></i> Modifier profil</button>
                            <button class="btn btn-danger"><i class="bi bi-box-arrow-right me-2"></i> Déconnexion</button>
                        </div>
                    </div>
                </div>
                
                <!-- Progress Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Progression des objectifs</h6>
                    </div>
                    <div class="card-body">
                        <h6 class="small font-weight-bold">Projet Alpha <span class="float-right">75%</span></h6>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        
                        <h6 class="small font-weight-bold">Formation React <span class="float-right">90%</span></h6>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        
                        <h6 class="small font-weight-bold">Certification <span class="float-right">50%</span></h6>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Column -->
            <div class="col-lg-8">
                <!-- Pointages Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Derniers Pointages</h6>
                        <a class="btn btn-sm btn-primary" href="#">Voir tout</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Heure d'arrivée</th>
                                        <th>Heure de départ</th>
                                        <th>Heures travaillées</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01/09/2025</td>
                                        <td><span class="badge bg-success">08:30</span></td>
                                        <td><span class="badge bg-danger">17:30</span></td>
                                        <td>9h00</td>
                                    </tr>
                                    <tr>
                                        <td>02/09/2025</td>
                                        <td><span class="badge bg-success">08:35</span></td>
                                        <td><span class="badge bg-danger">17:25</span></td>
                                        <td>8h50</td>
                                    </tr>
                                    <tr>
                                        <td>03/09/2025</td>
                                        <td><span class="badge bg-success">08:40</span></td>
                                        <td><span class="badge bg-danger">17:30</span></td>
                                        <td>8h50</td>
                                    </tr>
                                    <tr>
                                        <td>04/09/2025</td>
                                        <td><span class="badge bg-success">08:25</span></td>
                                        <td><span class="badge bg-danger">17:35</span></td>
                                        <td>9h10</td>
                                    </tr>
                                    <tr>
                                        <td>05/09/2025</td>
                                        <td><span class="badge bg-success">08:45</span></td>
                                        <td><span class="badge bg-danger">17:20</span></td>
                                        <td>8h35</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Row for Charts -->
                <div class="row">
                    <!-- Heures travaillées Chart -->
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Heures travaillées</h6>
                            </div>
                            <div class="card-body text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 100%;" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='500' height='250' viewBox='0 0 500 250'%3E%3Crect width='500' height='250' fill='%23f8f9fc'/%3E%3Cpath d='M50,200 L100,150 L150,170 L200,120 L250,140 L300,100 L350,130 L400,80 L450,110' stroke='%234e73df' stroke-width='2' fill='none'/%3E%3Ccircle cx='50' cy='200' r='3' fill='%234e73df'/%3E%3Ccircle cx='100' cy='150' r='3' fill='%234e73df'/%3E%3Ccircle cx='150' cy='170' r='3' fill='%234e73df'/%3E%3Ccircle cx='200' cy='120' r='3' fill='%234e73df'/%3E%3Ccircle cx='250' cy='140' r='3' fill='%234e73df'/%3E%3Ccircle cx='300' cy='100' r='3' fill='%234e73df'/%3E%3Ccircle cx='350' cy='130' r='3' fill='%234e73df'/%3E%3Ccircle cx='400' cy='80' r='3' fill='%234e73df'/%3E%3Ccircle cx='450' cy='110' r='3' fill='%234e73df'/%3E%3C/svg%3E" alt="Chart">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Projets Chart -->
                    <div class="col-lg-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Répartition des projets</h6>
                            </div>
                            <div class="card-body text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 100%;" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='500' height='250' viewBox='0 0 500 250'%3E%3Crect width='500' height='250' fill='%23f8f9fc'/%3E%3Ccircle cx='125' cy='125' r='80' fill='%234e73df'/%3E%3Ccircle cx='125' cy='125' r='60' fill='%231cc88a'/%3E%3Ccircle cx='125' cy='125' r='40' fill='%2336b9cc'/%3E%3Ccircle cx='125' cy='125' r='20' fill='%23f6c23e'/%3E%3C/svg%3E" alt="Chart">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>






@endsection()