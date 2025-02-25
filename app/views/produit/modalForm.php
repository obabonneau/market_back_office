<!---------------->
<!-- FORMULAIRE -->
<!---------------->
<div class="modal fade" id="modalForm" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- ENTETE DU FORMULAIRE -->
            <div class="modal-header">
                <h2 id="modalFormTitle" class="flex-grow-1 text-center fs-3 fst-italic"></h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- CORPS DU FORMULAIRE -->
            <div class="modal-body">
                <form id="form" class="row" method="post" action="index.php?controller=Produit&action=create">

                    <!-- CHAMP IMAGE -->
                    <div class="col-6 mb-3">
                        <label for="image" class="form-label">Image du produit</label>
                        <input id="image" class="form-control form-control-sm" type="file" name="image">
                        <div id="containerImage" class="justify-content-center mt-4 position-relative w-75 mx-auto">
                            <img id="showImage" class="img-fluid rounded-3" alt="Image du produit" src=<?php 
                                //if ($creation->picture) {
                                //    echo "$creation->picture";
                                //} else {
                                    echo "../public/img/nopicture.jpg";
                                //} 
                            ?>>
                            <button id="deleteImage" class="btn-close position-absolute top-0 end-0 m-2" type="button" aria-label="Close"></button>
                        </div>
                    </div>

                    <div class="col-6">

                        <!-- TOKEN -->
                        <input id="modalFormToken" type="hidden" name="token" value="">

                        <!-- ID -->
                        <input id="modalFormId" type="hidden" name="id_produit" value="">

                        <!-- CHAMP CATEGORIE -->
                        <div class="mb-2">
                            <label for="id_categorie" class="form-label">Catégorie</label>
                            <select id="id_categorie" class="form-select form-select-sm" name="id_categorie">
                                <option value="">Choisissez une catégorie</option>
                            </select>
                            <span id="id_categorieError" class="form-text text-danger"></span>
                        </div>

                        <!-- CHAMP PRODUIT -->
                        <div class="mb-3">
                            <label for="produit" class="form-label">Produit</label>
                            <input id="produit" class="form-control form-control-sm" type="text" name="produit" placeholder="Entrez le nom du produit">
                            <span id="produitError" class="form-text text-danger"></span>
                        </div>

                        <!-- CHAMP MARQUE -->
                        <div class="mb-2">
                            <label for="marque" class="form-label">Marque</label>
                            <input id="marque" class="form-control form-control-sm" type="text" name="marque" placeholder="Entrez la marque du produit">
                            <span id="marqueError" class="form-text text-danger"></span>
                        </div>

                        <!-- CHAMP DESCRIPTION -->
                        <div class="mb-2">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" class="form-control form-control-sm" rows="2" name="description" placeholder="Entrer la description du produit"></textarea>
                            <span id="descriptionError" class="form-text text-danger"></span>
                        </div>

                        <!-- CHAMP PRIX -->
                        <div class="mb-2">
                            <label for="prix" class="form-label">Prix</label>
                            <input id="prix" class="form-control form-control-sm" type="number" name="prix" placeholder="Entrez le prix du produit">
                            <span id="prixError" class="form-text text-danger"></span>
                        </div>

                    </div>

                    <!-- BOUTON D'ENVOI -->
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-secondary" type="submit">Valider</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>