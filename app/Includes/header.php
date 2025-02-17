<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <title>Ma bibliothèque</title>

    <!-- CSS Bootstrap -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <link rel="stylesheet" href="../public/icons/bootstrap-icons.min.css">

    <!-- CSS perso -->
    <link rel="stylesheet" href="../public/css/style.css">

    <!-- JS Bootstrap -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script> -->
    <script src="../public/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <!-- <script src="https://kit.fontawesome.com/c245ee9b98.js" crossorigin="anonymous"></script> -->
</head>

<body>
    <header class="border-bottom">
        <!-- BARRE DE NAVIGATION -->
        <nav class="navbar navbar-expand-md navbar-dark bg-secondary py-3">
            <div class="container">

                <!-- LOGO -->
                <a class="navbar-brand fs-2 fw-bold" href="index.php">
                    <img src="images/logo.png" alt="Logo" width="50" height="50">
                    MA BIBLIOTHEQUE
                </a>

                <!-- MODE CLAIR/OMBRE -->
                <i id="btnModeDark" class="bi bi-lightbulb-fill text-warning ps-4" style="cursor: pointer;"></i>

                <!-- MENU -->
                <div id="navbarNav" class="collapse navbar-collapse justify-content-center">
                    <ul class="navbar-nav fs-5 fw-bold">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=Livre&action=list">Livres</a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION["user"]["id_utilisateur"])) : ?>
                                <a class="nav-link" href="index.php?controller=Emprunt&action=list&id_utilisateur=<?php echo htmlspecialchars($_SESSION["user"]["id_utilisateur"], ENT_QUOTES, "UTF-8"); ?>">Mes emprunts</a>
                            <?php else: ?>
                                <a class="nav-link" href="index.php?controller=Utilisateur&action=formLogon">Mes emprunts</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>

                <!-- CHAMP DE RECHERCHE -->
                <form class="d-flex me-5" method="post" action="index.php?controller=Livre&action=search">
                    <input class="form-control me-1" type="text" name="search" placeholder="Rechercher un livre" aria-label="Search">
                    <button class="btn btn-light" type="submit"><span class="bi bi-search"></span></button>
                </form>

                <!-- BOUTON DE CONNEXION OU MENU UTILISATEUR -->
                <?php if (!isset($_SESSION["user"]["id_utilisateur"])) : ?>

                    <!-- BOUTON DE CONNEXION -->
                    <a class="btn btn-light py-2 px-5" href="index.php?controller=Utilisateur&action=formLogon">Se connecter</a>

                <?php else : ?>

                    <!-- MENU UTILISATEUR -->
                    <div class="dropdown">

                        <!-- BOUTON UTILISATEUR -->
                        <button id="dropdownMenuButton" class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo htmlspecialchars($_SESSION["user"]["username"], ENT_QUOTES, "UTF-8"); ?>
                        </button>

                        <!-- MENU DEROULANT UTILISATEUR -->
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="index.php?controller=Utilisateur&action=formUpdate&id_utilisateur=<?php echo htmlspecialchars($_SESSION["user"]["id_utilisateur"], ENT_QUOTES, "UTF-8"); ?>">Mon profil</a>
                            </li>
                            <?php if ($_SESSION["user"]["statut"] == "admin") : ?>
                                <li>
                                    <a class="dropdown-item" href="index.php?controller=Utilisateur&action=menuAdmin">Administration</a>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a class="dropdown-item" href="index.php?controller=Utilisateur&action=logout">Se déconnecter</a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- BOUTON RESPONSIVE -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>

    <main class="bg-light py-3">
        <div class="container">
            
            <!------------------------------------->
            <!-- POSSIBLE MESSAGE D'INFORMATIONS -->
            <!------------------------------------->
            <?php if ($_GET["msgOK"] ?? null) : ?>
                <div id="message" class="alert alert-success py-2" role="alert">
                    <p class="mb-0"><?php echo htmlspecialchars($_GET["msgOK"], ENT_QUOTES, "UTF-8"); ?></p>
                </div>
            <?php endif;
            if ($_GET["msgKO"] ?? null) : ?>
                <div id="message" class="alert alert-danger py-2" role="alert">
                    <p class="mb-0"><?php echo htmlspecialchars($_GET["msgKO"], ENT_QUOTES, "UTF-8"); ?></p>
                </div>
            <?php endif; ?>

            <!-- <script>
                // Cacher le message après 5 secondes
                setTimeout(() => {
                    const message = document.getElementById("message");
                    if (message) {
                        message.style.display = "none";
                    }
                }, 5000);
            </script> -->