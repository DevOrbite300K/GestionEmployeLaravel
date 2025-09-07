@extends('base.adminBase')

@section('title', 'Modifier le poste')

@section('content')
<div class="container mt-4">

    <!-- Titre et retour -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3"><i class="bi bi-pencil-square me-2"></i> Modifier le poste</h1>
        <a href="{{ route('postes.index') }}" class="btn btn-outline-secondary">
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

    <!-- Affichage des erreurs -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Veuillez corriger les erreurs :
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <!-- Formulaire -->
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <form action="{{ route('postes.update', $poste->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Titre -->
                <div class="form-floating mb-3">
                    <input type="text" name="titre" id="titre"
                           class="form-control @error('titre') is-invalid @enderror"
                           placeholder="Titre du poste" value="{{ old('titre', $poste->titre) }}" required>
                    <label for="titre"><i class="bi bi-card-text me-2"></i> Titre du poste <span class="text-danger">*</span></label>
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-floating mb-3">
                    <textarea name="description" id="description"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Description" style="height: 120px;">{{ old('description', $poste->description) }}</textarea>
                    <label for="description"><i class="bi bi-pencil-square me-2"></i> Description</label>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Salaire de base -->
                <div class="form-floating mb-3">
                    <input type="number" step="0.01" min="0" name="salaire_base" id="salaire_base"
                           class="form-control @error('salaire_base') is-invalid @enderror"
                           placeholder="Salaire de base" value="{{ old('salaire_base', $poste->salaire_base) }}" required>
                    <label for="salaire_base"><i class="bi bi-currency-dollar me-2"></i> Salaire de base <span class="text-danger">*</span></label>
                    @error('salaire_base')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bouton -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Mettre à jour
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
