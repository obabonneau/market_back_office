<!---------------------->
<!-- TITRE DE LA PAGE -->
<!---------------------->
<div class="d-flex align-items-center">

    <!-- TITRE -->
    <h1 class="flex-grow-1 text-center fs-2 fst-italic">Mes emprunts</h1>

    <!-- BOUTON RETOUR -->
    <a class="btn btn-outline-secondary" href="index.php?controller=Livre&action=list" title="Retour en arrière">
        <i class="bi bi-x-lg"></i>
    </a>
</div>

<!------------------>
<!-- LES EMPRUNTS -->
<!------------------>
<div class="accordion accordion-flush my-3" id="accordionFlush">
    <?php foreach ($emprunts as $emprunt) : ?>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?php echo htmlspecialchars($emprunt->id_emprunt)?>" aria-expanded="false" aria-controls="flush-collapseOne">
                    
                    <!-- TITRE DU LIVRE -->
                     <span class="flex-grow-1">
                        <?php echo htmlspecialchars($emprunt->titre); ?>
                    </span>

                    <?php if (!$emprunt->fin && strtotime($emprunt->debut . " +3 weeks") >= time()) : ?>

                        <!-- BADGE EMPRUNT EN COURS -->
                        <span class="badge bg-warning text-dark me-3">Emprunt en cours à restituer avant le
                            <?php echo htmlspecialchars(date("d/m/Y", strtotime($emprunt->debut . " +3week"))); ?>
                        </span>
                    <?php elseif (!$emprunt->fin && strtotime($emprunt->debut . " +3week") < time()) : ?>

                        <!-- BADGE EMPRUNT DEPASSE -->
                        <span class="badge bg-danger me-3">Attention vous avez dépassé les 3 semaines, merci de restituer votre livre !</span>
                    <?php else : ?>

                        <!-- BADGE EMPRUNT RESTITUE -->
                        <span class="badge bg-success me-3">Restitué</span>
                    <?php endif ?>
                </button>
            </h2>
            <div id="flush-collapse-<?php echo htmlspecialchars($emprunt->id_emprunt)?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlush">
                <div class="accordion-body">
                    <p class="mb-0"><strong>Auteur : </strong><?php echo htmlspecialchars($emprunt->auteur); ?></p>
                    <p class="mb-0"><strong>Genre : </strong><?php echo htmlspecialchars($emprunt->genre); ?></p>
                    <p class="mb-2"><strong>Année : </strong><?php echo $emprunt->annee; ?></p>
                    <p class="mb-0"><strong>Réservé du </strong><?php echo htmlspecialchars(date("d/m/Y", strtotime($emprunt->debut))); ?>
                    <?php if($emprunt->fin) : ?>
                        <strong>au </strong><?php echo htmlspecialchars(date("d/m/Y", strtotime($emprunt->fin))); ?>
                    <?php endif ?>
                    </p>             
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>