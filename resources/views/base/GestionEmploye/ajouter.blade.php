{{-- resources/views/base/GestionEmploye/create.blade.php --}}
@extends('base/adminBase')

@section('title', 'Ajouter un Employé')

@section('content')
<div class="container mt-5 mb-5">
    <h4 class="mb-4 alert alert-primary">Ajouter un nouvel employé
        <i class="bi bi-person-plus"></i>
    </h4>
    <hr>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employes.store') }}" method="POST" class="shadow p-4 rounded">
        @csrf

        {{-- Nom --}}
        <div class="form-floating mb-3">
            <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom" value="{{ old('nom') }}" required>
            <label for="nom">Nom</label>
        </div>

        {{-- Email --}}
        <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" required>
            <label for="email">Email</label>
        </div>

        {{-- Password --}}
        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe" required>
            <label for="password">Mot de passe</label>
        </div>

        {{-- Password confirmation --}}
        <div class="form-floating mb-4">
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirmer le mot de passe" required>
            <label for="password_confirmation">Confirmer le mot de passe</label>
        </div>

        {{-- Bouton submit --}}
        <button type="submit" class="btn btn-primary col-6">Créer l'employé
            <i class="bi bi-plus"></i>
        </button>
        <a href="{{ route('employes.index') }}" class="btn btn-secondary  col-4">Annuler
            <i class="bi bi-x"></i>
        </a>
    </form>
</div>
@endsection
