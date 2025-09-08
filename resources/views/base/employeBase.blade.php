<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title', 'Dashboard Employé')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4e73df;
            --primary-dark: #224abe;
            --secondary: #6f42c1;
            --light: #f8f9fc;
            --dark: #5a5c69;
            --success: #1cc88a;
            --danger: #e74a3b;
            --warning: #f6c23e;
            --info: #36b9cc;
        }
        
        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Sidebar */
        #sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, var(--primary), var(--primary-dark));
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto; /* permet le scroll vertical si le contenu dépasse */
            -webkit-overflow-scrolling: touch; /* pour un scroll fluide sur mobile */
        }

        
        
        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.1);
        }
        
        #sidebar ul.components {
            padding: 20px 0;
        }
        
        #sidebar ul li a {
            padding: 15px 30px;
            display: block;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        #sidebar ul li a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }
        
        #sidebar ul li a.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
        }
        
        #sidebar ul li a i {
            margin-right: 10px;
        }
        
        /* Content */
        #content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        
        /* Navbar */
        .topbar {
            height: 70px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            background: white;
            margin-bottom: 20px;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 0.35rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .stats-card {
            border-left: 4px solid;
        }
        
        .stats-card.documents {
            border-left-color: var(--info);
        }
        
        .stats-card.contracts {
            border-left-color: var(--warning);
        }
        
        .stats-card.pointages {
            border-left-color: var(--success);
        }
        
        .stats-card.conges {
            border-left-color: var(--danger);
        }
        
        .stats-card h6 {
            color: var(--dark);
            font-size: 0.9rem;
            text-transform: uppercase;
            font-weight: 700;
        }
        
        .stats-card .card-text {
            color: var(--primary);
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        /* Profile card */
        .profile-card {
            border-radius: 15px;
            overflow: hidden;
        }
        
        .profile-photo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid #fff;
            margin-top: -60px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .status-badge {
            padding: 0.4em 0.8em;
            border-radius: 0.4rem;
            font-size: 0.85rem;
        }
        
        .status-active { background-color: var(--success); color: #fff; }
        .status-inactive { background-color: var(--danger); color: #fff; }
        
        .card-header {
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            color: #fff;
            font-weight: bold;
            padding: 1.2rem 1.35rem;
        }
        
        .list-group-item {
            border: none;
            padding: 0.75rem 1.25rem;
            border-left: 3px solid transparent;
            transition: all 0.2s ease;
        }
        
        .list-group-item:hover {
            background-color: var(--light);
            border-left: 3px solid var(--primary);
        }
        
        /* Buttons */
        .btn {
            border-radius: 0.35rem;
            font-weight: 600;
            padding: 0.6rem 1rem;
            transition: all 0.2s ease;
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
        }
        
        .btn-danger {
            background: linear-gradient(to right, var(--danger), #c0352a);
            border: none;
        }
        
        /* Table */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        
        .table th {
            background-color: var(--light);
            color: var(--dark);
            font-weight: 700;
            padding: 0.75rem;
            border-top: 1px solid #e3e6f0;
        }
        
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-top: 1px solid #e3e6f0;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }
        
        /* Charts */
        .chart-container {
            position: relative;
            height: 250px;
        }
        
        /* Toggle button */
        #sidebarCollapse {
            position: fixed;
            left: 260px;
            top: 20px;
            z-index: 1001;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }
            
            #sidebar.active {
                margin-left: 0;
            }
            
            #content {
                margin-left: 0;
            }
            
            #sidebarCollapse {
                left: 20px;
            }
            
            #content.active {
                margin-left: 250px;
            }
        }
    </style>
    <style>
/* Spinner visibility / transition */
#spinner {
  display: none; /* initialement caché */
  opacity: 1;
  transition: opacity 1.75s ease, visibility 2.45s ease;
}
#spinner.visible {
  display: flex !important; /* respecte d-flex layout */
  opacity: 1;
  visibility: visible;
}
#spinner.hidden {
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
}


/* Après la transition on forcera display:none via JS */
</style>
</head>
<body>

