@extends('base.employeBase')

@section('title', 'Interface Employé')

@section('content')

@php
    $totalDocuments = $documents->count();
    $totalContrats = $contrats->count();
    $totalPointages = $pointages->count();
    $totalConges = $conges->sum('nombre_jours') ?? 0;
    $totalHeuresTravaillees = $pointages->sum('heures_travaillees') ?? 0;
    $poste = $employe->poste;
    $departement = $poste ? $poste->departement : null;


@endphp

<!-- Content Row -->
<div class="row">
    <!-- Documents Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card documents h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Documents</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDocuments }}</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalContrats }}</div>
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
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pointages</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPointages }}</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalConges }}</div>
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

                <img src="{{ $employe->photo 
                            ? asset('storage/' . $employe->photo) 
                            : 'https://via.placeholder.com/120' }}" 
                    alt="Photo" 
                    class="rounded-circle profile-photo mb-3 shadow">

                
                <h4 class="card-title">{{ $employe->prenom }}</h4>
                <p class="text-muted">{{ $poste ? $poste->titre : '-' }}</p>
                <span class="badge status-badge status-active">Actif</span>

                <hr>
                <ul class="list-group list-group-flush text-start">
                    <li class="list-group-item"><i class="bi bi-envelope me-2 text-primary"></i> {{ $employe->email }}</li>
                    <li class="list-group-item"><i class="bi bi-telephone me-2 text-primary"></i> {{ $employe->telephone ?? '-' }}</li>
                    <li class="list-group-item"><i class="bi bi-card-text me-2 text-primary"></i> Matricule: {{ $employe->matricule }}</li>
                    <li class="list-group-item"><i class="bi bi-calendar-check me-2 text-primary"></i> Embauche: {{ $employe->date_embauche ? $employe->date_embauche->format('d/m/Y') : '-' }}</li>
                    <li class="list-group-item"><i class="bi bi-building me-2 text-primary"></i> Département: {{ $departement ? $departement->nom : '-' }}</li>
                    <li class="list-group-item"><i class="bi bi-person-badge me-2 text-primary"></i> Responsable: {{ $employe->est_responsable ? 'Oui' : 'Non' }}</li>
                    <li class="list-group-item"><i class="bi bi-geo-alt me-2 text-primary"></i> Adresse: {{ $employe->adresse ?? '-' }}</li>
                    <li class="list-group-item"><i class="bi bi-file-earmark-text me-2 text-primary"></i> Poste: {{ $poste ? $poste->titre : '-' }}</li>
                </ul>

                <div class="d-grid gap-2 mt-3">
                    <a class="btn btn-primary" href="{{ route('employe.profile.modifier.get') }}"><i class="bi bi-pencil-square me-2"></i> Modifier profil</a>
                    <form method="POST" action="{{ route('logout') }}" class="w-100">
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="bi bi-box-arrow-right me-2 w-100"></i> Déconnexion</button>

                    </form>
                </div>
            </div>
        </div>
        
        <!-- Progress Card -->
        
    </div>

    <!-- Main Content Column -->
    <div class="col-lg-8">
        <!-- Pointages Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-white">Derniers Pointages</h6>
                <a class="btn btn-sm btn-primary" href="{{ route('employe.pointages') }}">Voir tout</a>
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
                            @foreach($pointages as $pointage)
                            <tr>
                                <td>{{ $pointage->date_pointage->format('d/m/Y') }}</td>
                                <td><span class="badge bg-success">{{ $pointage->heure_arrivee }}</span></td>
                                <td><span class="badge bg-danger">{{ $pointage->heure_depart }}</span></td>
                                <td>{{ $pointage->heures_travaillees }}</td>
                            </tr>
                            @endforeach
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
                        <h6 class="m-0 font-weight-bold text-white">Heures travaillées</h6>
                    </div>
                    <div class="card-body text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 100%;" src="data:image/svg+xml,...">
                    </div>
                </div>
            </div>
            
            <!-- Projets Chart -->
        </div>
    </div>
</div>

@endsection
