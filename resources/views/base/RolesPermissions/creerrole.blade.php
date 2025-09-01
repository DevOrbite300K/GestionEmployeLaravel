@extends('base/adminBase')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Créer un nouveau rôle</h2>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire --}}
    <form action="{{ route('createrole') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="role" class="form-label">Sélectionner le rôle</label>
            <select name="name" id="role" class="form-select" required>
                <option value="" disabled selected>-- Choisir un rôle --</option>
                <option value="admin" {{ old('name') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="rh" {{ old('name') == 'rh' ? 'selected' : '' }}>RH</option>
                <option value="comptable" {{ old('name') == 'comptable' ? 'selected' : '' }}>Comptable</option>
                <option value="employe" {{ old('name') == 'employe' ? 'selected' : '' }}>Employé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Créer le rôle</button>
        <a href="{{ route('listerolespermissions') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
