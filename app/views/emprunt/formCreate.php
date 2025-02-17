<!---------------------->
<!-- TITRE DE LA PAGE -->
<!---------------------->
<div class="d-flex align-items-center">

    <!-- TITRE -->
    <h1 class="flex-grow-1 text-center fs-3 fst-italic">Créer un emprunt</h1>

    <!-- BOUTON RETOUR -->
    <a class="btn btn-outline-secondary" href="index.php?controller=Emprunt&action=listAdmin"
        title="Retour en arrière">
        <i class="bi bi-x-lg"></i>
    </a>
</div>

<!---------------->
<!-- FORMULAIRE -->
<!---------------->
<div class="card w-50 mx-auto my-3">
    <div class="card-body">
        <form method="post" action="index.php?controller=Emprunt&action=create">

            <!-- TOKEN CSRF -->
            <input type="hidden" name="token" value="<?php echo $_SESSION["token"]["id"]; ?>">

            <!-- CHAMP TITRE -->
            <div class="mb-3">
                    <label for="id_livre" class="form-label">Titre</label>
                    <select id="id_livre" class="form-select form-select-sm" name="id_livre">
                        <?php foreach ($livres as $livre) : ?>
                            <option value="<?php echo htmlspecialchars($livre->id_livre, ENT_QUOTES, "UTF-8"); ?>">
                                <?php echo htmlspecialchars($livre->titre, ENT_QUOTES, "UTF-8"); ?>
                            </option>;
                        <?php endforeach; ?>
                    </select>
            </div>

            <!-- CHAMP UTILISATEUR -->
            <div class="mb-3">
                    <label for="id_utilisateur" class="form-label">Utilisateur</label>
                    <select id="id_utilisateur" class="form-select form-select-sm" name="id_utilisateur">
                        <?php foreach ($utilisateurs as $utilisateur) : ?>
                            <option value="<?php echo htmlspecialchars($utilisateur->id_utilisateur, ENT_QUOTES, "UTF-8"); ?>">
                                <?php echo htmlspecialchars("$utilisateur->prenom $utilisateur->nom", ENT_QUOTES, "UTF-8"); ?>
                        <?php endforeach; ?>
                    </select>
            </div>

            <!-- BOUTON D'ENVOI -->
            <div class="d-flex justify-content-center">
                <button class="btn btn-secondary" type="submit">Valider</button>
            </div>
        </form>
    </div>
</div>