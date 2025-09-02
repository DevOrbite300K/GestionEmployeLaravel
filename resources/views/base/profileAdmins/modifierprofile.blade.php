@extends('base.adminBase')

@section('title', 'Modifier mon profil')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Modifier mon profil</h2>

    <!-- Messages d'erreur -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire -->
    <div class="card shadow-sm p-4">
        <form method="POST" action="{{ route('update_profile_admins') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" name="nom" class="form-control" id="nom" 
                       value="{{ old('nom', $user->nom) }}" required>
                <label for="nom">Nom</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="prenom" class="form-control" id="prenom" 
                       value="{{ old('prenom', $user->prenom) }}">
                <label for="prenom">Prénom</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="email" 
                       value="{{ old('email', $user->email) }}" required>
                <label for="email">Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="telephone" class="form-control" id="telephone" 
                       value="{{ old('telephone', $user->telephone) }}">
                <label for="telephone">Téléphone</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="adresse" class="form-control" id="adresse" 
                       value="{{ old('adresse', $user->adresse) }}">
                <label for="adresse">Adresse</label>
            </div>

            <div class="form-floating mb-3">
                <input type="date" name="date_naissance" class="form-control" id="date_naissance" 
                       value="{{ old('date_naissance', $user->date_naissance) }}">
                <label for="date_naissance">Date de naissance</label>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo de profil</label>
                <input type="file" name="photo" class="form-control" id="photo">
                @if($user->photo)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$user->photo) }}" 
                             alt="Photo actuelle" 
                             class="rounded" 
                             style="width: 100px; height:100px; object-fit:cover;">
                    </div>
                @endif
            </div>

            <hr>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="password">
                <label for="password">Nouveau mot de passe (laisser vide si inchangé)</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                <label for="password_confirmation">Confirmer le mot de passe</label>
            </div>

            <div class="mb-3">
                <a href="{{ route('profile_admins') }}" class="btn btn-secondary col-5">Annuler
                    <i class="bi bi-x-circle"></i>
                </a>
                <button type="submit" class="btn btn-success col-5">Enregistrer
                    <i class="bi bi-check-circle"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
