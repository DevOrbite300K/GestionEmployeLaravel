@extends('base.employeBase')

@section('title', 'Mes Documents')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 text-primary"><i class="bi bi-folder2-open me-2"></i>Mes Documents</h3>
        <a href="{{ route('employe.documents.upload') }}" class="btn btn-primary">
            <i class="bi bi-upload me-1"></i> Uploader un nouveau document
        </a>
    </div>
    <hr>

    @if($documents->isEmpty())
        <div class="alert alert-info">Vous n'avez aucun document pour le moment.</div>
    @else
        <div class="list-group shadow-sm">
            @foreach($documents as $doc)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2 shadow-sm rounded">
                    <div class="d-flex align-items-center">
                        @php
                            // Déterminer l'icône selon le type de fichier
                            $ext = pathinfo($doc->fichier, PATHINFO_EXTENSION);
                            switch(strtolower($ext)) {
                                case 'pdf': $icon = 'bi-file-earmark-pdf text-danger'; break;
                                case 'doc':
                                case 'docx': $icon = 'bi-file-earmark-word text-primary'; break;
                                case 'xls':
                                case 'xlsx': $icon = 'bi-file-earmark-excel text-success'; break;
                                case 'png':
                                case 'jpg':
                                case 'jpeg': $icon = 'bi-file-earmark-image text-warning'; break;
                                default: $icon = 'bi-file-earmark-text text-secondary';
                            }
                        @endphp

                        <i class="bi {{ $icon }} fs-3 me-3"></i>
                        <div>
                            <strong>{{ $doc->nom }}</strong>
                            <div class="small text-muted">Ajouté le {{ $doc->created_at->format('d/m/Y') }}</div>
                            <div class="small text-muted">Type: {{ $doc->typefichier }}</div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        {{-- Bouton Visualiser --}}
                        <a href="{{ asset('storage/' . $doc->chemin) }}" target="_blank" 
                        class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye me-1"></i> Visualiser
                        </a>

                        {{-- Bouton Télécharger --}}
                        <a href="{{ asset('storage/' . $doc->chemin) }}" download
                        class="btn btn-outline-success btn-sm">
                            <i class="bi bi-download me-1"></i> Télécharger
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
