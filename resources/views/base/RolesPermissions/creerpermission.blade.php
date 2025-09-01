@extends('base/adminBase')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Créer une nouvelle permission</h2>

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

    <form action="{{ route('createpermission') }}" method="POST">
        @csrf

        {{-- Liste déroulante --}}
        <div class="mb-3">
            <label for="name" class="form-label">Type de permission</label>
            <select name="name" id="name" class="form-select" required>
                <option value="" disabled selected>-- Choisir une permission --</option>
                @foreach($options as $option)
                    <option value="{{ $option }}" {{ old('name') == $option ? 'selected' : '' }}>
                        {{ ucfirst($option) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Créer la permission</button>
        <a href="{{ route('listerolespermissions') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
