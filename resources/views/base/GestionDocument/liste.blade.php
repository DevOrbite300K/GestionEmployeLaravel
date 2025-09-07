@extends('base.adminBase')

@section('title', 'Liste des documents')

@section('content')
<div class="container mt-4">

    <!-- Titre + bouton d'ajout -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">📂 Liste des documents</h1>
        <a href="{{ route('documents.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Ajouter un document
        </a>
    </div>

    <hr>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    

    <!-- Tableau des documents -->
    <div class="card shadow-sm rounded-3">
        <!-- champ de recherche -->
        <div class="card-header">
            <form action="{{ route('documents.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Rechercher un document" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Fichier</th>
                        <th>Description</th>
                        <th>Employé</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $document)
                        <tr>
                            <td>{{ $document->id }}</td>
                            <td>{{ $document->nom }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ ucfirst($document->type) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ strtoupper($document->typefichier ?? '-') }}
                                </span>
                            </td>
                            <td>{{ $document->description ?? '—' }}</td>
                            <td>{{ $document->employe->nom ?? 'Non assigné' }}</td>
                            <td>
                                <a href="{{ route('documents.show', $document->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce document ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Aucun document trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer mb-4">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-0">
                    {{-- Lien "Précédent" --}}
                    @if ($documents->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">Précédent</span></li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $documents->previousPageUrl() }}" rel="prev">Précédent</a>
                        </li>
                    @endif

                    {{-- Liens des pages --}}
                    @foreach ($documents->getUrlRange(1, $documents->lastPage()) as $page => $url)
                        <li class="page-item {{ $documents->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    {{-- Lien "Suivant" --}}
                    @if ($documents->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $documents->nextPageUrl() }}" rel="next">Suivant</a>
                        </li>
                    @else
                        <li class="page-item disabled"><span class="page-link">Suivant</span></li>
                    @endif
                </ul>
            </nav>
        </div>

</div>
@endsection
