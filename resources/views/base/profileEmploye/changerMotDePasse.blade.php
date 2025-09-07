@extends('base.employeBase')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h3 class="mb-4 text-center">
        <i class="bi bi-shield-lock-fill me-2"></i> Changer de mot de passe
    </h3>
    <hr>

    {{-- Messages d'erreur --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('employe.changerMotDePasse') }}">
        @csrf

        {{-- Mot de passe actuel --}}
        <div class="form-floating mb-3 position-relative">
            <input type="password" name="current_password" id="current_password" 
                   class="form-control" placeholder="Mot de passe actuel" required>
            <label for="current_password">
                <i class="bi bi-lock-fill me-2"></i> Mot de passe actuel
            </label>
        </div>

        {{-- Nouveau mot de passe --}}
        <div class="form-floating mb-3 position-relative">
            <input type="password" name="new_password" id="new_password" 
                   class="form-control" placeholder="Nouveau mot de passe" required>
            <label for="new_password">
                <i class="bi bi-key-fill me-2"></i> Nouveau mot de passe
            </label>
        </div>

        {{-- Confirmation du mot de passe --}}
        <div class="form-floating mb-4 position-relative">
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                   class="form-control" placeholder="Confirmer le mot de passe" required>
            <label for="new_password_confirmation">
                <i class="bi bi-check2-circle me-2"></i> Confirmer le mot de passe
            </label>
        </div>

        {{-- Bouton --}}
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-arrow-repeat me-2"></i> Changer le mot de passe
            </button>
        </div>

        <a href="{{ route('employe.profile') }}" class="btn btn-link"> <i class="bi bi-arrow-left"></i> Retourner au profil
            
        </a>
    </form>
</div>
@endsection
