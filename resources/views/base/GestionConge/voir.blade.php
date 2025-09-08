@extends('base.adminBase')

@section('title', 'Détails du Congé')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary"><i class="bi bi-calendar-check me-2"></i>Détails du Congé #{{ $conge->id }}</h3>
    <hr>

    <div class="card shadow-sm rounded">
        <div class="card-body">
            <h5 class="card-title">Informations sur l'employé</h5>
            <hr>
            <div class="d-flex align-items-center mb-3">
                @if($conge->employe->photo)
                    <img src="{{ asset('storage/' . $conge->employe->photo) }}" 
                         alt="Photo" class="rounded-circle me-3" width="60" height="60">
                @else
                    <i class="bi bi-person-circle fs-1 text-secondary me-3"></i>
                @endif
                <div>
                    <strong>{{ $conge->employe->nom }} {{ $conge->employe->prenom }}</strong><br>
                    <small class="text-muted">{{ $conge->employe->email }}</small>
                </div>
            </div>

            <h5 class="card-title mt-3">Détails du congé</h5>
            <hr>
            <p><strong>Type :</strong> {{ ucfirst($conge->type) }}</p>
            <p><strong>Motif :</strong> {{ $conge->motif ?? '—' }}</p>
            <p><strong>Date début :</strong> {{ \Carbon\Carbon::parse($conge->date_debut)->format('d/m/Y') }}</p>
            <p><strong>Date fin :</strong> {{ $conge->date_fin ? \Carbon\Carbon::parse($conge->date_fin)->format('d/m/Y') : '—' }}</p>
            <p><strong>Statut :</strong> 
                @if($conge->statut == 'en_attente')
                    <span class="badge bg-warning">En attente</span>
                @elseif($conge->statut == 'approuve')
                    <span class="badge bg-success">Approuvé</span>
                @else
                    <span class="badge bg-danger">Rejeté</span>
                @endif
            </p>

            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('conges.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour à la liste
                </a>

                @if($conge->statut == 'en_attente')
                    <form action="{{ route('conges.approuver', $conge->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Approuver
                        </button>
                    </form>

                    <form action="{{ route('conges.rejeter', $conge->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-x-circle"></i> Rejeter
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
