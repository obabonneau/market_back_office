<!---------------------->
<!-- TITRE DE LA PAGE -->
<!---------------------->
<div class="d-flex align-items-center">
    <!-- TITRE -->
    <h1 class="flex-grow-1 text-center fs-3 fst-italic">Liste des utilisateurs</h1>

    <!-- BOUTON RETOUR -->
    <a class="btn btn-outline-secondary" href="index.php?controller=Utilisateur&action=menuAdmin"
        title="Retour en arrière">
        <i class="bi bi-x-lg"></i>
    </a>
</div>

<!--------------------->
<!-- CREER UN COMPTE -->
<!--------------------->
<div class="d-flex justify-content-center my-3">
    <a class="btn btn-secondary" href="index.php?controller=Utilisateur&action=formCreate">Créer un compte</a>
</div>

<!------------------------------>
<!-- TABLEAU DES UTILISATEURS -->
<!------------------------------>
<table class="table table-bordered table-hover text-center align-middle my-3">

    <!-- ENTÊTE DU TABLEAU -->
    <thead class="table-secondary">
        <tr>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Statut</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>

    <!-- CORPS DU TABLEAU -->
    <tbody>
        <?php foreach ($utilisateurs as $utilisateur) : ?>
            <tr>
                <td class="text-start ps-3"><?php echo htmlspecialchars($utilisateur->prenom, ENT_QUOTES, "UTF-8"); ?></td>
                <td class="text-start ps-3"><?php echo htmlspecialchars($utilisateur->nom, ENT_QUOTES, "UTF-8"); ?></td>
                <td class="text-start ps-3"><?php echo htmlspecialchars($utilisateur->email, ENT_QUOTES, "UTF-8"); ?></td>
                <td>
                    <span class="badge bg-secondary"><?php echo htmlspecialchars($utilisateur->statut, ENT_QUOTES, "UTF-8"); ?></span>
                </td>
                <td>
                    <a class="btn btn-sm btn-warning"href="index.php?controller=Utilisateur&action=formUpdate&id_utilisateur=<?php echo htmlspecialchars($utilisateur->id_utilisateur, ENT_QUOTES, "UTF-8"); ?>"
                        title="Modifier">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a class="btn btn-sm btn-danger" href="index.php?controller=Utilisateur&action=delete&id_utilisateur=<?php echo htmlspecialchars($utilisateur->id_utilisateur, ENT_QUOTES, "UTF-8"); ?>&token=<?php echo $_SESSION["token"]["id"]; ?>"
                        title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>