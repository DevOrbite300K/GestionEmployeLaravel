@extends('base.employeBase')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary"><i class="bi bi-clock-history me-2"></i>Pointage du jour</h3>
    <hr>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body text-center">
            @if($pointage)
                <h5 class="card-title text-secondary">Vous avez déjà pointé aujourd'hui</h5>
                
                <p class="mb-2"><strong>Heure d'arrivée :</strong> {{ $pointage->heure_arrivee }}</p>
                
                @if($pointage->heure_depart)
                    <p class="mb-2"><strong>Heure de départ :</strong> {{ $pointage->heure_depart }}</p>
                    <span class="badge bg-success fs-6">Statut : {{ ucfirst($pointage->statut) }}</span>
                @else
                    <form method="POST" action="{{ route('employe.pointage.depart') }}">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-lg mt-3">
                            <i class="bi bi-box-arrow-right me-1"></i> Pointer départ
                        </button>
                    </form>
                    <span class="badge bg-info mt-3 fs-6">Statut actuel : {{ ucfirst($pointage->statut) }}</span>
                @endif
            @else
                <h5 class="card-title text-success mb-3">Prêt à pointer votre arrivée ?</h5>
                <form method="POST" action="{{ route('employe.pointage.post') }}">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-check2-square me-1"></i> Pointer arrivée
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
