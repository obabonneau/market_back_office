<!---------------------->
<!-- TITRE DE LA PAGE -->
<!---------------------->
<div class="d-flex align-items-center">

    <!-- TITRE -->
    <h1 class="flex-grow-1 text-center fs-3 fst-italic">Créer un compte utilisateur</h1>

    <!-- BOUTON RETOUR -->
    <?php if (($_SESSION["user"]["statut"] ?? null) == "admin") : ?>
        <a class="btn btn-outline-secondary" href="index.php?controller=Utilisateur&action=listAdmin"
            title="Retour en arrière">
            <i class="bi bi-x-lg"></i>
        </a>
    <?php else : ?>
        <a class="btn btn-outline-secondary" href="index.php?controller=Utilisateur&action=formLogon"
            title="Retour en arrière">
            <i class="bi bi-x-lg"></i>
        </a>
    <?php endif; ?>
</div>

<!---------------->
<!-- FORMULAIRE -->
<!---------------->
<div class="card w-50 mx-auto my-3">
    <div class="card-body">
        <form method="post" action="index.php?controller=Utilisateur&action=create">

            <!-- TOKEN CSRF -->
            <input type="hidden" name="token" value="<?php echo $_SESSION["token"]["id"]; ?>">

            <!-- CHAMP PRENOM -->
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input id="prenom" class="form-control form-control-sm" type="text" name="prenom" placeholder="Entrez votre prénom">
            </div>

            <!-- CHAMP NOM -->
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input id="nom" class="form-control form-control-sm" type="text" name="nom" placeholder="Entrez votre nom">
            </div>

            <!-- CHAMP EMAIL -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control form-control-sm" type="email" name="email" placeholder="Entrez votre email">
            </div>

            <!-- CHAMP MDP -->
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input id="password" class="form-control form-control-sm" type="password" name="password" placeholder="Entrez votre mot de passe">
            </div>

            <!-- ZONE DE CONTROLE DU MDP -->
            <div class="w-100" id="menuCheck" style="display: none;">

                <!-- AFFICHAGE DU MDP -->
                <div class="form-check">
                    <input class="form-check-input" id="showPassword" type="checkbox">
                    <label class="form-check-label fs-6 text-muted" for="showPassword">Afficher le mot de passe</label>
                </div>

                <!-- BARRE DE PROGRESSION -->
                <div class="progress mx-3 my-3" style="height: 0.5em;">
                    <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>

                <!-- LISTE DES CRITERES -->
                <ul class="list-group">
                    <li class="list-group-item border-0 py-0">
                        <i id="length" class="bi bi-x-circle-fill text-danger"></i>
                        <span class="text-muted">8 caractères minimum</span>
                    </li>
                    <li class="list-group-item border-0 py-0">
                        <i id="uppercase" class="bi bi-x-circle-fill text-danger"></i>
                        <span class="text-muted">Une majuscule</span>
                    </li>
                    <li class="list-group-item border-0 py-0">
                        <i id="lowercase" class="bi bi-x-circle-fill text-danger"></i>
                        <span class="text-muted">Une minuscule</span>
                    </li>
                    <li class="list-group-item border-0 py-0">
                        <i id="number" class="bi bi-x-circle-fill text-danger"></i>
                        <span class="text-muted">Un chiffre</span>
                    </li>
                    <li class="list-group-item border-0 py-0">
                        <i id="special" class="bi bi-x-circle-fill text-danger"></i>
                        <span class="text-muted">Un caractère spécial</span>
                    </li>
                </ul>
            </div>

            <!-- CHAMP STATUT -->
            <?php if (($_SESSION["user"]["statut"] ?? null) == "admin") : ?>
                <div class="mb-3">
                    <label for="statut" class="form-label fw-light"><strong>Statut</strong></label>
                    <select id="statut" class="form-select form-select-sm" name="statut">
                        <option value="admin">admin</option>
                        <option value="user" selected>user</option>
                    </select>
                </div>
            <?php endif; ?>

            <!-- BOUTON D'ENVOI -->
            <div class="d-flex justify-content-center">
                <button class="btn btn-secondary" type="submit">Valider</button>
            </div>
        </form>
    </div>
</div>