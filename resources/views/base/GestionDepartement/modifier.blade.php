@extends('base/adminBase')

@section('title', 'Modifier un Département')

@section('content')

<div class="container mb-4 shadow py-2">
    <h4 class="alert alert-primary">
        Modifier un département <i class="bi bi-pencil"></i>
    </h4>
    <hr>
    <form action="{{ route('departements.update', $departement->id) }}" method="POST" class="mb-4">
        @csrf
        @method('PUT')
        <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $departement->nom }}" placeholder="Nom du Département" required>
            <label for="nom" class="form-label">Nom du Département</label>
        </div>
        <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="emplacement" name="emplacement" value="{{ $departement->emplacement }}" placeholder="Emplacement" required>
            <label for="emplacement" class="form-label">Emplacement</label>
        </div>

        <div class="mb-3 form-floating">
            <input type="date" class="form-control" id="date_creation" name="date_creation" value="{{ $departement->date_creation->format('Y-m-d') }}" placeholder="Date de création">
            <label for="date_creation" class="form-label">Date de création</label>
        </div>
        <button type="submit" class="btn btn-primary col-5">Modifier
            <i class="bi bi-pencil"></i>
        </button>
        <a href="{{ route('departements.index') }}" class="btn btn-secondary col-3">Annuler
            <i class="bi bi-x-lg"></i>
        </a>
    </form>
</div>

@endsection