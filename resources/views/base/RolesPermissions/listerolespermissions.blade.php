@extends('base/adminBase')

@section('content')
<div class="container mt-5">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <h4 class="mb-4 alert alert-info">Gestion des Rôles et Permissions</h4>
    <hr>

    {{-- Section Rôles --}}
    <div class="card mb-4 shadow-sm col-12">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Liste des Rôles</h5>
        </div>
        <div class="card-body">
            @if($roles->count())
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom du rôle</th>
                            <th>Permissions associées</th>
                            <th>
                                actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                    @foreach($role->permissions as $perm)
                                        {{-- Dropdown Bootstrap pour chaque permission --}}
                                        <div class="dropdown d-inline-block me-1">
                                            <a class="btn btn-sm btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ ucfirst($perm->name) }}
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <form action="{{ route('removepermissionfromrole') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                        <input type="hidden" name="permission_id" value="{{ $perm->id }}">
                                                        <button type="submit" class="dropdown-item text-danger">Supprimer la permission</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                </td>

                                <td>
                                    <form action="{{ route('deleterole', $role->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?');" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Aucun rôle trouvé.</p>
            @endif
        </div>
    </div>
    <hr>

    {{-- Section Permissions --}}
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Liste des Permissions</h5>
        </div>
        <div class="card-body">
            @if($permissions->count())
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom de la permission</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <form action="{{ route('deletepermission', $permission->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette permission ?');" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Aucune permission trouvée.</p>
            @endif
        </div>
    </div>
    <hr class="my-4">

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Action rapide</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('createroleform') }}" class="btn btn-primary me-2">Ajouter un nouveau rôle
                <i class="bi bi-plus-circle"></i>
            </a>
            <a href="{{ route('createpermissionform') }}" class="btn btn-secondary">Ajouter une nouvelle permission
                <i class="bi bi-plus-circle"></i>
            </a>
            <a href="{{ route('assignpermissiontoroleform') }}" class="btn btn-info">Assigner une permission à un rôle
                <i class="bi bi-plus-circle"></i>
            </a>
        </div>
    </div>
</div>
@endsection
