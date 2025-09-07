@extends('base.adminBase')

@section('title', 'Détails du pointage')

@section('content')
<div class="container mt-4">

    <!-- Titre et retour -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3"><i class="bi bi-card-checklist me-2"></i> Détails du pointage</h1>
        <a href="{{ route('pointages.index') }}" class="btn btn-outline-secondary">
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

            <h5 class="card-title mb-3"><i class="bi bi-person-badge me-2"></i> Employé</h5>
            <p><strong>Nom & Prénom :</strong> <a href="{{ route('employes.show', $pointage->employe->id) }}">{{ $pointage->employe->nom }}  {{ $pointage->employe->prenom }}</a></p>
            <p><strong>Email :</strong> {{ $pointage->employe->email ?? 'Non renseigné' }}</p>
            <p><strong>Poste :</strong> {{ $pointage->employe->poste->titre ?? 'Non renseigné' }}</p>
            <p><strong>Photo :</strong>
                 <img src="{{ asset('storage/' . $pointage->employe->photo) }}" 
                        alt="Photo de {{ $pointage->employe->nom }}" 
                        class="img-fluid rounded-circle" width="100">

                </p>


            <hr>

            <h5 class="card-title mb-3"><i class="bi bi-calendar-check me-2"></i> Pointage</h5>
            <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($pointage->date_pointage)->format('d/m/Y') }}</p>
            <p><strong>Heure d'arrivée :</strong> {{ \Carbon\Carbon::parse($pointage->heure_arrivee)->format('H:i') }}</p>
            <p><strong>Heure de départ :</strong> {{ $pointage->heure_depart ? \Carbon\Carbon::parse($pointage->heure_depart)->format('H:i') : '-' }}</p>
            <p><strong>Statut :</strong>
                @if($pointage->statut == 'present')
                    <span class="badge bg-success">Présent</span>
                @elseif($pointage->statut == 'en_retard')
                    <span class="badge bg-warning text-dark">En retard</span>
                @else
                    <span class="badge bg-danger">Absent</span>
                @endif
            </p>

            <hr>

            <div class="d-flex justify-content-end">
                <a href="{{ route('pointages.edit', $pointage->id) }}" class="btn btn-primary me-2">
                    <i class="bi bi-pencil-square me-1"></i> Modifier
                </a>
                <form action="{{ route('pointages.destroy', $pointage->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce pointage ?');">
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
