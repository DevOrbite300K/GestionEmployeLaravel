@extends('base.adminBase')

@section('title', 'Liste des Paiements')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-secondary"><i class="bi bi-cash-stack me-2"></i>Liste des paiements</h3>
    <hr>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('paiements.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle me-1"></i> Ajouter un paiement
    </a>

    @if($paiements->isEmpty())
        <div class="alert alert-info">Aucun paiement enregistré.</div>
    @else
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Employé</th>
                    <th>Photo</th>
                    <th>Date de paiement</th>
                    <th>Montant</th>
                    <th>Type</th>
                    <th>Mode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paiements as $paiement)
                    <tr>
                        <td>{{ $paiement->id }}</td>
                        <td>{{ $paiement->employe->nom ?? '-' }} {{ $paiement->employe->prenom ?? '' }}</td>
                        <td>
                            @if($paiement->employe && $paiement->employe->photo)
                                <img src="{{ asset('storage/' . $paiement->employe->photo) }}" alt="Photo" width="40" class="rounded-circle">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</td>
                        <td>{{ number_format($paiement->montant, 2, ',', ' ') }} GNF</td>
                        <td>{{ ucfirst($paiement->type_paiement) }}</td>
                        <td>{{ ucfirst($paiement->mode_paiement) }}</td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('paiements.show', $paiement->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('paiements.edit', $paiement->id) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('paiements.destroy', $paiement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce paiement ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