<!-- ajout du spinner centrer avec un fade -->
<div id="spinner" class="d-flex justify-content-center align-items-center" 
     style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.85); z-index: 2000;">
  <div class="spinner text-primary" role="status" style="width: 3rem; height: 3rem;">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

<!-- Sidebar -->
<nav id="sidebar" class="mb-4" style="display: none;">
    <div class="sidebar-header">
        <h4>Espace Employé</h4>
    </div>

    <ul class="list-unstyled components">
        <!-- Tableau de bord -->
        <li>
            <a href="{{ route('employe.bienvenue') }}" class="active">
                <i class="bi bi-speedometer2"></i> Tableau de bord
            </a>
        </li>

        <!-- Profil -->
        <li>
            <a class="d-flex align-items-center justify-content-between text-white text-decoration-none" data-bs-toggle="collapse" href="#profilCollapse" role="button" aria-expanded="false" aria-controls="profilCollapse">
                <span><i class="bi bi-person-circle me-2"></i> Mon profil</span>
                <i class="bi bi-chevron-down"></i>
            </a>

            <div class="collapse" id="profilCollapse">
                <ul class="list-unstyled ps-4">
                    <li><a href="{{ route('employe.profile') }}">Voir profil</a></li>
                    <li><a href="{{ route('employe.profile.modifier.get') }}">Modifier profil</a></li>
                </ul>
            </div>
        </li>

        <!-- Pointages -->
        <li>
            <a class="d-flex align-items-center justify-content-between text-white text-decoration-none" data-bs-toggle="collapse" href="#pointagesCollapse" role="button" aria-expanded="false" aria-controls="pointagesCollapse">
                <span><i class="bi bi-clock-history me-2"></i> Pointages</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="pointagesCollapse">
                <ul class="list-unstyled ps-4">
                    <li><a href="{{ route('employe.pointage') }}">Pointer</a></li>
                    <li><a href="{{ route('employe.pointages') }}">Voir tout</a></li>
                </ul>
            </div>
        </li>

        <!-- Congés & Absences -->
        <li>
            <a class="d-flex align-items-center justify-content-between text-white text-decoration-none" data-bs-toggle="collapse" href="#congesCollapse" role="button" aria-expanded="false" aria-controls="congesCollapse">
                <span><i class="bi bi-calendar-event me-2"></i> Congés & Absences</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="congesCollapse">
                <ul class="list-unstyled ps-4">
                    <li><a href="{{ route('employe.mesconges') }}">Mes congés</a></li>
                    <li><a href="{{ route('employe.demandeconge.get') }}">demander un congés</a></li>
                </ul>
            </div>
        </li>

        <!-- Documents -->
        <li>
            <a class="d-flex align-items-center justify-content-between text-white text-decoration-none" data-bs-toggle="collapse" href="#documentsCollapse" role="button" aria-expanded="false" aria-controls="documentsCollapse">
                <span><i class="bi bi-file-text me-2"></i> Documents</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="documentsCollapse">
                <ul class="list-unstyled ps-4">
                    <li><a href="{{ route('employe.documents') }}">Mes documents</a></li>
                    <li><a href="{{ route('employe.documents.upload') }}">Ajouter un document</a></li>
                </ul>
            </div>
        </li>


        <!-- Contrats -->

        <li>
            <a class="d-flex align-items-center justify-content-between text-white text-decoration-none" data-bs-toggle="collapse" href="#contratCollapse" role="button" aria-expanded="false" aria-controls="documentsCollapse">
                <span><i class="bi bi-file-text me-2"></i> Contrat/Poste</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="contratCollapse">
                <ul class="list-unstyled ps-4">
                    <li><a href="{{ route('employe.contrats') }}">Voir mes contrats</a></li>
                    <li><a href="{{ route('employe.monposte') }}">info de mon poste</a></li>
                </ul>
            </div>
        </li>


        <!-- Paie & Relevés -->
        <li>
            <a class="d-flex align-items-center justify-content-between text-white text-decoration-none" data-bs-toggle="collapse" href="#paieCollapse" role="button" aria-expanded="false" aria-controls="paieCollapse">
                <span><i class="bi bi-cash-coin me-2"></i> Paie & Relevés</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="paieCollapse">
                <ul class="list-unstyled ps-4">
                    <li><a href="{{ route('employe.mespaiements') }}">Historique paiements</a></li>
                    <li><a href="#">Relevés</a></li>
                </ul>
            </div>
        </li>
        <hr >
        <!-- Paramètres -->
        <li>
            <a href="{{ route('employe.changerMotDePasse.get') }}" class="d-flex align-items-center">
                <i class="bi bi-gear me-2"></i> Paramètres
            </a>
        </li>

        <!-- Déconnexion -->
        <li class="mb-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link text-white text-decoration-none w-100 text-start">
                    <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                </button>
            </form>
        </li>
        
    </ul>
