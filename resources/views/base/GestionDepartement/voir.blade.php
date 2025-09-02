@extends('base.adminBase')

@section('title', 'Détails du Département')

@section('content')

<div class="container mb-4 shadow py-2">
    <h4 class="alert alert-primary">
        Détails du département <i class="bi bi-info-circle"></i>
    </h4>
    <hr>
    <div class="mb-3">
        <strong>Nom du Département:</strong> {{ $departement->nom }}
    </div>
    <div class="mb-3">
        <strong>Emplacement:</strong> {{ $departement->emplacement }}
    </div>
    <div class="mb-3">
        <strong>Date de création:</strong> {{ $departement->date_creation->format('d/m/Y') }}
    </div>
    <div class="mb-3">
        <strong>Nombre d’employés:</strong> {{ $departement->employes->count() }}
    </div>
    <a href="{{ route('departements.index') }}" class="btn btn-secondary">Retour à la liste
        <i class="bi bi-arrow-left"></i>
    </a>
</div>

@endsection