@extends('base.adminBase')

@section('title', 'Liste des pointages')

@section('content')
<div class="container mt-4">

    <!-- Titre et bouton ajouter -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3"><i class="bi bi-clock-history me-2"></i> Liste des pointages</h1>
        <a href="{{ route('pointages.create') }}" class="btn btn-primary">
            <i class="bi bi-plus me-1"></i> Ajouter un pointage
        </a>
    </div> <hr>

    <div class="mb-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif
    </div>

    <div class="card shadow-sm rounded-3 mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>N°</th>
                            <th>Photo</th>
                            <th>Date</th>
                            <th>Employé</th>
                            <th>Heure arrivée</th>
                            <th>Heure départ</th>
                            <th>Statut</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pointages as $pointage)
                            <tr>
                                <td>{{ $pointage->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $pointage->employe->photo) }}" alt="Photo de {{ $pointage->employe->prenom }}" class="img-fluid rounded-circle" width="50">
                                </td>
                                <td>{{ \Carbon\Carbon::parse($pointage->date_pointage)->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('employes.show', $pointage->employe->id) }}" class="text-decoration-none">
                                        <i class="bi bi-person-badge me-1"></i> {{ $pointage->employe->nom }}
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($pointage->heure_arrivee)->format('H:i') }}</td>
                                <td>
                                    {{ $pointage->heure_depart ? \Carbon\Carbon::parse($pointage->heure_depart)->format('H:i') : '-' }}
                                </td>
                                <td>
                                    @if($pointage->statut == 'present')
                                        <span class="badge bg-success">Présent</span>
                                    @elseif($pointage->statut == 'en_retard')
                                        <span class="badge bg-warning text-dark">En retard</span>
                                    @else
                                        <span class="badge bg-danger">Absent</span>
                                    @endif
                                </td>
                                <td class="text-center">

                                    <a href="{{ route('pointages.show', $pointage->id) }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('pointages.changer_statut', $pointage->id) }}" class="btn btn-sm btn-info me-1"> changer le statut
                                        <i class="bi bi-activity"></i>
                                    </a>
                                    <a href="{{ route('pointages.edit', $pointage->id) }}" class="btn btn-sm btn-warning me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('pointages.destroy', $pointage->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce pointage ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3">Aucun pointage trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            {{ $pointages->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
