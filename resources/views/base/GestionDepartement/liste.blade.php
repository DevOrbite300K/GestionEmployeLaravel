{{-- resources/views/base/GestionDepartement/liste.blade.php --}}
@extends('base/adminBase')

@section('title', 'Liste des Départements')

@section('content')
<div class="container mt-4">

    {{-- Titre et bouton Ajouter --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Liste des Départements <i class="bi bi-building"></i></h3>
        <a href="{{ route('departements.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Ajouter
        </a>
    </div>
    <hr>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <form action="{{ route('departements.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un département" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Rechercher
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>

    {{-- Tableau --}}
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Date de création</th>
                    <th>Emplacements</th>
                    <th>Nombre d’employés</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($departements as $departement)
                    <tr>
                        <td>{{ $departement->id }}</td>
                        <td>{{ $departement->nom }}</td>
                        <td>{{ $departement->date_creation ?? 'N/A' }}</td>
                        <td>{{ $departement->emplacement ?? 'N/A' }}</td>
                        <td>{{ $departement->employes->count() }}</td>
                        <td>
                            <a href="{{ route('departements.show', $departement->id) }}" class="btn btn-sm btn-primary mb-1 col-12">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('departements.edit', $departement->id) }}" class="btn btn-sm btn-secondary mb-1 col-12">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @role('admin')
                                <form action="{{ route('departements.destroy', $departement->id) }}" method="POST" class="d-inline-block col-12"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer ce département ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger col-12">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endrole
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucun département trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- // paginations --}}

    

</div>
@endsection
