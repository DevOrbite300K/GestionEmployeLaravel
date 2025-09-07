@extends('base.employeBase')

@section('content')
<div class="container">
    <h3 class="mb-4">Mes Pointages</h3>
    <hr>

    @if($pointages->isEmpty())
        <div class="alert alert-info">Aucun pointage enregistré.</div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Heure d'arrivée</th>
                        <th>Heure de départ</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pointages as $pointage)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($pointage->date_pointage)->format('d/m/Y') }}</td>
                            <td>{{ $pointage->heure_arrivee ?? '-' }}</td>
                            <td>{{ $pointage->heure_depart ?? '-' }}</td>
                            <td>
                                @if($pointage->statut === 'present')
                                    <span class="badge bg-success">Présent</span>
                                @elseif($pointage->statut === 'absent')
                                    <span class="badge bg-danger">Absent</span>
                                @else
                                    <span class="badge bg-warning text-dark">En retard</span>
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
