<!---------------------->
<!-- TITRE DE LA PAGE -->
<!---------------------->
<div class="d-flex align-items-center">

    <!-- TITRE -->
    <h1 class="flex-grow-1 text-center fs-2 fst-italic">Détails sur le livre</h1>

    <!-- BOUTON RETOUR -->
    <a class="btn btn-outline-secondary" href="index.php?controller=Livre&action=list" title="Retour en arrière">
        <i class="bi bi-x-lg"></i>
    </a>
</div>

<!---------------->
<!-- LE LIVRE -->
<!---------------->
<div class="row align-items-center my-3">

    <!-- IMAGE -->
    <div class="col-3">
        <img class="img-fluid rounded-3" src="images/livres/livre.jpg" alt="Image du livre">
    </div>

    <!-- DESCRIPTION -->
    <div class="offset-1 col-8">
        <div class="card border-0">
            <div class="card-body">
                <h2 class="card-title"><?php echo htmlspecialchars($livre->titre, ENT_QUOTES, "UTF-8"); ?></h2>
                <p class="card-text m-0"><strong>Auteur : </strong><?php echo htmlspecialchars($livre->auteur, ENT_QUOTES, "UTF-8"); ?></p>
                <p class="card-text m-0"><strong>Genre : </strong><?php echo htmlspecialchars($livre->genre, ENT_QUOTES, "UTF-8"); ?></p>
                <p class="card-text"><strong>Année : </strong><?php echo $livre->annee; ?></p>

                <!-- BOUTONS UTILISATEURS -->
                <?php if (isset($_SESSION["user"]["id_utilisateur"])) : ?>
                    <?php if ($livre->statut != 0) : ?>
                        
                        <!-- BADGE NON DISPONIBLE -->
                        <span class="badge bg-warning fs-5">Non disponible</span>
                    <?php else : ?>

                        <!-- BOUTON DE RESERVATION -->
                        <a class="btn btn-success" href="index.php?controller=Emprunt&action=userCreate&id_livre=<?php echo htmlspecialchars($livre->id_livre, ENT_QUOTES, "UTF-8"); ?>&token=<?php echo $_SESSION["token"]["id"]; ?>">
                            Réserver le livre
                        </a>
                    <?php endif; ?>
                <?php else : ?>

                    <!-- BOUTON DE CONNEXION -->
                    <a class="btn btn-secondary" href="index.php?controller=Utilisateur&action=formLogon"> Se connecter pour réserver</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>