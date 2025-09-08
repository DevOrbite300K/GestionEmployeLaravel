@extends('base.employeBase')

@section('title', 'Mes Contrats')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 text-primary"><i class="bi bi-file-earmark-text me-2"></i>Mes Contrats</h3>
        {{-- Optionnel : bouton pour demander nouveau contrat --}}
        {{-- <a href="#" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Demander un nouveau contrat
        </a> --}}
    </div>
    <hr>

    @if($contrats->isEmpty())
        <div class="alert alert-info">Vous n'avez aucun contrat pour le moment.</div>
    @else
        <div class="list-group shadow-sm">
            @foreach($contrats as $contrat)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2 shadow-sm rounded">
                    <div>
                        <strong>#{{ $contrat->id }} - {{ $contrat->type_contrat }}</strong>
                        <div class="small text-muted">
                            Début: {{ \Carbon\Carbon::parse($contrat->date_debut)->format('d/m/Y') }}
                            @if($contrat->date_fin)
                                | Fin: {{ \Carbon\Carbon::parse($contrat->date_fin)->format('d/m/Y') }}
                            @else
                                | Fin: — 
                            @endif
                        </div>
                        <div class="small text-muted">Salaire: {{ number_format($contrat->salaire_base, 2, ',', ' ') }} GNF</div>
                        <div class="small text-muted">
                            Statut: 
                            <span class="badge 
                                @if($contrat->statut == 'Actif') bg-success
                                @elseif($contrat->statut == 'Suspendu') bg-warning
                                @else bg-danger @endif">
                                {{ $contrat->statut }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        @if($contrat->fichier)
                            {{-- Bouton Visualiser --}}
                            <a href="{{ asset('storage/' . $contrat->fichier) }}" target="_blank" 
                            class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye me-1"></i> Visualiser
                            </a>

                            {{-- Bouton Télécharger --}}
                            <a href="{{ asset('storage/' . $contrat->fichier) }}" download
                            class="btn btn-outline-success btn-sm">
                                <i class="bi bi-download me-1"></i> Télécharger
                            </a>
                        @else
                            <span class="text-muted small">Pas de fichier</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
