@extends('base.adminBase')

@section('title', 'Détails du Paiement')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-secondary"><i class="bi bi-cash-stack me-2"></i>Détails du paiement #{{ $paiement->id }}</h3>
    <hr>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <h5 class="card-title">Informations sur le paiement</h5>
            <hr>
            
            <p><strong>Employé :</strong> 
                {{ $paiement->employe->nom ?? '-' }} {{ $paiement->employe->prenom ?? '' }}
            </p>
            <p>
                <strong>Photo :</strong>
                @if($paiement->employe && $paiement->employe->photo)
                    <img src="{{ asset('storage/' . $paiement->employe->photo) }}" alt="Photo" width="60" class="rounded-circle">
                @else
                    -
                @endif
            </p>
            <p><strong>Date de paiement :</strong> {{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</p>
            <p><strong>Montant :</strong> {{ number_format($paiement->montant, 2, ',', ' ') }} GNF</p>
            <p><strong>Type de paiement :</strong> {{ ucfirst($paiement->type_paiement) }}</p>
            <p><strong>Mode de paiement :</strong> {{ ucfirst($paiement->mode_paiement) }}</p>

            <div class="mt-4">
                <a href="{{ route('paiements.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour à la liste
                </a>
                <a href="{{ route('paiements.edit', $paiement->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
