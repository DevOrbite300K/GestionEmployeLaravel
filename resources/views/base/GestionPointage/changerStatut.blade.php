@extends('base.adminBase')

@section('title', 'Modifier le statut du pointage')

@section('content')
<div class="container mt-4">

    <!-- Titre et retour -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3"><i class="bi bi-activity me-2"></i> Modifier le statut de pointage pour l'employé
            {{ $pointage->employe->nom }} {{ $pointage->employe->prenom }}
        </h1>
        <a href="{{ route('pointages.index') }}" class="btn btn-outline-secondary">
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
            <form action="{{ route('pointages.changer_statut.post', $pointage->id) }}" method="POST">
                @csrf
                

                <div class="form-floating mb-3">
                    <select name="statut" id="statut" class="form-select @error('statut') is-invalid @enderror" required>
                        <option value="present" {{ old('statut', $pointage->statut) == 'present' ? 'selected' : '' }}>✅ Présent</option>
                        <option value="en_retard" {{ old('statut', $pointage->statut) == 'en_retard' ? 'selected' : '' }}>⏰ En retard</option>
                        <option value="absent" {{ old('statut', $pointage->statut) == 'absent' ? 'selected' : '' }}>❌ Absent</option>
                    </select>
                    <label for="statut"><i class="bi bi-activity me-2"></i> Statut</label>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
