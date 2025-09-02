{{-- resources/views/base/GestionEmploye/edit.blade.php --}}
@extends('base/adminBase')

@section('title', 'Modifier Employé')

@section('content')
<div class="container mt-4 mb-4">
    <h4 class="mb-4 alert alert-primary">Modifier Employé
        <i class="bi bi-person-lines-fill"></i>
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

    <form action="{{ route('employes.update', $employe->id) }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded">
        {{-- Token CSRF --}}
        @csrf
        @method('PUT')

        <div class="row g-3">
            {{-- Nom --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom" value="{{ old('nom', $employe->nom) }}" required>
                    <label for="nom">Nom</label>
                </div>
            </div>

            {{-- Prénom --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Prénom" value="{{ old('prenom', $employe->prenom) }}">
                    <label for="prenom">Prénom</label>
                </div>
            </div>

            {{-- Email --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email', $employe->email) }}" required>
                    <label for="email">Email</label>
                </div>
            </div>

            {{-- Téléphone --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" name="telephone" class="form-control" id="telephone" placeholder="Téléphone" value="{{ old('telephone', $employe->telephone) }}">
                    <label for="telephone">Téléphone</label>
                </div>
            </div>

            {{-- Sexe --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <select name="sexe" id="sexe" class="form-select">
                        <option value="homme" {{ old('sexe', $employe->sexe) == 'homme' ? 'selected' : '' }}>Homme</option>
                        <option value="femme" {{ old('sexe', $employe->sexe) == 'femme' ? 'selected' : '' }}>Femme</option>
                        <option value="autre" {{ old('sexe', $employe->sexe) == 'autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    <label for="sexe">Sexe</label>
                </div>
            </div>

            {{-- Adresse --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" name="adresse" class="form-control" id="adresse" placeholder="Adresse" value="{{ old('adresse', $employe->adresse) }}">
                    <label for="adresse">Adresse</label>
                </div>
            </div>

            {{-- Matricule --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" name="matricule" class="form-control" id="matricule" placeholder="Matricule" value="{{ old('matricule', $employe->matricule) }}">
                    <label for="matricule">Matricule</label>
                </div>
            </div>

            {{-- Date de naissance --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" name="date_naissance" class="form-control" id="date_naissance" placeholder="Date de naissance" value="{{ old('date_naissance', $employe->date_naissance) }}">
                    <label for="date_naissance">Date de naissance</label>
                </div>
            </div>

            {{-- Date d'embauche --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" name="date_embauche" class="form-control" id="date_embauche" placeholder="Date d'embauche" value="{{ old('date_embauche', $employe->date_embauche) }}">
                    <label for="date_embauche">Date d'embauche</label>
                </div>
            </div>

            {{-- Photo --}}
            <div class="col-md-6">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" name="photo" class="form-control" id="photo">
                @if($employe->photo)
                    <img src="{{ asset('storage/'.$employe->photo) }}" alt="Photo actuelle" class="mt-2 rounded-circle" width="80" height="80">
                @endif
            </div>

            {{-- Département --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <select name="departement_id" id="departement_id" class="form-select">
                        <option value="">-- Sélectionner Département --</option>
                        @foreach($departements as $departement)
                            <option value="{{ $departement->id }}" {{ old('departement_id', $employe->departement_id) == $departement->id ? 'selected' : '' }}>
                                {{ $departement->nom }}
                            </option>
                        @endforeach
                    </select>
                    <label for="departement_id">Département</label>
                </div>
            </div>

            {{-- Poste --}}
            <div class="col-md-6">
                <div class="form-floating">
                    <select name="poste_id" id="poste_id" class="form-select">
                        <option value="">-- Sélectionner Poste --</option>
                        @foreach($postes as $poste)
                            <option value="{{ $poste->id }}" {{ old('poste_id', $employe->poste_id) == $poste->id ? 'selected' : '' }}>
                                {{ $poste->nom }}
                            </option>
                        @endforeach
                    </select>
                    <label for="poste_id">Poste</label>
                </div>
            </div>
            {{-- Est Responsable --}}
            @role('admin')
                <div class="form-check">
                    {{-- Champ caché pour envoyer 0 si décoché --}}
                    <input type="hidden" name="est_responsable" value="0">

                    {{-- Checkbox --}}
                    <input 
                        type="checkbox" 
                        name="est_responsable" 
                        value="1" 
                        id="est_responsable" 
                        class="form-check-input"
                        {{ old('est_responsable', $employe->est_responsable ?? false) ? 'checked' : '' }}
                    >

                    <label for="est_responsable" class="form-check-label">
                        Est Responsable
                    </label>
                </div>


            @endrole
        </div>

        {{-- Bouton submit --}}
        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Enregistrer les modifications
            </button>
            <a href="{{ route('employes.index') }}" class="btn btn-secondary ms-2">Annuler</a>
        </div>
    </form>
</div>
@endsection
