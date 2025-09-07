@extends('base.adminBase')

@section('title', 'Détails du document')

@section('content')
<div class="container mt-4">

    <!-- Titre et bouton retour -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3"><i class="bi bi-file-earmark-text me-2"></i> Détails du document</h1>
        <a href="{{ route('documents.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="card shadow-sm rounded-3 mb-4">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Nom :</h5>
                    <p class="border p-2 rounded">{{ $document->nom }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Type :</h5>
                    <p class="border p-2 rounded">{{ ucfirst($document->type) }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Type de fichier :</h5>
                    <p class="border p-2 rounded">{{ strtoupper($document->typefichier ?? '-') }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Employé :</h5>
                    @if($document->employe)
                        <a href="{{ route('employes.show', $document->employe->id) }}" class="text-decoration-none">
                            <i class="bi bi-person-badge me-1"></i> {{ $document->employe->nom }}
                        </a>
                    @else
                        <p class="text-muted">Non assigné</p>
                    @endif
                </div>

            </div>

            <div class="mb-3">
                <h5>Description :</h5>
                <p class="border p-2 rounded">{{ $document->description ?? '-' }}</p>
            </div>

            <div class="mb-3">
                <h5>Fichier : {{ $document->chemin }}</h5>
                @if($document->chemin)
                    <a href="{{ asset('storage/'.$document->chemin) }}" target="_blank" class="btn btn-outline-primary">
                        <i class="bi bi-eye me-1"></i> Visionner
                    </a>
                @else
                    <p class="text-muted">Aucun fichier disponible</p>
                @endif
            </div> <hr>

            <!-- Boutons action -->
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil-square me-1"></i> Modifier
                </a>
                <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Supprimer ce document ?')">
                        <i class="bi bi-trash me-1"></i> Supprimer
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
