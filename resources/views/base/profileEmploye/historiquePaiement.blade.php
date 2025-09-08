@extends('base.employeBase')

@section('title', 'Historique de Paiement')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary">
        <i class="bi bi-cash-stack me-2"></i> Historique de mes Paiements
    </h3>

    @if($paiements->isEmpty())
        <div class="alert alert-info text-center fs-5 shadow-sm">
            <i class="bi bi-info-circle me-2"></i> Aucun paiement enregistré pour le moment.
        </div>
    @else
        <div class="card shadow-lg rounded-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th><i class="bi bi-calendar-date me-1"></i> Date de Paiement</th>
                                <th><i class="bi bi-cash-coin me-1"></i> Montant</th>
                                <th><i class="bi bi-tags me-1"></i> Type</th>
                                <th><i class="bi bi-credit-card me-1"></i> Mode</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paiements as $paiement)
                                <tr>
                                    {{-- Date formatée --}}
                                    <td>{{ \Carbon\Carbon::parse($paiement->date_paiement)->format('d/m/Y') }}</td>

                                    {{-- Montant avec séparateur de milliers --}}
                                    <td><strong>{{ number_format($paiement->montant, 0, ',', ' ') }} GNF</strong></td>

                                    {{-- Type de paiement avec badge --}}
                                    <td>
                                        @php
                                            $typeColors = [
                                                'salaire' => 'success',
                                                'prime' => 'info',
                                                'remboursement' => 'warning',
                                                'indemnite' => 'primary',
                                                'autre' => 'secondary'
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $typeColors[$paiement->type_paiement] ?? 'secondary' }}">
                                            {{ ucfirst($paiement->type_paiement) }}
                                        </span>
                                    </td>

                                    {{-- Mode de paiement avec icône --}}
                                    <td>
                                        @switch($paiement->mode_paiement)
                                            @case('carte')
                                                <i class="bi bi-credit-card-2-front text-primary me-1"></i> Carte
                                                @break
                                            @case('especes')
                                                <i class="bi bi-cash text-success me-1"></i> Espèces
                                                @break
                                            @case('cheque')
                                                <i class="bi bi-bank text-info me-1"></i> Chèque
                                                @break
                                            @case('orangeMoney')
                                                <i class="bi bi-phone text-warning me-1"></i> Orange Money
                                                @break
                                            @default
                                                {{ ucfirst($paiement->mode_paiement) }}
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
