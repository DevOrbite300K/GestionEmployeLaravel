@extends('base/adminBase')

@section('title', 'Admin - Gestion des Employés')

@section('content')


<div class="card welcome-card">
                <div class="card-body">
                    <h2 class="card-title">Bienvenue dans MEES</h2>
                    <hr>
                    <p class="card-text">
                        Gestion complète de vos Employés avec notre système intégré. Suivez les présences, gérez les documents,
                        consultez les rapports et bien plus encore à partir d'une interface unique et intuitive.
                    </p>
                    <p class="card-text">
                        Utilisez le menu Hamburger <i class="bi bi-list text-primary fs-5"></i> pour accéder aux différentes fonctionnalités de gestion des employés.
                    </p>
                </div>
</div>

<!-- Section employés récents -->
<h3 class="section-title">Employés Récents</h3>
            
<div class="card employee-table mb-5 shadow-lg">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Matricule</th>
                        <th>Responsable</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employes as $employe)
                        <tr>
                            {{-- Photo --}}
                            <td>
                                <img src="{{ $employe->photo ? asset('storage/'.$employe->photo) : 'https://via.placeholder.com/40' }}" 
                                     class="rounded-circle" width="40" height="40" alt="Photo">
                            </td>

                            <td>{{ $employe->nom }}</td>
                            <td>{{ $employe->prenom }}</td>
                            <td>{{ $employe->email }}</td>
                            <td>{{ $employe->telephone ?? '---' }}</td>
                            <td>{{ $employe->matricule ?? '---' }}</td>
                            <td>
                                @if($employe->est_responsable)
                                    Oui{{ $employe->departement ? ' - ' . $employe->departement->nom : '-' }}
                                @else
                                    Non
                                @endif
                            </td>



                            {{-- Actions --}}
                            <td>
                                <a href="{{ route('employes.show', $employe->id) }}" class="btn btn-sm btn-primary me-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('employes.edit', $employe->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @role('admin')
                                <form action="{{ route('employes.destroy', $employe->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet employé ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endrole
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Aucun employé trouvé</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


    
@endsection