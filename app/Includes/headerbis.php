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


    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/style2.css">


    <!-- SCRIPTS GENERALS -->
    <script src="../public/js/main.js" defer></script>
    <script src="../public/js/user/logout.js" defer></script>  
</head>

<body>

    <div class="container-fluid">

        <header>

            <!-- TOPBAR DE NAVIGATION -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar fi shadow">

                <!-- BOUTON DE BASCULEMENT DE LA SIDEBAR -->
                <div class="text-center d-none d-md-inline">
                    <button class="btn btn-secondary btn-sm rounded-circle border-0" id="sidebarBtn">
                        <i class="bi bi-caret-left-fill"></i>
                    </button>
                </div>

                <!-- ZONE DE RECHERCHE -->
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

                <!-- NAVIGATION -->
                <ul class="navbar-nav ml-auto">

                    <!-- MENU ALERTS -->
                    <li class="nav-item dropdown no-arrow mx-1">

                        <!-- DROPDOWN BOUTON -->
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        
                        <!-- DROPDOWN LISTE -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
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

                    <!-- SEPARATION -->
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- MENU UTILISATEURS -->
                    <li class="nav-item dropdown no-arrow">

                        <!-- DROPDOWN BOUTON -->
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($_SESSION["user"]["username"], ENT_QUOTES, "UTF-8"); ?></span>
                            <img class="img-profile rounded-circle" src="../public/img/user/undraw_profile.svg">
                        </a>

                        <!-- DROPDOWN LISTE -->
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
        </header>



    </div>
</body