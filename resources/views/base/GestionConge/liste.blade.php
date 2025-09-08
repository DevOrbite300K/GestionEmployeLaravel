@extends('base.adminBase')

@section('title', 'Gestion des Congés')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary"><i class="bi bi-calendar-check me-2"></i>Gestion des Congés</h3>
    <hr>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($conges->isEmpty())
        <div class="alert alert-info">Aucun congé enregistré.</div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Employé</th>
                        <th>Type</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($conges as $conge)
                        <tr>
                            <td>{{ $conge->id }}</td>
                            <td>
                                @if($conge->employe->photo)
                                    <img src="{{ asset('storage/' . $conge->employe->photo) }}" 
                                         alt="Photo" class="rounded-circle" width="40" height="40">
                                @else
                                    <i class="bi bi-person-circle fs-3 text-secondary"></i>
                                @endif
                            </td>
                            <td>{{ $conge->employe->nom }} {{ $conge->employe->prenom }}</td>
                            <td>{{ ucfirst($conge->type) }}</td>
                            <td>{{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }}</td>
                            <td>{{ $conge->date_fin ? \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') : '—' }}</td>
                            <td>
                                @if($conge->statut == 'en_attente')
                                    <span class="badge bg-warning">En attente</span>
                                @elseif($conge->statut == 'approuve')
                                    <span class="badge bg-success">Approuvé</span>
                                @else
                                    <span class="badge bg-danger">Rejeté</span>
                                @endif
                            </td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('conges.show', $conge->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <form action="{{ route('conges.destroy', $conge->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce congé ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                                @if($conge->statut == 'en_attente')
                                    <form action="{{ route('conges.approuver', $conge->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="bi bi-check-circle"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('conges.rejeter', $conge->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
