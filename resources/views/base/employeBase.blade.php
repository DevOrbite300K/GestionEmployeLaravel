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
</head>
<body>
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Espace Employé</h3>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="#" class="active">
                    <i class="bi bi-speedometer2"></i> Tableau de bord
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-person-circle"></i> Mon profil
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-clock-history"></i> Pointages
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-calendar-event"></i> Congés & Absences
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-file-text"></i> Documents
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-cash-coin"></i> Paie & Relevés
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-chat-left-text"></i> Messagerie
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-gear"></i> Paramètres
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </a>
            </li>
        </ul>
    </nav>

    <!-- Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar topbar rounded-3">
            <div class="container-fluid">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Rechercher..." aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
                
                <ul class="navbar-nav ms-auto flex-row">
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-envelope fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                5
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://via.placeholder.com/40" width="40" height="40" class="rounded-circle me-2">
                            <span>Marie Dupont</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="bi bi-download text-white-50 me-1"></i> Exporter rapport
            </a>
        </div>

        @yield('content')
        
        <!-- Footer -->
        <footer class="sticky-footer bg-white mt-5 fixed-bottom">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>© {{ now('Y') }} Tableau de bord Employé. Tous droits réservés.</span>
                </div>
            </div>
        </footer>
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
</body>
</html>