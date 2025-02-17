<!---------------------->
<!-- TITRE DE LA PAGE -->
<!---------------------->
<h1 class="text-center fs-2 fst-italic">Nos livres</h1>

<!---------------------------->
<!-- TABLEAU DES EVENEMENTS -->
<!---------------------------->
<?php if (isset($livres)) : ?>
    <div class="d-flex flex-wrap justify-content-center my-3">
        <!-- ALIMENTATION DE CARD D'EVENEMENTS -->
        <?php foreach ($livres as $livre): ?>
            <div class="card m-2" style="width: 240px;">
                <img class="card-img-top" src="images/livres/livre.jpg" alt="Card image">
                <div class="card-body">
                    <h5 class="text-center">
                        <span class="card-title badge <?php echo ($livre->statut == 0) ? "bg-success" : "bg-warning"; ?>">
                            <?php echo htmlspecialchars($livre->titre, ENT_QUOTES, "UTF-8"); ?>
                        </span>
                    </h5>
                    <p class="card-text m-0 text-truncate"><strong>Auteur : </strong><?php echo htmlspecialchars($livre->auteur, ENT_QUOTES, "UTF-8"); ?></p>
                    <p class="card-text m-0"><strong>Genre : </strong><?php echo htmlspecialchars($livre->genre, ENT_QUOTES, "UTF-8"); ?></p>
                    <p class="card-text"><strong>Année : </strong><?php echo $livre->annee; ?></p>
                    <a class="btn btn-secondary d-grid" href="index.php?controller=Livre&action=view&id_livre=<?php echo htmlspecialchars($livre->id_livre, ENT_QUOTES, "UTF-8"); ?>">Voir le livre</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>