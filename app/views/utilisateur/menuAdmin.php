<!---------------------->
<!-- TITRE DE LA PAGE -->
<!---------------------->
<div class="d-flex align-items-center">
    <!-- TITRE -->
    <h1 class="flex-grow-1 text-center fs-3 fst-italic">Menu d'administration</h1>

    <!-- BOUTON RETOUR -->
    <a class="btn btn-outline-secondary" href="index.php?controller=Home&action=home"
        title="Retour en arrière">
        <i class="bi bi-x-lg"></i>
    </a>
</div>

<!--------------------------->
<!-- MENU D'ADMINISTRATION -->
<!--------------------------->
<div class="my-3">
    <div class="row g-4">
        
        <!-- MENU UTILISATEURS -->
        <div class="col-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="bi bi-people-fill display-4 text-primary"></i>
                    <h5 class="card-title mt-3">Utilisateurs</h5>
                    <p class="card-text">Gérer les utilisateurs</p>
                    <a href="index.php?controller=Utilisateur&action=listAdmin" class="btn btn-primary">Gérer</a>
                </div>
            </div>
        </div>

        <!-- MENU LIVRES-->
        <div class="col-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="bi bi-book display-4 text-success"></i>
                    <h5 class="card-title mt-3">Livres</h5>
                    <p class="card-text">Gérer les livres</p>
                    <a href="index.php?controller=Livre&action=listAdmin" class="btn btn-success">Gérer</a>
                </div>
            </div>
        </div>

        <!-- MENU EMPRUNTS -->
        <div class="col-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="bi bi-arrow-left-right display-4 text-warning"></i>
                    <h5 class="card-title mt-3">Emprunts</h5>
                    <p class="card-text">Gérér les emprunts</p>
                    <a href="index.php?controller=Emprunt&action=listAdmin" class="btn btn-warning">Gérer</a>
                </div>
            </div>
        </div>
    </div>
</div>