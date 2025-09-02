{{-- resources/views/base/GestionEmploye/liste.blade.php --}}
@extends('base/adminBase')

@section('title', 'Liste des Employés')

@section('content')
<div class="container mt-4">

    {{-- Titre et boutons PDF/Excel --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Liste des Employés <i class="bi bi-person-lines-fill"></i></h1>
        <div>
            <a href="{{ route('employes.export.pdf') }}" class="btn btn-danger me-2">
                <i class="bi bi-file-pdf"></i> PDF
            </a>
            <a href="{{ route('employes.export.excel') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Excel
            </a>
        </div>
    </div>
    <hr>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Barre de recherche + bouton Ajouter --}}
    <form method="GET" action="{{ route('employes.index') }}" class="d-flex mb-4">
        <input type="text" name="search" class="form-control me-2" placeholder="Rechercher un employé..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-outline-primary">Rechercher</button>
        <a href="{{ route('employes.create') }}" class="btn btn-primary ms-2">
            <i class="bi bi-plus fs-4"></i>
        </a>
    </form>

    {{-- Tableau des employés --}}
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Responsable</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employes as $employe)
                    <tr>
                        <td>{{ $employe->id }}</td>
                        <td>
                            @if($employe->photo)
                                <img src="{{ asset('storage/'.$employe->photo) }}" class="rounded-circle" width="50" height="50">
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>{{ $employe->nom }}</td>
                        <td>{{ $employe->prenom }}</td>
                        <td>{{ $employe->telephone }}</td>
                        <td>
                            @if($employe->est_responsable)
                                Oui{{ $employe->departement ? ' – ' . $employe->departement->nom : '' }}
                            @else
                                Non
                            @endif
                        </td>
                        <td>
                            @foreach($employe->roles as $role)
                                <span class="badge bg-info text-dark">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('employes.show', $employe->id) }}" class="btn btn-sm btn-primary mb-1"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('employes.assign_role', $employe->id) }}" class="btn btn-sm btn-warning mb-1">Assigner rôle</a>
                            <a href="{{ route('employes.edit', $employe->id) }}" class="btn btn-sm btn-secondary mb-1"><i class="bi bi-pencil"></i></a>
                            @role('admin')
                                <form action="{{ route('employes.destroy', $employe->id) }}" method="POST" class="d-inline mb-1" onsubmit="return confirm('Voulez-vous vraiment supprimer cet employé ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            @endrole
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center">Aucun employé trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3 mb-5 flex-wrap">
        {{ $employes->links('pagination::bootstrap-5') }}
    </div>


</div>
@endsection
