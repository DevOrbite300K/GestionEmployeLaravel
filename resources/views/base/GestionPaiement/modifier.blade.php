@extends('base.adminBase')

@section('title', 'Modifier un Paiement')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-secondary"><i class="bi bi-pencil me-2"></i>Modifier le paiement #{{ $paiement->id }}</h3>
    <hr>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <form action="{{ route('paiements.update', $paiement->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Employé --}}
                <div class="form-floating mb-3 position-relative">
                    <select name="employe_id" id="employe_id" class="form-select pe-5" required>
                        @foreach($employes as $employeItem)
                            <option value="{{ $employeItem->id }}" {{ $paiement->employe_id == $employeItem->id ? 'selected' : '' }}>
                                {{ $employeItem->nom }} {{ $employeItem->prenom }}
                            </option>
                        @endforeach
                    </select>
                    <label for="employe_id"><i class="bi bi-person me-1"></i>Employé</label>
                </div>

                {{-- Date de paiement --}}
                <div class="form-floating mb-3 position-relative">
                    <input type="date" name="date_paiement" id="date_paiement" class="form-control ps-5" 
                           value="{{ $paiement->date_paiement->format('Y-m-d') }}" required>
                    <label for="date_paiement"><i class="bi bi-calendar-date me-1"></i>Date de paiement</label>
                </div>

                {{-- Montant --}}
                <div class="form-floating mb-3 position-relative">
                    <input type="number" step="0.01" name="montant" id="montant" class="form-control ps-5" 
                           value="{{ $paiement->montant }}" required>
                    <label for="montant"><i class="bi bi-cash-stack me-1"></i>Montant</label>
                </div>

                {{-- Type de paiement --}}
                <div class="form-floating mb-3 position-relative">
                    <select name="type_paiement" id="type_paiement" class="form-select pe-5" required>
                        @foreach(['salaire', 'remboursement', 'prime', 'indemnite', 'autre'] as $type)
                            <option value="{{ $type }}" {{ $paiement->type_paiement == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                    <label for="type_paiement"><i class="bi bi-list-check me-1"></i>Type de paiement</label>
                </div>

                {{-- Mode de paiement --}}
                <div class="form-floating mb-4 position-relative">
                    <select name="mode_paiement" id="mode_paiement" class="form-select pe-5" required>
                        @foreach(['carte','especes','cheque','orangeMoney'] as $mode)
                            <option value="{{ $mode }}" {{ $paiement->mode_paiement == $mode ? 'selected' : '' }}>
                                {{ ucfirst($mode) }}
                            </option>
                        @endforeach
                    </select>
                    <label for="mode_paiement"><i class="bi bi-credit-card me-1"></i>Mode de paiement</label>
                </div>

                {{-- Boutons --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('paiements.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-pencil me-1"></i>Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
