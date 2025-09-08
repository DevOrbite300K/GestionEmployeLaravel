@extends('base.adminBase')

@section('title', 'Gestion des Contrats')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-4">Liste des Contrats</h2>
        <a href="{{ route('contrats.create') }}" class="btn btn-success mb-3">
            <i class="bi bi-plus-lg"></i> Ajouter un nouveau contrat
        </a>
    </div>
    <hr>

    {{-- Messages de succès/erreur --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tableau des contrats --}}
    <div class="card shadow-lg rounded-3">
        <div class="card-body">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>N°</th>
                        <th>Employé</th>
                        <th>Type de contrat</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Salaire de base</th>
                        <th>Statut</th>
                        <th>Fichier</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contrats as $contrat)
                        <tr>
                            <td>{{ $contrat->id }}</td>
                            <td>
                                @php
                                    $employe = $employes->where('id', $contrat->employe_id)->first();
                                @endphp
                                @if($employe)
                                    <a href="{{ route('employes.show', $employe->id) }}">
                                        {{ $employe->nom }} {{ $employe->prenom }}
                                    </a>
                                @else
                                    Non attribué
                                @endif
                            </td>
                            <td>{{ $contrat->type_contrat }}</td>
                            <td>{{ \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') }}</td>
                            <td>{{ $contrat->date_fin ? \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') : '—' }}</td>
                            <td>{{ number_format($contrat->salaire_base, 2, ',', ' ') }} GNF</td>
                            <td>
                                <span class="badge 
                                    @if($contrat->statut == 'Actif') bg-success
                                    @elseif($contrat->statut == 'Suspendu') bg-warning
                                    @else bg-danger @endif">
                                    {{ $contrat->statut }}
                                </span>
                            </td>
                            <td>
                                @if($contrat->fichier)
                                    <a href="{{ asset('storage/' . $contrat->fichier) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Voir
                                    </a>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('contrats.show', $contrat->id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('contrats.edit', $contrat->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('contrats.destroy', $contrat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce contrat ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Aucun contrat trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
