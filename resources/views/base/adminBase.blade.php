<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title', 'HR Manager - Gestion des Employés')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #6f42c1;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-bg: #f8f9fc;
            --sidebar-bg: #2c3136;
            --sidebar-header-bg: #24282c;
            --sidebar-hover: #3a3f45;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        .navbar-brand {
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        
        /* ---------- STYLE AMÉLIORÉ DU OFFCANVAS ---------- */
        .offcanvas-start {
            width: 280px;
            background: var(--sidebar-bg) !important;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1);
            border: none;
        }
        
        .offcanvas-header {
            background-color: var(--sidebar-header-bg);
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .offcanvas-title {
            font-weight: 700;
            font-size: 1.3rem;
            color: white;
            display: flex;
            align-items: center;
        }
        
        .offcanvas-title i {
            color: var(--primary-color);
            margin-right: 10px;
            font-size: 1.4rem;
        }
        
        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
            opacity: 0.7;
        }
        
        .btn-close:hover {
            opacity: 1;
        }
        
        .offcanvas-body {
            padding: 0;
            display: flex;
            flex-direction: column;
        }
        
        /* Profile section */
        .user-profile {
            padding: 1.5rem;
            text-align: center;
            background: linear-gradient(to bottom, var(--sidebar-header-bg), var(--sidebar-bg));
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .user-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 15px;
        }
        
        .user-name {
            color: white;
            font-weight: 600;
            margin-bottom: 0.2rem;
        }
        
        .user-role {
            color: #8c94a0;
            font-size: 0.85rem;
        }
        
        /* Navigation */
        .sidebar-nav {
            padding: 1rem 0;
            flex-grow: 1;
        }
        
        .nav-title {
            color: #8c94a0;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.8rem 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .nav-item {
            margin-bottom: 0.2rem;
            position: relative;
        }
        
        .nav-link {
            color: #c2c7d0;
            padding: 0.85rem 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            position: relative;
            font-weight: 500;
        }
        
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: var(--sidebar-hover);
        }
        
        .nav-link:hover::before, .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--primary-color);
            border-radius: 0 3px 3px 0;
        }
        
        .nav-link i {
            width: 24px;
            margin-right: 12px;
            font-size: 1.2rem;
        }
        
        .nav-link .bi-chevron-down {
            margin-left: auto;
            font-size: 0.9rem;
            transition: transform 0.3s;
        }
        
        .nav-link[aria-expanded="true"] .bi-chevron-down {
            transform: rotate(180deg);
        }
        
        .sub-menu {
            background-color: rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }
        
        .sub-menu .nav-link {
            padding-left: 3.7rem;
            font-size: 0.9rem;
            padding-top: 0.7rem;
            padding-bottom: 0.7rem;
        }
        
        /* Logout button */
        .logout-section {
            padding: 1.2rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.8rem;
            background: rgba(231, 74, 59, 0.15);
            color: #e74a3b;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background: rgba(231, 74, 59, 0.25);
            color: white;
        }
        
        .logout-btn i {
            margin-right: 8px;
        }
        
        /* Main content */
        .main-content {
            margin-top: 76px;
            padding: 2rem;
            transition: margin-left 0.3s;
        }
        
        @media (min-width: 992px) {
            .main-content {
                margin-left: 5px;
            }
        }
        
        /* Rest of the styles */
        .welcome-card {
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: none;
            background: white;
            margin-bottom: 1.5rem;
        }
        
        .stat-card {
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border: none;
            color: white;
            margin-bottom: 1.5rem;
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        }
        
        .stat-card-success {
            background: linear-gradient(45deg, var(--success-color), #17a673);
        }
        
        .stat-card-warning {
            background: linear-gradient(45deg, var(--warning-color), #e0a800);
        }
        
        .stat-card-danger {
            background: linear-gradient(45deg, var(--danger-color), #d52a1a);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.9;
        }
        
        .section-title {
            font-weight: 700;
            color: #4e73df;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #eaecf4;
        }
        
        .employee-table {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .employee-table thead {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .employee-table th {
            border: none;
            font-weight: 600;
            padding: 1rem 0.75rem;
        }
        
        .employee-table td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
        }
        
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        
        .bg-active {
            background-color: rgba(28, 200, 138, 0.2);
            color: #1cc88a;
        }
        
        .bg-onleave {
            background-color: rgba(246, 194, 62, 0.2);
            color: #f6c23e;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark px-3 fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Hamburger + Nom App -->
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-light me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
                    <i class="bi bi-list"></i>
                </button>
                <a class="navbar-brand fw-bold mb-0" href="#">
                    <i class="bi bi-people-fill me-2"></i>MEES
                </a>
            </div>

            <!-- Notifications + Profil -->
            <div class="d-flex align-items-center">
                <!-- Notifications -->
                <div class="dropdown me-3">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">Notifications</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">Notifications</h6></li>
                        <li><a class="dropdown-item" href="#">Nouvelle demande de congé</a></li>
                        <li><a class="dropdown-item" href="#">Anniversaire aujourd'hui: Marie Dupont</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center small" href="#">Voir toutes</a></li>
                    </ul>
                </div>

                <!-- Profil -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="rounded-circle me-2" width="32" height="32" alt="Profil">
                        <span class="d-none d-md-inline">
                            {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile_admins') }}"><i class="bi bi-person me-2"></i>Mon Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</button>
                        </form>

                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Offcanvas Sidebar amélioré -->
    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title"><i class="bi bi-people-fill"></i>MEES</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Profile Section -->
            <div class="user-profile">
                <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="User" class="user-img">
                <h6 class="user-name">
                    {{ auth()->user()->prenom }} {{ auth()->user()->nom }}
                </h6>
                <p class="user-role">
                    {{ auth()->user()->role }}
                </p>
            </div>
            
            <!-- Navigation Section -->
            <div class="sidebar-nav">
                <div class="nav-title">Navigation Principale</div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="bi bi-speedometer2"></i>
                            Tableau de bord
                        </a>
                    </li>
                    

                    <!-- Employés -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#employesMenu" role="button">
                            <i class="bi bi-people-fill"></i>
                            Employés
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse show sub-menu" id="employesMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('employes.create') }}">
                                        Ajouter Employé
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('employes.index') }}">
                                        Liste Employés
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </li>



                    

                    <!-- Departements -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#departementsMenu" role="button">
                            <i class="bi bi-building"></i>
                            Départements
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse sub-menu" id="departementsMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('departements.create') }}">
                                        Ajouter un département
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('departements.index') }}">
                                        Afficher la liste des départements
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <!-- Poste -->

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#posteMenu" role="button">
                            <i class="bi bi-briefcase-fill"></i>
                            Poste
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse sub-menu" id="posteMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Ajouter un poste
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Afficher liste des postes
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>



                    <!-- Contrat -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#contratMenu" role="button">
                            <i class="bi bi-file-earmark-text"></i>
                            Contrat
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse sub-menu" id="contratMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Ajouter un contrat
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Voir liste des contrats
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>



                    <!-- Document -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#documentMenu" role="button">
                            <i class="bi bi-file-earmark-text"></i>
                            Document
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse sub-menu" id="documentMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Ajouter un Document
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Afficher Liste des documents
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <!-- Pointage -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#pointageMenu" role="button">
                            <i class="bi bi-file-earmark-text"></i>
                           Pointage
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse sub-menu" id="pointageMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Nouvel pointage
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Historique des pointages
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>



                    <!-- Paiement -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#paiementMenu" role="button">
                            <i class="bi bi-cash"></i>
                            Paiement
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse sub-menu" id="paiementMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Effectuer un paiement   
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Afficher la liste des paiements
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    
                    <!-- Congés -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#congesMenu" role="button">
                            <i class="bi bi-calendar-event"></i>
                            Congés
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse sub-menu" id="congesMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Nouvelle Demande
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Gestion des Congés
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    

                    <!-- Evaluations -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#evaluationsMenu" role="button">
                            <i class="bi bi-star"></i>
                            Évaluations
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse sub-menu" id="evaluationsMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Nouvelle Évaluation
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Historique
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                
                <div class="nav-title mt-4">Autres</div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-graph-up"></i>
                            Rapports
                        </a>
                    </li>
                    
                    <!-- Gestion  Des Roles -->

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#rolesMenu" role="button">
                            <i class="bi bi-sliders"></i>
                            Paramètres
                            <i class="bi bi-chevron-down"></i>
                        </a>
                        <div class="collapse  sub-menu" id="rolesMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#rolesMenu1" aria-expanded="false" role="button">
                                        Gestion des rôles
                                        <i class="bi bi-chevron-down"></i>
                                    </a>
                                    

                                    <div class="collapse sub-menu" id="rolesMenu1">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('createroleform') }}">
                                                    Ajouter un rôle
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">
                                                    Assigner un rôle
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('listerolespermissions') }}">
                                                    Afficher les rôles
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#permissionsMenu" aria-expanded="false" role="button">
                                        Gestion des Permissions
                                        <i class="bi bi-chevron-down"></i>
                                    </a>
                                    <div class="collapse sub-menu" id="permissionsMenu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('createpermissionform') }}">
                                                    Ajouter une permission
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('assignpermissiontoroleform') }}">
                                                    Assigner une permission
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('listerolespermissions') }}">
                                                    Afficher les permissions
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                    </li>


                </ul>
            </div>
            
            <!-- Logout Section -->
            <div class="logout-section">
                {{-- <button class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </button> --}}
                <form action="{{ route('logout') }}" method="POST" class="d-inline-block w-100">
                    @csrf
                    <button type="submit" class="btn btn-link text-decoration-none logout-btn">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        <div class="container-fluid">

            <div class="container d-flex justify-content-between align-items-center mt-3">
                <h5 class="">
                    Bienvenue, <span class="text-primary">
                       {{ Auth::user()->prenom }} </span> !
                </h5>

                <span>
                    <i class="bi bi-person-circle fs-4"></i>
                </span>

                

            </div> 
            <hr>

            

            <!-- Carte de bienvenue -->

            <div class="container">
                @yield('content')

            </div>

        </div>
    </div>

    <div class="container-fluid footer bg-light text-dark mt-4 fixed-bottom">
        <div class="container">
            <p class="mb-0 py-3 text-center">&copy; {{ date('Y') }} MEES. Tous droits réservés.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialiser les tooltips Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        
        // Pour les écrans larges, on garde le sidebar toujours ouvert
        if (window.innerWidth >= 992) {
            var offcanvasElement = document.getElementById('offcanvasMenu');
            var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
            offcanvas.show();
        }
    </script>
</body>
</html>