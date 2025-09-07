@extends('base.employeBase')

@section('title', 'Modifier mon profil')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i> Modifier mon profil
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Messages de succès / erreur -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i> Erreurs dans le formulaire :
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulaire -->
                    <form action="{{ route('employe.profile.modifier') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom</label>
                                <input type="text" name="nom" value="{{ old('nom', $employe->nom) }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Prénom</label>
                                <input type="text" name="prenom" value="{{ old('prenom', $employe->prenom) }}" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Adresse email</label>
                            <input type="email" name="email" value="{{ old('email', $employe->email) }}" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="telephone" value="{{ old('telephone', $employe->telephone) }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Adresse</label>
                            <input type="text" name="adresse" value="{{ old('adresse', $employe->adresse) }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date de naissance</label>
                            <input type="date" name="date_naissance" value="{{ old('date_naissance', $employe->date_naissance) }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Photo de profil</label>
                            <input type="file" name="photo" class="form-control">
                            @if($employe->photo)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $employe->photo) }}" class="rounded-circle" width="80" height="80" alt="Photo">
                                </div>
                            @endif
                        </div>

                        <hr>
                        <div class="text-end">
                            <a href="{{ route('employe.profile') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Sauvegarder
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
