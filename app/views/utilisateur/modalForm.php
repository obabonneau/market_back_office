<!---------------------------->
<!-- FORMULAIRE DE CREATION -->
<!---------------------------->
<div class="modal fade" id="modalForm" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- ENTETE DU FORMULAIRE -->
            <div class="modal-header">
                <h2 id="modalFormTitle" class="flex-grow-1 text-center fs-3 fst-italic"></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- CORPS DU FORMULAIRE -->
            <div class="modal-body">
                <form id="form" method="post" novalidate>

                    <!-- TOKEN -->
                    <input id="modalFormToken" type="hidden" name="token" value="">

                    <!-- ID -->
                    <input id="modalFormId" type="hidden" name="id_utilisateur" value="">

                    <!-- CHAMP PRENOM -->
                    <div class="mb-2">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input id="prenom" class="form-control form-control-sm" type="text" name="prenom" placeholder="Entrez votre prénom">
                        <small id="prenomError" class="form-text text-danger"></small>
                    </div>

                    <!-- CHAMP NOM -->
                    <div class="mb-2">
                        <label for="nom" class="form-label">Nom</label>
                        <input id="nom" class="form-control form-control-sm" type="text" name="nom" placeholder="Entrez votre nom">
                        <small id="nomError" class="form-text text-danger"></small> 
                    </div>

                    <!-- CHAMP EMAIL -->
                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control form-control-sm" type="email" name="email" placeholder="Entrez votre email">
                        <small id="emailError" class="form-text text-danger"></small>
                    </div>

                    <!-- CHAMP MDP -->
                    <div class="mb-2">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input id="password" class="form-control form-control-sm" type="password" name="password" placeholder="Entrez votre mot de passe">
                        <small id="passwordError" class="form-text text-danger"></small>
                    </div>

                    <!-- ZONE DE CONTROLE DU MDP -->
                    <div class="w-100" id="menuCheck" style="display: none;">

                        <!-- AFFICHAGE DU MDP -->
                        <div class="form-check ms-2">
                            <input class="form-check-input" id="passwordShow" type="checkbox">
                            <label class="form-check-label text-muted" for="passwordShow"><small>Afficher le mot de passe</small></label>
                        </div>

                        <!-- LISTE DES CRITERES -->
                        <ul class="list-group my-2">
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
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                            <small id="statutError" class="form-text text-danger"></small>
                        </div>
                    <?php endif; ?>

                    <!-- BOUTON D'ENVOI -->
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-secondary" type="submit">Valider</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>