</nav>



    <!-- Content -->
    <div id="content" style="display: none;">
        <!-- Topbar -->
        <nav class="navbar topbar rounded-3">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Tableau de bord</span>
                <div class="d-flex align-items-center">
                    <span class="me-3 d-none d-lg-inline text-gray-600 small">
                        <i class="bi bi-person-circle"></i> 
                        {{ Auth::user()->getRoleNames()->first() ?? 'Aucun rôle' }}
                    </span>
                </div>
            </div>
        </nav>


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h3 class="h4 mb-0 text-gray-800">Bienvenue, 
                <span class="fw-bold  ">{{ Auth::user()->prenom }}</span> > <span class="fw-bold  ">{{ Auth::user()->nom }}</span>
            </h3>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="bi bi-download me-1"></i> Générer un rapport
            </a> --}}
        </div>
        <hr>



        @yield('content')
        
        
    </div>

    <!-- Toggle Button -->
    <button type="button" id="sidebarCollapse" class="btn">
        <i class="bi bi-list"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar toggle functionality
            document.getElementById('sidebarCollapse').addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('active');
                document.getElementById('content').classList.toggle('active');
            });
            
            // Simulate chart data (in a real app, you would use a charting library)
            console.log("Dashboard loaded successfully!");
        });
    </script>

    <!-- Script pour le spinner genre le spinner apparait pendant 5 secondes avant de charger le sidebar et le content -->
    <script>
(function(){
  // éléments
  var spinner = document.getElementById('spinner');
  var sidebar = document.getElementById('sidebar');
  var content = document.getElementById('content');

  if (!spinner) {
    console.error('[SPINNER] élément #spinner introuvable');
    return;
  }

  // affichage initial: on utilise une classe pour ne pas écraser d-flex
  spinner.classList.add('visible');
  console.log('[SPINNER] affiché, computed display =', window.getComputedStyle(spinner).display);

  // fonction générique pour cacher le spinner
  var hidden = false;
  function hideSpinner(reason) {
    if (hidden) return;
    hidden = true;
    console.log('[SPINNER] hideSpinner appelé — raison:', reason);

    // ajout de la classe hidden (transition d'opacité)
    spinner.classList.add('hidden');
    spinner.classList.remove('visible');

    // après la transition, forcer display none pour retirer de la page
    setTimeout(function(){
      try { spinner.style.display = 'none'; } catch(e){ /* ignore */ }
      console.log('[SPINNER] display forcé à none après transition');
    }, 5000); // doit couvrir la durée de transition CSS

    // afficher le contenu si présent
    if (sidebar) sidebar.style.display = 'block';
    if (content) content.style.display = 'block';
  }

  // 1) cacher quand la page a fini de charger (images + tout)
  window.addEventListener('load', function(){ hideSpinner('window.load'); });

  // 2) fallback: cacher après 5s si load n'arrive pas (évite spinner bloqué)
  setTimeout(function(){ hideSpinner('fallback 5000ms'); }, 5000);

  // (optionnel) exposer commande manuelle dans la console
  window.__hideMyAppSpinner = function(){ hideSpinner('manual call'); };
})();
</script>

</body>
</html>