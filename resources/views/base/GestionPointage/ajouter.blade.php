@extends('base.adminBase')

@section('title', 'Ajouter un pointage')

@section('content')
<div class="container mt-4">

    <!-- Titre et bouton retour -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3"><i class="bi bi-clock-history me-2"></i> Ajouter un pointage</h1>
        <a href="{{ route('pointages.index') }}" class="btn btn-outline-secondary">
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
            <form action="{{ route('pointages.store') }}" method="POST">
                @csrf

                <!-- Date du pointage -->
                <div class="form-floating mb-3">
                    <input type="date" name="date_pointage" id="date_pointage" 
                           class="form-control @error('date_pointage') is-invalid @enderror" 
                           value="{{ old('date_pointage') }}" required>
                    <label for="date_pointage"><i class="bi bi-calendar-date me-2"></i> Date <span class="text-danger">*</span></label>
                    @error('date_pointage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Heure arrivée -->
                <div class="form-floating mb-3">
                    <input type="time" name="heure_arrivee" id="heure_arrivee" 
                           class="form-control @error('heure_arrivee') is-invalid @enderror" 
                           value="{{ old('heure_arrivee') }}" required>
                    <label for="heure_arrivee"><i class="bi bi-clock me-2"></i> Heure d'arrivée <span class="text-danger">*</span></label>
                    @error('heure_arrivee')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Heure départ -->
                <div class="form-floating mb-3">
                    <input type="time" name="heure_depart" id="heure_depart" 
                           class="form-control @error('heure_depart') is-invalid @enderror" 
                           value="{{ old('heure_depart') }}">
                    <label for="heure_depart"><i class="bi bi-clock-history me-2"></i> Heure de départ</label>
                    @error('heure_depart')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Employé -->
                <div class="form-floating mb-3">
                    <select name="employe_id" id="employe_id" class="form-select @error('employe_id') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Sélectionner --</option>
                        @foreach($employes as $employe)
                            <option value="{{ $employe->id }}" {{ old('employe_id') == $employe->id ? 'selected' : '' }}>
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
                        <i class="bi bi-save me-1"></i> Enregistrer
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
