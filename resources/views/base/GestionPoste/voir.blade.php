@extends('base.adminBase')

@section('title', 'Détails du poste')

@section('content')
<div class="container mt-4">

    <!-- Titre et retour -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3"><i class="bi bi-briefcase me-2"></i> Détails du poste</h1>
        <a href="{{ route('postes.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="card shadow-sm rounded-3 mb-4">
        <div class="card-body">
            
            <h5 class="card-title mb-3"><i class="bi bi-card-text me-2"></i> Titre</h5>
            <p>{{ $poste->titre }}</p>

            <h5 class="card-title mb-3"><i class="bi bi-pencil-square me-2"></i> Description</h5>
            <p>{{ $poste->description }}</p>

            <h5 class="card-title mb-3"><i class="bi bi-currency-dollar me-2"></i> Salaire de base</h5>
            <p>{{ number_format($poste->salaire_base, 2, ',', ' ') }} GNF</p>

            <!-- Nombre d'employés liés à ce poste -->
            <h5 class="card-title mb-3"><i class="bi bi-person-lines-fill me-2"></i> Nombre d'employés</h5>
            <p>{{ $poste->employes->count() }} employé(s)</p>

            <hr>

            <div class="d-flex justify-content-end">
                <a href="{{ route('postes.edit', $poste->id) }}" class="btn btn-primary me-2">
                    <i class="bi bi-pencil-square me-1"></i> Modifier
                </a>
                <form action="{{ route('postes.destroy', $poste->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce poste ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Supprimer
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
