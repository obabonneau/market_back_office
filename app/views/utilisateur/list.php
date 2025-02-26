<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Liste des utilisateurs</h1>
</div>

<!-- Content Row -->
<div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 p-0">
        <div class="card-header py-3">
            <button id="listBtnCreate" type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalForm">Créer un nouvel utilisateur</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <!-- <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="dataTable_length">
                            <label>Show
                                <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="dataTable_filter" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label>
                        </div>
                    </div>
                </div> -->
                <table class="table table-bordered table-hover border-3" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">Prénom</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Statut</th>
                            <th class="text-center" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php foreach ($utilisateurs as $utilisateur) : ?>
                            <tr id="listTr<?php echo htmlspecialchars($utilisateur->id_utilisateur, ENT_QUOTES, "UTF-8"); ?>">
                                <td class="text-start ps-3">
                                    <?php echo htmlspecialchars($utilisateur->prenom, ENT_QUOTES, "UTF-8"); ?>
                                </td>
                                <td class="text-start ps-3">
                                    <?php echo htmlspecialchars($utilisateur->nom, ENT_QUOTES, "UTF-8"); ?>
                                </td>
                                <td class="text-start ps-3">
                                    <?php echo htmlspecialchars($utilisateur->email, ENT_QUOTES, "UTF-8"); ?></td>
                                <td>
                                    <span class="badge bg-secondary"><?php echo htmlspecialchars($utilisateur->statut, ENT_QUOTES, "UTF-8"); ?></span>
                                </td>
                                <td class="text-center p-2">
                                    <button id="listBtnUpdate" class="btn btn-sm btn-warning" data-id="<?php echo htmlspecialchars($utilisateur->id_utilisateur, ENT_QUOTES, "UTF-8"); ?>"
                                        title="Modifier">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button id="listBtnDelete" class="btn btn-sm btn-danger" data-id="<?php echo htmlspecialchars($utilisateur->id_utilisateur, ENT_QUOTES, "UTF-8"); ?>"   
                                        title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="dataTable_previous">
                                    <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                </li>
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                                </li>
                                <li class="paginate_button page-item ">
                                    <a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                                </li>
                                <li class="paginate_button page-item next" id="dataTable_next">
                                    <a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- MODAL INCLUDE -->
<?php
include "modalForm.php";
include "modalDelete.php";
?>