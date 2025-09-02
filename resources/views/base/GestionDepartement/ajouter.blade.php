@extends('base/adminBase')

@section('title', 'Ajouter un Département')


@section('content')



<div class="container mb-4 shadow py-2">
    <h4 class="alert alert-primary">
        Ajouter un département <i class="bi bi-plus-lg"></i>
    </h4>
    <hr>
    <form action="{{ route('departements.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom du Département" required>
            <label for="nom" class="form-label">Nom du Département</label>
        </div>
        <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="emplacement" name="emplacement" placeholder="Emplacement" required>
            <label for="emplacement" class="form-label">Emplacement</label>
        </div>

        <div class="mb-3 form-floating">
            <input type="date" class="form-control" id="date_creation" name="date_creation" placeholder="Date de création">
            <label for="date_creation" class="form-label">Date de création</label>
        </div>
        <button type="submit" class="btn btn-primary col-5">Ajouter
            <i class="bi bi-plus-lg"></i>
        </button>
        <a href="{{ route('departements.index') }}" class="btn btn-secondary col-3">Annuler
            <i class="bi bi-x-lg"></i>
        </a>
    </form>
</div>










@endsection()