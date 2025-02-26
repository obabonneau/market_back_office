<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BACK OFFICE - <?php echo htmlspecialchars($title, ENT_QUOTES, "UTF-8"); ?></title>
    
    <!--FAVICON -->
    <link rel="icon" type="image/png" href="../public/img/favicon.png">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">

    <!-- ICONS Bootstrap -->
    <link rel="stylesheet" href="../public/icons/bootstrap-icons.min.css">

    <!-- JS Bootstrap -->
    <script src="../public/js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- ADMIN -->
    <!-- <link href="../public/icons/fontawesome/all.min.css" rel="stylesheet" type="text/css"> -->
    <script src="https://kit.fontawesome.com/c245ee9b98.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/style2.css">
    <!-- ADMIN -->


    <!-- SCRIPTS GENERALS -->
    <script src="../public/js/main.js" defer></script>
    <script src="../public/js/user/logout.js" defer></script>  
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-clipboard-data"></i>
                </div>
                <div class="sidebar-brand-text mx-3">BACK OFFICE</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php" title="Tableau de bord">
                    <i id="sidebarLogo" class="bi bi-speedometer2"></i>
                    <span id="sidebarLabel">Tableau de bord</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <span class="text-light">ADMIN</span>
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=Admin&action=listUser" title="Liste des utilisateurs">
                    <i id="sidebarLogo" class="bi bi-people"></i>
                    <span id="sidebarLabel">Utilisateurs</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <span class="text-light">GENERAL</span>
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=Produit&action=list" title="Liste des produits">
                    <i id="sidebarLogo" class="bi bi-laptop"></i>
                    <span id="sidebarLabel">Produits</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i id="sidebarLogo" class="fas fa-fw fa-table"></i>
                    <span id="sidebarLabel">Categories</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <span class="text-light">COMMANDE</span>
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i id="sidebarLogo" class="fas fa-fw fa-table"></i>
                    <span id="sidebarLabel">Nouvelles</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i id="sidebarLogo" class="fas fa-clock"></i>
                    <span id="sidebarLabel">En cours</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i id="sidebarLogo" class="fas fa-clock"></i>
                    <span id="sidebarLabel">Historique</span>
                </a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <div class="text-center d-none d-md-inline">
                    <button class="btn btn-secondary btn-sm rounded-circle border-0" id="sidebarBtn">
                        <i class="bi bi-caret-left-fill"></i> <!-- Icône de la sidebar -->
                    </button>
                </div>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Rechercher..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($_SESSION["user"]["username"], ENT_QUOTES, "UTF-8"); ?></span>
                                <img class="img-profile rounded-circle" src="../public/img/user/undraw_profile.svg">
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalLogout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <main class="container-fluid">

                