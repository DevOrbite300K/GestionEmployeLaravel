@extends('base.employeBase')

@section('title', 'Mes Congés')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 text-primary"><i class="bi bi-calendar-check me-2"></i> Mes Demandes de Congé</h3>
        <a href="{{ route('employe.demandeconge.get') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nouvelle Demande
        </a>
    </div> <hr>

    @if($conges->isEmpty())
        <div class="alert alert-info">Vous n'avez fait aucune demande de congé.</div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Type</th>
                        <th>Motif</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($conges as $conge)
                        <tr>
                            <td>{{ ucfirst($conge->type) }}</td>
                            <td>{{ $conge->motif ?? '—' }}</td>
                            <td>{{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }}</td>
                            <td>{{ $conge->date_fin ? \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') : '—' }}</td>
                            <td>
                                @if($conge->statut == 'en_attente')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @elseif($conge->statut == 'approuve')
                                    <span class="badge bg-success">Approuvé</span>
                                @else
                                    <span class="badge bg-danger">Rejeté</span>
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
