@extends('base.adminBase')

@section('title', 'Mon Profil')

@section('content')
<div class="container mt-4 mb-4">
    <h4 class="mb-4 alert alert-info">Mon Profil
        <i class="bi bi-person-circle"></i>
    </h4>
    <hr>

    <!-- Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm p-4">
        <div class="text-center mb-3">
            @if($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" 
                     alt="Photo de profil" 
                     class="rounded-circle" 
                     style="width:120px; height:120px; object-fit:cover;">
            @else
                <img src="{{ asset('images/default-user.png') }}" 
                     alt="Photo par défaut" 
                     class="rounded-circle" 
                     style="width:120px; height:120px; object-fit:cover;">
            @endif
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Nom</th>
                <td>{{ $user->nom ?? '-' }}</td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td>{{ $user->prenom ?? '-' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td>{{ $user->telephone ?? '-' }}</td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td>{{ $user->adresse ?? '-' }}</td>
            </tr>
            <tr>
                <th>Date de naissance</th>
                <td>{{ $user->date_naissance ?? '-' }}</td>
            </tr>
            <tr>
                <th>Date d’embauche</th>
                <td>{{ $user->date_embauche ?? '-' }}</td>
            </tr>
            <tr>
                <th>Rôles</th>
                <td>
                    @foreach($user->roles as $role)
                        <span class="badge bg-primary">{{ ucfirst($role->name) }}</span>
                    @endforeach
                </td>
            </tr>
        </table>

        <div class="row mt-3 mb-4">
            <div class="col">
                <a href="{{ route('edit_profile_admins', $user->id) }}" class="btn btn-warning w-100">Modifier
                    <i class="bi bi-pencil"></i>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('employes.index') }}" class="btn btn-secondary w-100">Retour
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
