@extends('base.adminBase')

@section('title', 'Ajouter un Contrat')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Ajouter un nouveau contrat</h3>

    <hr>

    <div class="card shadow-lg rounded-3 mb-4">
        <div class="card-body">
            <form action="{{ route('contrats.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Employé --}}
                <div class="mb-3">
                    <label for="employe_id" class="form-label">Employé</label>
                    <select name="employe_id" id="employe_id" class="form-select" required>
                        <option value="">-- Sélectionner un employé --</option>
                        @foreach($employes as $employe)
                            <option value="{{ $employe->id }}">
                                {{ $employe->nom }} {{ $employe->prenom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Type de contrat --}}
                <div class="mb-3">
                    <label for="type_contrat" class="form-label">Type de contrat</label>
                    <select name="type_contrat" id="type_contrat" class="form-select" required>
                        <option value="CDI">CDI</option>
                        <option value="CDD">CDD</option>
                        <option value="Stage">Stage</option>
                        <option value="Alternance">Alternance</option>
                        <option value="Freelance">Freelance</option>
                        <option value="Intérim">Intérim</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                {{-- Dates --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date_debut" class="form-label">Date de début</label>
                        <input type="date" name="date_debut" id="date_debut" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" id="date_fin" class="form-control">
                        <small class="text-muted">Laissez vide si indéterminé</small>
                    </div>
                </div>

                {{-- Salaire --}}
                <div class="mb-3">
                    <label for="salaire_base" class="form-label">Salaire de base (€)</label>
                    <input type="number" step="0.01" name="salaire_base" id="salaire_base" class="form-control" required>
                </div>

                {{-- Statut --}}
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select name="statut" id="statut" class="form-select" required>
                        <option value="Actif">Actif</option>
                        <option value="Inactif">Inactif</option>
                        <option value="Suspendu">Suspendu</option>
                    </select>
                </div>

                {{-- Fichier --}}
                <div class="mb-3">
                    <label for="fichier" class="form-label">Fichier du contrat (PDF, DOCX, Image...)</label>
                    <input type="file" name="fichier" id="fichier" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png">
                    <small class="text-muted">Format autorisés : PDF, Word, Image - Taille max : 2Mo</small>
                </div>

                {{-- Boutons --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('contrats.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
