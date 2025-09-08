@extends('base.employeBase')

@section('title', 'Profil Employé')

@section('content')
@php
    $totalDocuments = $documents->count();
    $poste = $employe->poste;
    $departement = $employe ? $employe->departement : null;
@endphp
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12">
            
            <!-- Profil Card -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-person-circle me-2"></i>
                        Mon Profil
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Photo + Nom -->
                    <div class="d-flex align-items-center mb-4">
                        
                        <img src="{{ $employe->photo 
                                ? asset('storage/' . $employe->photo) 
                                : 'https://via.placeholder.com/120' }}" 
                        class="rounded-circle border border-3 border-primary me-3" 
                        width="120" height="120" 
                        alt="Photo de profil">


                        <div>
                            <h5 class="mb-1">{{ $employe->prenom }}</h5>
                            <span class="badge bg-success">
                                {{ $poste ? $poste->titre : 'Aucun poste attribué' }}
                            </span>
                        </div>
                    </div>

                    <!-- Infos personnelles -->
                    <h6 class="text-primary">Informations personnelles</h6>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">
                            <i class="bi bi-envelope me-2"></i>
                            <strong>Email :</strong> {{ $employe->email }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-telephone me-2"></i>
                            <strong>Téléphone :</strong> {{ $employe->telephone ?? 'Non renseigné' }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-calendar-event me-2"></i>
                            <strong>Date d’embauche :</strong> 
                            {{ $employe->date_embauche ? $employe->date_embauche->format('d/m/Y') : 'Non renseignée' }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-geo-alt me-2"></i>
                            <strong>Adresse :</strong> {{ $employe->adresse ?? 'Non renseignée' }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-person-badge me-2"></i>
                            <strong>Matricule :</strong> {{ $employe->matricule }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-person-check me-2"></i>
                            <strong>Responsable :</strong> {{ $employe->est_responsable ? 'Oui' : 'Non' }}
                        </li>
                        <!-- Nombre de documents -->
                        <li class="list-group-item">
                            <i class="bi bi-folder me-2"></i>
                            <strong>Documents :</strong> {{ $totalDocuments }}
                        </li>
                    </ul>

                    <!-- Infos professionnelles -->
                    <h6 class="text-primary">Informations professionnelles</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="bi bi-building me-2"></i>
                            <strong>Département :</strong> 
                            {{ $departement ? $departement->nom : 'Non attribué' }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-briefcase me-2"></i>
                            <strong>Poste :</strong> 
                            {{ $poste ? $poste->titre : 'Non attribué' }}
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-star me-2"></i>
                            <strong>Rôle(s) :</strong> 
                            @foreach($employe->getRoleNames() as $role)
                                <span class="badge bg-info text-dark">{{ ucfirst($role) }}</span>
                            @endforeach
                        </li>
                    </ul>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('employe.bienvenue') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <a href="{{ route('employe.profile.modifier.get') }}" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i> Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
