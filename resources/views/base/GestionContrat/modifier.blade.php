@extends('base.adminBase')

@section('title', 'Modifier un Contrat')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Modifier le contrat #{{ $contrat->id }}</h2>

    <div class="card shadow-lg rounded-3 mb-4">
        <div class="card-body">
            <form action="{{ route('contrats.update', $contrat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Employé --}}
                <div class="mb-3">
                    <label for="employe_id" class="form-label">Employé</label>
                    <select name="employe_id" id="employe_id" class="form-select" required>
                        @foreach($employes as $employe)
                            <option value="{{ $employe->id }}" {{ $contrat->employe_id == $employe->id ? 'selected' : '' }}>
                                {{ $employe->nom }} {{ $employe->prenom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Type de contrat --}}
                <div class="mb-3">
                    <label for="type_contrat" class="form-label">Type de contrat</label>
                    <select name="type_contrat" id="type_contrat" class="form-select" required>
                        @foreach(['CDI','CDD','Stage','Alternance','Freelance','Intérim','Autre'] as $type)
                            <option value="{{ $type }}" {{ $contrat->type_contrat == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dates --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date_debut" class="form-label">Date de début</label>
                        <input type="date" name="date_debut" id="date_debut" class="form-control" 
                               value="{{ $contrat->date_debut ? \Carbon\Carbon::parse($contrat->date_debut)->format('Y-m-d') : '' }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" id="date_fin" class="form-control" 
                               value="{{ $contrat->date_fin ? \Carbon\Carbon::parse($contrat->date_fin)->format('Y-m-d') : '' }}">
                        <small class="text-muted">Laissez vide si indéterminé</small>
                    </div>
                </div>

                {{-- Salaire --}}
                <div class="mb-3">
                    <label for="salaire_base" class="form-label">Salaire de base (€)</label>
                    <input type="number" step="0.01" name="salaire_base" id="salaire_base" class="form-control" value="{{ $contrat->salaire_base }}" required>
                </div>

                {{-- Statut --}}
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select name="statut" id="statut" class="form-select" required>
                        @foreach(['Actif','Inactif','Suspendu'] as $statut)
                            <option value="{{ $statut }}" {{ $contrat->statut == $statut ? 'selected' : '' }}>
                                {{ $statut }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Fichier --}}
                <div class="mb-3">
                    <label for="fichier" class="form-label">Fichier du contrat</label>
                    @if($contrat->fichier)
                        <div class="mb-2">
                            <a href="{{ asset('storage/' . $contrat->fichier) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Voir fichier actuel
                            </a>
                        </div>
                    @endif
                    <input type="file" name="fichier" id="fichier" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png">
                    <small class="text-muted">Laisser vide pour conserver le fichier actuel. Formats autorisés : PDF, Word, Image - Max 2Mo</small>
                </div>

                {{-- Boutons --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('contrats.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
