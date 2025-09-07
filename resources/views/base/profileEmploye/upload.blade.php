@extends('base.employeBase')

@section('title', 'Ajouter un document')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Ajouter un document</h2>

    {{-- Messages de succès/erreur --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulaire d'upload --}}
    <form method="POST" action="{{ route('employe.documents.upload.post') }}" enctype="multipart/form-data" class="shadow-sm p-4 rounded bg-light">
        @csrf

        <div class="form-floating mb-3">
            <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom du document" required>
            <label for="nom"><i class="bi bi-file-text me-1"></i> Nom du document</label>
        </div>

        <div class="form-floating mb-3">
            <select name="type" id="type" class="form-select" required>
                <option value="" selected disabled>Choisir le type</option>
                <option value="contrat">Contrat</option>
                <option value="fiche_de_paie">Fiche de paie</option>
                <option value="cv">CV</option>
                <option value="diplome">Diplôme</option>
                <option value="autre">Autre</option>
            </select>
            <label for="type"><i class="bi bi-tags me-1"></i> Type</label>
        </div>

        <div class="form-floating mb-3">
            <select name="typefichier" id="typefichier" class="form-select" required>
                <option value="" selected disabled>Choisir le type de fichier</option>
                <option value="pdf">PDF</option>
                <option value="docx">DOCX</option>
                <option value="jpg">JPG</option>
                <option value="png">PNG</option>
                <option value="autre">Autre</option>
            </select>
            <label for="typefichier"><i class="bi bi-file-earmark me-1"></i> Type du fichier</label>
        </div>

        <div class="mb-3">
            <label for="chemin" class="form-label"><i class="bi bi-upload me-1"></i> Fichier</label>
            <input type="file" name="chemin" id="chemin" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-upload me-1"></i> Ajouter le document
        </button>
    </form>

    {{-- Liste des documents de l'employé --}}
    @if(isset($documents) && $documents->isNotEmpty())
        <h3 class="mt-5 mb-3">Mes documents</h3>
        <div class="list-group shadow-sm">
            @foreach($documents as $doc)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2 rounded shadow-sm">
                    <div class="d-flex align-items-center">
                        @php
                            $ext = pathinfo($doc->chemin, PATHINFO_EXTENSION);
                            switch(strtolower($ext)) {
                                case 'pdf': $icon = 'bi-file-earmark-pdf text-danger'; break;
                                case 'doc': case 'docx': $icon = 'bi-file-earmark-word text-primary'; break;
                                case 'xls': case 'xlsx': $icon = 'bi-file-earmark-excel text-success'; break;
                                case 'png': case 'jpg': case 'jpeg': $icon = 'bi-file-earmark-image text-warning'; break;
                                default: $icon = 'bi-file-earmark-text text-secondary';
                            }
                        @endphp

                        <i class="bi {{ $icon }} fs-3 me-3"></i>
                        <div>
                            <strong>{{ $doc->nom }}</strong>
                            <div class="small text-muted">Ajouté le {{ $doc->created_at->format('d/m/Y') }}</div>
                            <div class="small text-muted">Type: {{ $doc->type }}</div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ asset('storage/' . $doc->chemin) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye me-1"></i> Visualiser
                        </a>
                        <a href="{{ asset('storage/' . $doc->chemin) }}" download class="btn btn-outline-success btn-sm">
                            <i class="bi bi-download me-1"></i> Télécharger
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
