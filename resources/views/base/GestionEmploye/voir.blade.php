{{-- resources/views/base/GestionEmploye/voir.blade.php --}}
@extends('base/adminBase')

@section('title', 'Détails de l\'Employé')

@section('content')
<div class="container mt-5 ">
    <h4 class="mb-4 mt-4 alert alert-info">Détails de l'employé  : {{ $employe->nom }} {{ $employe->prenom }}</h4>
    <hr>

    {{-- Message flash --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4 shadow-lg">
        <div class="card-body">
            <div class="row g-3">
                {{-- Photo --}}
                <div class="col-md-3 text-center">
                    @if($employe->photo)
                        <img src="{{ asset('storage/'.$employe->photo) }}" alt="Photo" class="rounded-circle img-fluid mb-3">
                    @else
                        <span class="text-muted">Pas de photo</span>
                    @endif
                </div>

                {{-- Informations personnelles --}}
                <div class="col-md-9">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nom :</th>
                                <td>{{ $employe->nom }}</td>
                            </tr>
                            <tr>
                                <th>Prénom :</th>
                                <td>{{ $employe->prenom }}</td>
                            </tr>
                            <tr>
                                <th>Email :</th>
                                <td>{{ $employe->email }}</td>
                            </tr>
                            <tr>
                                <th>Téléphone :</th>
                                <td>{{ $employe->telephone }}</td>
                            </tr>
                            <tr>
                                <th>Sexe :</th>
                                <td>{{ ucfirst($employe->sexe) }}</td>
                            </tr>
                            <tr>
                                <th>Adresse :</th>
                                <td>{{ $employe->adresse }}</td>
                            </tr>
                            <tr>
                                <th>Matricule :</th>
                                <td>{{ $employe->matricule }}</td>
                            </tr>
                            <tr>
                                <th>Date de naissance :</th>
                                <td>{{ $employe->date_naissance }}</td>
                            </tr>
                            <tr>
                                <th>Date d'embauche :</th>
                                <td>{{ $employe->date_embauche }}</td>
                            </tr>
                            <tr>
                                <th>Poste :</th>
                                <td>{{ $employe->poste->titre ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Département :</th>
                                <td>{{ $employe->departement->nom ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Rôles :</th>
                                <td>
                                    @foreach($employe->roles as $role)
                                        <span class="badge bg-info text-dark">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Boutons --}}
    <div class="mb-5">
        <a href="{{ route('employes.edit', $employe->id) }}" class="btn btn-secondary">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <a href="{{ route('employes.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
        <a href="{{ route('employes.assign_role', $employe->id) }}" class="btn btn-warning">
            Assigner un rôle
        </a>
    </div>
</div>
@endsection
