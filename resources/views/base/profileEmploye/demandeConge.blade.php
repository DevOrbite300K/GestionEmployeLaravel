@extends('base.employeBase')

@section('title', 'Demande de Congé')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary"><i class="bi bi-calendar-plus me-2"></i> Nouvelle Demande de Congé</h3>
    <hr>

    <form action="{{ route('employe.demandeconge.post') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="type" class="form-label">Type de congé</label>
            <select name="type" id="type" class="form-select" required>
                <option value="annuel">Annuel</option>
                <option value="maladie">Maladie</option>
                <option value="sans_solde">Sans Solde</option>
                <option value="maternite">Maternité</option>
                <option value="paternite">Paternité</option>
                <option value="autre">Autre</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="motif" class="form-label">Motif</label>
            <textarea name="motif" id="motif" rows="3" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="date_debut" class="form-label">Date de début</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date_fin" class="form-label">Date de fin (optionnelle)</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle me-1"></i> Soumettre la demande
        </button>
        <a href="{{ route('employe.profile') }}" class="btn btn-secondary mt-2"><i class="bi bi-x-circle me-1"></i> Annuler</a>
    </form>
</div>
@endsection
