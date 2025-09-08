@extends('base.adminBase')

@section('title', 'Rapport RH')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 text-secondary"><i class="bi bi-graph-up me-2"></i>Rapport Global RH</h2>
    <hr>

    {{-- Statistiques globales --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-people fs-1 text-primary"></i>
                    <h5 class="mt-2">{{ $totalEmployes }}</h5>
                    <p class="text-muted mb-0">Employés</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-briefcase fs-1 text-success"></i>
                    <h5 class="mt-2">{{ $totalPostes }}</h5>
                    <p class="text-muted mb-0">Postes</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-building fs-1 text-info"></i>
                    <h5 class="mt-2">{{ $totalDept }}</h5>
                    <p class="text-muted mb-0">Départements</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-file-text fs-1 text-warning"></i>
                    <h5 class="mt-2">{{ $totalContrats }}</h5>
                    <p class="text-muted mb-0">Contrats</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Congés --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-hourglass-split fs-1 text-secondary"></i>
                    <h5 class="mt-2">{{ $congesEnAttente }}</h5>
                    <p class="text-muted mb-0">Congés en attente</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-check-circle fs-1 text-success"></i>
                    <h5 class="mt-2">{{ $congesApprouves }}</h5>
                    <p class="text-muted mb-0">Congés approuvés</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <i class="bi bi-x-circle fs-1 text-danger"></i>
                    <h5 class="mt-2">{{ $congesRejetes }}</h5>
                    <p class="text-muted mb-0">Congés rejetés</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Paiements --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-cash-stack me-2"></i>Résumé des Paiements</h5>
            <p><strong>Total versé :</strong> {{ number_format($sommePaiements, 2, ',', ' ') }} GNF</p>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Employé</th>
                        <th>Montant</th>
                        <th>Type</th>
                        <th>Mode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dernierPaiements as $pay)
                        <tr>
                            <td>{{ $pay->date_paiement->format('d/m/Y') }}</td>
                            <td>{{ $pay->employe->nom }} {{ $pay->employe->prenom }}</td>
                            <td>{{ number_format($pay->montant, 2, ',', ' ') }} GNF</td>
                            <td>{{ ucfirst($pay->type_paiement) }}</td>
                            <td>{{ ucfirst($pay->mode_paiement) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Derniers employés --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-person-lines-fill me-2"></i>Derniers employés ajoutés</h5>
            <ul class="list-group">
                @foreach($employes as $emp)
                    <li class="list-group-item d-flex align-items-center">
                        <img src="{{ $emp->photo ? asset('storage/'.$emp->photo) : 'https://via.placeholder.com/40' }}" 
                             class="rounded-circle me-3" width="40" height="40">
                        <div>
                            <strong>{{ $emp->nom }} {{ $emp->prenom }}</strong>
                            <div class="text-muted small">{{ $emp->email }}</div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>








<div class="container py-4">
    <h2 class="mb-4 text-secondary">Plus de rapports et actions rapides 
        <i><i class="bi bi-gear-fill"></i><i class="bi bi-gear-fill"></i><i class="bi bi-gear-fill"></i></i>
    </h2>
    <hr>

    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <button class="btn btn-warning w-100 py-3 statut-btn" data-statut="en_retard">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>En retard
            </button>
        </div>

        <div class="col-md-3 col-sm-6">
            <button class="btn btn-danger w-100 py-3 statut-btn" data-statut="absent">
                <i class="bi bi-x-circle-fill me-2"></i>Absent
            </button>
        </div>

        <div class="col-md-3 col-sm-6">
            <button class="btn btn-success w-100 py-3 statut-btn" data-statut="present">
                <i class="bi bi-check-circle-fill me-2"></i>Présent
            </button>
        </div>

        <div class="col-md-3 col-sm-6">
            <a href="{{ route('pointages.index') }}" class="btn btn-primary w-100 py-3">
                <i class="bi bi-list-ul me-2"></i>Tous les pointages
            </a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pointageModal" tabindex="-1" aria-labelledby="pointageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pointageModalLabel">Employés filtrés</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Le tableau sera généré directement par le contrôleur -->
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.statut-btn');

        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                const statut = this.dataset.statut;

                fetch(`/rapports/statut/${statut}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('modalBody').innerHTML = html;
                        const modal = new bootstrap.Modal(document.getElementById('pointageModal'));
                        modal.show();
                    });
            });
        });
    });
    </script>
@endsection