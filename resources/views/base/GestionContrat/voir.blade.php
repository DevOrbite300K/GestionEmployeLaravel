@extends('base.adminBase')

@section('title', 'Détails du Contrat')

@section('content')
<div class="container mt-4 mb-4">
    <h2 class="mb-4">Détails du contrat {{ $contrat->id }}</h2>
    <hr>

    <div class="card shadow-lg rounded-3">
        <div class="card-body">
            <h5 class="card-title">Informations sur le contrat</h5>
            <hr>

            {{-- Employé --}}
            <div class="mb-3">
                <strong>Employé :</strong>
                <span class="ms-2">
                    {{ $employe ? $employe->nom . ' ' . $employe->prenom : 'Non attribué' }}
                </span>
            </div>

            {{-- Type de contrat --}}
            <div class="mb-3">
                <strong>Type de contrat :</strong>
                <span class="ms-2">{{ $contrat->type_contrat }}</span>
            </div>

            {{-- Dates --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Date de début :</strong>
                    <span class="ms-2">{{ \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') }}</span>
                </div>
                <div class="col-md-6">
                    <strong>Date de fin :</strong>
                    <span class="ms-2">
                        {{ $contrat->date_fin ? \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') : '—' }}
                    </span>
                </div>
            </div>

            {{-- Salaire --}}
            <div class="mb-3">
                <strong>Salaire de base :</strong>
                <span class="ms-2">{{ number_format($contrat->salaire_base, 2, ',', ' ') }} GNF</span>
            </div>

            {{-- Statut --}}
            <div class="mb-3">
                <strong>Statut :</strong>
                <span class="badge 
                    @if($contrat->statut == 'Actif') bg-success
                    @elseif($contrat->statut == 'Suspendu') bg-warning
                    @else bg-danger @endif ms-2">
                    {{ $contrat->statut }}
                </span>
            </div>

            {{-- Fichier --}}
            <div class="mb-3">
                <strong>Fichier du contrat :</strong>
                <span class="ms-2">
                    @if($contrat->fichier)
                        <a href="{{ asset('storage/' . $contrat->fichier) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Voir / Télécharger
                        </a>
                    @else
                        Aucun fichier
                    @endif
                </span>
            </div>

            {{-- Actions --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('contrats.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour à la liste
                </a>
                <div>
                    <a href="{{ route('contrats.edit', $contrat->id) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <form action="{{ route('contrats.destroy', $contrat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce contrat ?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
