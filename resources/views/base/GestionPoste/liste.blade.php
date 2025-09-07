@extends('base.adminBase')

@section('title', 'Liste des postes')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">📋 Liste des postes</h1>
        <a href="{{ route('postes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus"></i> Ajouter un poste
        </a>
    </div>
    <hr>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Salaire de base</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($postes as $poste)
            <tr>
                <td>{{ $poste->id }}</td>
                <td><a href="{{ route('postes.show', $poste->id) }}">{{ $poste->titre }}</a></td>
                <td>{{ number_format($poste->salaire_base, 2, ',', ' ') }} GNF</td>
                <td>
                    <a href="{{ route('postes.edit', $poste->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                    <a href="{{ route('postes.show', $poste->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('postes.lier_employe', $poste->id) }}" class="btn btn-sm btn-warning">
                        assignation<i class="bi bi-link"></i></a>

                    <form action="{{ route('postes.destroy', $poste->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce poste ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="d-flex justify-content-end">
        {{ $postes->links() }}
    </div> --}}
</div>
@endsection
