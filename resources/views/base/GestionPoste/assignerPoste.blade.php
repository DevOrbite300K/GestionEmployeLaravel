@extends('base.adminBase')

@section('title', 'Assigner un employé au poste')

@section('content')
<div class="container mt-4">

    <!-- Titre et retour -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3"><i class="bi bi-briefcase me-2"></i> Assigner un employé au poste</h1>
        <a href="{{ route('postes.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <!-- Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Erreur :
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <!-- Carte -->
    <div class="card shadow-sm rounded-3">
        <div class="card-body">

            <!-- Info du poste -->
            <h5 class="mb-3"><i class="bi bi-card-text me-2"></i> Poste : <span class="fw-bold">{{ $poste->titre }}</span></h5>
            <p class="text-muted">{{ $poste->description }}</p>
            <p><i class="bi bi-currency-dollar me-2"></i> Salaire de base : 
                <strong>{{ number_format($poste->salaire_base, 2, ',', ' ') }} FCFA</strong>
            </p>
            <hr>

            <!-- Formulaire -->
            <form action="{{ route('postes.lier_employe.post', $poste->id) }}" method="POST">
                @csrf
              
                <!-- Choix employé -->
                <div class="form-floating mb-3">
                    <select name="employe_id" id="employe_id"
                            class="form-select @error('employe_id') is-invalid @enderror" required>
                        <option value="">-- Sélectionner un employé --</option>
                        @foreach($employes as $employe)
                            <option value="{{ $employe->id }}"
                                {{ old('employe_id', $poste->employe_id ?? '') == $employe->id ? 'selected' : '' }}>
                                {{ $employe->nom }} {{ $employe->prenom }} {{ $employe->telephone ? '('.$employe->telephone.')' : '' }}
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
                        <i class="bi bi-link-45deg me-1"></i> Assigner
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
