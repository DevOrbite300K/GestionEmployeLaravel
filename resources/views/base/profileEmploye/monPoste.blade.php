@extends('base.employeBase')

@section('title', 'Mon Poste')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary"><i class="bi bi-briefcase me-2"></i>Mon Poste & Département</h3>

    @if($poste)
    <div class="row g-4">

        {{-- Carte Poste --}}
        <div class="col-md-6">
            <div class="card shadow-lg rounded-3 border-primary h-100">
                <div class="card-header bg-primary text-white">
                    <i class="bi bi-clipboard-check me-2"></i> Détails du Poste
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $poste->titre }}</h5>
                    <p><i class="bi bi-card-text me-1"></i> <strong>Description :</strong> {{ $poste->description ?? '—' }}</p>
                    <p><i class="bi bi-cash-stack me-1"></i> <strong>Salaire de base :</strong> {{ $poste->salaire_base ? number_format($poste->salaire_base, 0, ',', ' ') . ' GNF' : '—' }}</p>
                    <p><i class="bi bi-person-badge me-1"></i> <strong>Employés dans ce poste :</strong> {{ $poste->employes->count() }}</p>
                </div>
            </div>
        </div>

        {{-- Carte Département --}}
        @if($departement)
        <div class="col-md-6">
            <div class="card shadow-lg rounded-3 border-success h-100">
                <div class="card-header bg-success text-white">
                    <i class="bi bi-building me-2"></i> Département
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $departement->nom }}</h5>
                    <p><i class="bi bi-card-text me-1"></i> <strong>Description :</strong> {{ $departement->description ?? '—' }}</p>
                    <p><i class="bi bi-people me-1"></i> <strong>Nombre d'employés :</strong> {{ $departement->employes->count() }}</p>
                </div>
            </div>
        </div>
        @endif

    </div>
    @else
        <div class="alert alert-info text-center fs-5">
            <i class="bi bi-info-circle me-2"></i> Aucun poste attribué pour le moment.
        </div>
    @endif
</div>
@endsection
