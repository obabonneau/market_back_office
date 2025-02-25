<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Liste des produits</h1>
</div>

<!-- Content Row -->
<div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 p-0">
        <div class="card-header py-3">
            <button id="listBtnCreate" type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalForm">Créer un nouveau produit</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Produit</th>
                            <th scope="col">Marque</th>
                            <th scope="col">Description</th>
                            <th scope="col">Prix</th>
                            <th class="text-center" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php foreach ($produits as $produit) : ?>
                            <tr id="listTr<?php echo htmlspecialchars($produit->id_produit, ENT_QUOTES, "UTF-8"); ?>">
                                <td class="text-start ps-3">
                                    <img class="rounded-3" style="max-width: 100px; max-height: 100px;" src="../public/img/produit.jpg" alt="Image du produit">
                                </td>
                                <td class="text-start ps-3">
                                    <span class="badge bg-secondary"><?php echo htmlspecialchars($produit->categorie, ENT_QUOTES, "UTF-8"); ?></span>
                                </td>
                                <td class="text-start ps-3">
                                    <?php echo htmlspecialchars($produit->produit, ENT_QUOTES, "UTF-8"); ?>
                                </td>
                                <td class="text-start ps-3">
                                    <?php echo htmlspecialchars($produit->marque, ENT_QUOTES, "UTF-8"); ?>
                                </td>
                                <td class="text-start ps-3">
                                    <?php echo htmlspecialchars($produit->description, ENT_QUOTES, "UTF-8"); ?>
                                </td>
                                <td class="text-start ps-3">
                                    <?php echo htmlspecialchars($produit->prix, ENT_QUOTES, "UTF-8"); ?>
                                </td>
                                <td class="text-center p-2">
                                    <button id="listBtnUpdate" class="btn btn-sm btn-warning" data-id="<?php echo htmlspecialchars($produit->id_produit, ENT_QUOTES, "UTF-8"); ?>"
                                        title="Modifier">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button id="listBtnDelete" class="btn btn-sm btn-danger" data-id="<?php echo htmlspecialchars($produit->id_produit, ENT_QUOTES, "UTF-8"); ?>"
                                        title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DU FORMULAIRE ET DE SUPPRESSION -->
<?php
include "modalForm.php";
include "modalDelete.php";
?>