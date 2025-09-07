@extends('base.adminBase')

@section('title', 'Modifier un document')

@section('content')
<div class="container mt-4">

    <!-- Titre et bouton retour -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3"><i class="bi bi-pencil-square me-2"></i> Modifier le document</h1>
        <a href="{{ route('documents.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <!-- Message global pour les erreurs -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-x-circle-fill me-2"></i> Veuillez corriger les erreurs ci-dessous :
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="card shadow-sm rounded-3 mb-4">
        <div class="card-body">
            <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nom -->
                <div class="form-floating mb-3">
                    <input type="text" name="nom" id="nom" 
                           class="form-control @error('nom') is-invalid @enderror" 
                           placeholder="Nom du document" value="{{ old('nom', $document->nom) }}" required>
                    <label for="nom"><i class="bi bi-file-text me-2"></i> Nom du document <span class="text-danger">*</span></label>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Type -->
                <div class="form-floating mb-3">
                    <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="" disabled>-- Sélectionner --</option>
                        <option value="contrat" {{ old('type', $document->type) == 'contrat' ? 'selected' : '' }}>Contrat</option>
                        <option value="fiche_de_paie" {{ old('type', $document->type) == 'fiche_de_paie' ? 'selected' : '' }}>Fiche de paie</option>
                        <option value="cv" {{ old('type', $document->type) == 'cv' ? 'selected' : '' }}>CV</option>
                        <option value="diplome" {{ old('type', $document->type) == 'diplome' ? 'selected' : '' }}>Diplôme</option>
                        <option value="autre" {{ old('type', $document->type) == 'autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    <label for="type"><i class="bi bi-tags me-2"></i> Type <span class="text-danger">*</span></label>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Type fichier -->
                <div class="form-floating mb-3">
                    <select name="typefichier" id="typefichier" class="form-select @error('typefichier') is-invalid @enderror">
                        <option value="" selected>-- Sélectionner --</option>
                        <option value="pdf" {{ old('typefichier', $document->typefichier) == 'pdf' ? 'selected' : '' }}>PDF</option>
                        <option value="docx" {{ old('typefichier', $document->typefichier) == 'docx' ? 'selected' : '' }}>DOCX</option>
                        <option value="jpg" {{ old('typefichier', $document->typefichier) == 'jpg' ? 'selected' : '' }}>JPG</option>
                        <option value="png" {{ old('typefichier', $document->typefichier) == 'png' ? 'selected' : '' }}>PNG</option>
                        <option value="autre" {{ old('typefichier', $document->typefichier) == 'autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    <label for="typefichier"><i class="bi bi-file-earmark me-2"></i> Type de fichier</label>
                    @error('typefichier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="form-floating mb-3">
                    <textarea name="description" id="description" 
                              class="form-control @error('description') is-invalid @enderror" 
                              placeholder="Description" style="height: 120px;">{{ old('description', $document->description) }}</textarea>
                    <label for="description"><i class="bi bi-pencil-square me-2"></i> Description</label>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fichier upload -->
                <div class="mb-3">
                    <label for="chemin" class="form-label">
                        <i class="bi bi-upload me-2"></i> Sélectionner un fichier
                    </label>
                    <input type="file" name="chemin" id="chemin" 
                           class="form-control @error('chemin') is-invalid @enderror">
                    @if($document->chemin)
                        <small class="text-muted">Fichier actuel : <a href="{{ asset('storage/'.$document->chemin) }}" target="_blank">{{ basename($document->chemin) }}</a></small>
                    @endif
                    @error('chemin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Employé -->
                <div class="form-floating mb-3">
                    <select name="employe_id" id="employe_id" class="form-select @error('employe_id') is-invalid @enderror" required>
                        <option value="" disabled>-- Sélectionner --</option>
                        @foreach($employes as $employe)
                            <option value="{{ $employe->id }}" {{ old('employe_id', $document->employe_id) == $employe->id ? 'selected' : '' }}>
                                {{ $employe->nom }}
                            </option>
                        @endforeach
                    </select>
                    <label for="employe_id"><i class="bi bi-person-badge me-2"></i> Employé <span class="text-danger">*</span></label>
                    @error('employe_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bouton -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Mettre à jour
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
