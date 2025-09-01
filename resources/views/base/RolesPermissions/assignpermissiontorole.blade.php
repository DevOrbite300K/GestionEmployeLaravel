@extends('base/adminBase')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Assigner une permission à un rôle</h2>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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

    <form action="{{ route('assignpermissiontorole') }}" method="POST">
        @csrf

        {{-- Sélection du rôle --}}
        <div class="mb-3">
            <label for="role_id" class="form-label">Rôle</label>
            <select name="role_id" id="role_id" class="form-select" required>
                <option value="" disabled selected>-- Choisir un rôle --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Sélection de la permission --}}
        <div class="mb-3">
            <label for="permission_id" class="form-label">Permission</label>
            <select name="permission_id" id="permission_id" class="form-select" required>
                <option value="" disabled selected>-- Choisir une permission --</option>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}" {{ old('permission_id') == $permission->id ? 'selected' : '' }}>
                        {{ ucfirst($permission->name) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assigner la permission</button>
        <a href="{{ route('listerolespermissions') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
