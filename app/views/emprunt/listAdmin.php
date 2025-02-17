<!---------------------->
<!-- TITRE DE LA PAGE -->
<!---------------------->
<div class="d-flex align-items-center">
    <!-- TITRE -->
    <h1 class="flex-grow-1 text-center fs-3 fst-italic">Liste des emprunts</h1>

    <!-- BOUTON RETOUR -->
    <a class="btn btn-outline-secondary" href="index.php?controller=Utilisateur&action=menuAdmin"
        title="Retour en arrière">
        <i class="bi bi-x-lg"></i>
    </a>
</div>

<!---------------------->
<!-- CREER UN EMPRUNT -->
<!---------------------->
<div class="d-flex justify-content-center my-3">
    <a class="btn btn-secondary" href="index.php?controller=Emprunt&action=formCreate">Créer un emprunt</a>
</div>

<!-------------------------->
<!-- TABLEAU DES EMPRUNTS -->
<!-------------------------->
<table class="table table-bordered table-hover text-center align-middle my-3">

    <!-- ENTÊTE DU TABLEAU -->
    <thead class="table-secondary">
        <tr>
            <th scope="col">Utilisateur</th>
            <th scope="col">Livre</th>
            <th scope="col">Début</th>
            <th scope="col">Fin</th>
            <th scope="col">Statut</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>

    <!-- CORPS DU TABLEAU -->
    <tbody>
        <?php foreach ($emprunts as $emprunt) : ?>
            <tr <?php if (!$emprunt->fin && strtotime($emprunt->debut . " +3week") < time()) { echo "class='table-danger'";} ?>>
                <td class="text-start ps-3"><?php echo htmlspecialchars("$emprunt->prenom $emprunt->nom", ENT_QUOTES, "UTF-8"); ?></td>
                <td class="text-start ps-3"><?php echo htmlspecialchars($emprunt->titre, ENT_QUOTES, "UTF-8"); ?></td>
                <td><?php echo htmlspecialchars(date("d/m/Y", strtotime($emprunt->debut)), ENT_QUOTES, "UTF-8"); ?></td>
                <td>
                    <?php if ($emprunt->fin == null) : ?>
                        ...
                    <?php else :
                        echo htmlspecialchars(date("d/m/Y", strtotime($emprunt->fin)), ENT_QUOTES, "UTF-8"); ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($emprunt->fin != null) : ?>
                        <span class="badge bg-success">Restitué</Span>
                    <?php else : ?>
                        <a class="badge bg-warning text-dark text-decoration-none" href="index.php?controller=Emprunt&action=return&id_emprunt=<?php echo htmlspecialchars($emprunt->id_emprunt, ENT_QUOTES, 'UTF-8'); ?>&token=<?php echo $_SESSION["token"]["id"]; ?>">Restituer ici</a>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($emprunt->fin != null) : ?>
                    <a class="btn btn-sm btn-warning" href="index.php?controller=Emprunt&action=formUpdate&id_emprunt=<?php echo htmlspecialchars($emprunt->id_emprunt, ENT_QUOTES, "UTF-8"); ?>"
                        title="Modifier">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <?php else : ?>
                        <a class="btn btn-sm btn-danger" href="index.php?controller=Emprunt&action=delete&id_emprunt=<?php echo htmlspecialchars($emprunt->id_emprunt, ENT_QUOTES, "UTF-8"); ?>&token=<?php echo $_SESSION["token"]["id"]; ?>"
                            title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet emprunt ?');">
                            <i class="bi bi-trash"></i>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>