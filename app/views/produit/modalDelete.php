<!--------------------------------------->
<!-- MODAL DE SUPPRESSION D'UN PRODUIT -->
<!--------------------------------------->
<div class="modal fade" id="modalDelete" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression d'un produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer ce produit ?</p>
                <input type="hidden" id="modalDeleteId" value="">
                <input type="hidden" id="modalDeleteToken" value="">
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Annuler</button>
                <button id="modalDeleteBtn" type="button" class="btn btn-danger">Supprimer</button>
            </div>
        </div>
    </div>
</div>