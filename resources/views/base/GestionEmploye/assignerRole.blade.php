@extends('base.adminBase')

@section('title', 'Assigner un rôle')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Assigner un rôle à {{ $employe->nom }} {{ $employe->prenom }}</h2>

    <!-- Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $erreur)
                    <li>{{ $erreur }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employes.assign_role.post', $employe->id) }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="form-floating mb-3">
            <select name="role_id" id="role_id" class="form-select" required>
                <option value="">-- Sélectionner un rôle --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                        {{ $employe->roles->contains($role->id) ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            <label for="role_id">Rôle</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Assigner
            <i class="bi bi-check-circle ms-2"></i>
        </button>
        <a href="{{ route('employes.index') }}" class="btn btn-secondary w-100 mt-2">Retour
            <i class="bi bi-arrow-left ms-2"></i>
        </a>
    </form>
</div>
@endsection
