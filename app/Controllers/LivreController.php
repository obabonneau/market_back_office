<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Controllers\Controller as Controller;
use App\Entities\Livre as Livre;
use App\Models\LivreModel as LivreModel;


/////////////////////////////////////////
// CLASSE CONTROLEUR DE L'ENTITE LIVRE //
/////////////////////////////////////////
class LivreController extends Controller
{
    //////////////////////////////////////
    // METHODE POUR CHERCHER DES LIVRES //
    //////////////////////////////////////
    public function search()
    {
        // VERIFICATION DE LA METHODE POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // VERIFICATION DU CHAMP
            if ($_POST["search"] ?? null) {

                // PREPARATION DE LA RECHERCHE
                $search = "%" . $_POST["search"] . "%"; // Nécessaire pour lancer la recherche en bdd

                // LECTURE DES LIVRES CORRESPONDANTS
                $readLivre = new LivreModel();
                $livres = $readLivre->search($search);
     
                // VERIFICATION DE L'EXISTENCE DE LIVRES
                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE OU LE RECHARGEMENT
                $livres                   
                ? $this->render("livre/list", ["livres" => $livres])
                : $this->myHeader("Home", "home", "error_blank");

            } else {

                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                $this->myHeader("Home", "home", "error_search");
            }
        }
    }

    ////////////////////////////////////
    // METHODE POUR LISTER LES LIVRES //
    ////////////////////////////////////
    // Pas de conditonnment : livres existants
    public function list()
    {
        // LECTURE DE TOUS LES LIVRES
        $readLivreModel = new LivreModel();        
        $livres = $readLivreModel->readAll();
    
        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE
        $this->render("livre/list", ["livres" => $livres]);
    }

    ////////////////////////////////////
    // METHODE POUR LISTER LES LIVRES //
    ////////////////////////////////////
    // Pas de conditionnement : livres existants
    public function listAdmin()
    {
        // VERIFICATION DES DROITS D'ACCES
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // CREATION D'UN TOKEN CSRF
            $this->generateToken();

            // LECTURE DE TOUS LES LIVRES
            $readLivreModel = new LivreModel();
            $livres = $readLivreModel->readAll();

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE
            $this->render("livre/listAdmin", ["livres" => $livres]);

        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    ////////////////////////////////
    // METHODE POUR VOIR UN LIVRE //
    ////////////////////////////////
    public function view()
    {
        // VERIFICATION DU GET
        if ($_GET["id_livre"] ?? null) {

            // CREATION D'UN TOKEN CSRF
            $this->generateToken();

            // LECTURE DU LIVRE
            $readLivre = new Livre();
            $readLivre->setId_livre($_GET["id_livre"]);
            $readLivreModel = new LivreModel();
            $livre = $readLivreModel->readById($readLivre);

            // VERIFICATION DE L'EXISTENCE DU LIVRE
            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE OU RECHARGEMENT
            $livre
            ? $this->render("livre/view", ["livre" => $livre])
            : $this->myHeader("Home", "home", "error_request");

        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_id");
        }
    }

    //////////////////////////////////////////////////////////////
    // METHODE POUR AFFICHER UN FORMULAIRE DE CREATION DE LIVRE //
    //////////////////////////////////////////////////////////////
    public function formCreate()
    {
        // VERIFICATION DES DROITS
        if ($_SESSION["user"]["statut"] ?? "" === "admin") {
            
            // CREATION D'UN TOKEN CSRF
            $this->generateToken();

            // ENVOI VERS LE SCRIPT
            echo json_encode($_SESSION["token"]["id"]);

        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    /////////////////////////////////
    // METHODE POUR CREER UN LIVRE //
    /////////////////////////////////
    public function create()
    {
        // VERIFICATION DES DROITS
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // VERIFICATION DE LA METHODE POST
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                // VERIFICATION DU TOKEN
                $token = $_POST["token"] ?? "";
                if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                    // SUPPRESSION DU TOKEN
                    unset($_SESSION["token"]);

                    // VERIFICATION DES CHAMPS
                    $titre = $_POST["titre"] ?? null;
                    $auteur = $_POST["auteur"] ?? null;
                    $genre = $_POST["genre"] ?? null;
                    $annee = $_POST["annee"] ?? null;
                    if ($titre && $auteur && $genre && $annee) {

                        // CREATION DU LIVRE
                        $addLivre = new Livre();
                        $addLivre->setTitre($titre);
                        $addLivre->setAuteur($auteur);
                        $addLivre->setGenre($genre);
                        $addLivre->setAnnee($annee);
                        $addLivre->setStatut(0); // 0 = Disponible
                        $addLivreModel = new LivreModel();
                        $success = $addLivreModel->create($addLivre);

                        // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        if ($success) {
                        echo json_encode($success); 
                        } else {
                        $this->myHeader("Livre", "formCreate", "error_request");
                        }

                    } else {

                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        $this->myHeader("Livre", "formCreate", "error_input");
                    }
                } else {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                    $this->myHeader("Livre", "formCreate", "error_token");
                }
            }
        } else {
            
            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    ///////////////////////////////////////////////////////////
    // METHODE POUR AFFICHER UN FORMULAIRE DE MAJ D'UN LIVRE //
    ///////////////////////////////////////////////////////////
    public function formUpdate()
    {
        // VERIFICATION DES DROITS
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // VERIFICATION DU GET
            if ($_GET["id_livre"] ?? null) {

                // CREATION D'UN TOKEN CSRF
                $this->generateToken();

                // LECTURE DU LIVRE
                $readLivre = new Livre();
                $readLivre->setId_livre($_GET["id_livre"]);
                $readLivreModel = new LivreModel();
                $livre = $readLivreModel->readbyId($readLivre);

                // VERIFICATION DE L'EXISTENCE DU LIVRE
                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE OU RECHARGEMENT
                $livre
                ? $this->render("livre/formUpdate", ["livre" => $livre])
                : $this->myHeader("Livre", "listAdmin", "error_request");

            } else {

                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                $this->myHeader("Livre", "listAdmin", "error_id");
           }
        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    ////////////////////////////////////
    // METHODE POUR MODIFIER UN LIVRE //
    ////////////////////////////////////
    public function update()
    {
        // VERIFICATION DES DROITS
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // VERIFICATION DE LA METHODE
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                // VERIFICATION DU TOKEN
                $token = $_POST["token"] ?? "";
                if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                    // SUPPRESSION DU TOKEN
                    unset($_SESSION["token"]);

                    // VERIFICATION DES CHAMPS
                    $id_livre = $_POST["id_livre"] ?? null;
                    $titre = $_POST["titre"] ?? null;
                    $auteur = $_POST["auteur"] ?? null;
                    $genre = $_POST["genre"] ?? null;
                    $annee = $_POST["annee"] ?? null;
                    if ($id_livre && $titre && $auteur && $genre && $annee) {

                        // MISE A JOUR DU LIVRE
                        $majLivre = new Livre();
                        $majLivre->setId_livre($id_livre);
                        $majLivre->setTitre($titre);
                        $majLivre->setAuteur($auteur);
                        $majLivre->setGenre($genre);
                        $majLivre->setAnnee($annee);
                        $majLivreModel = new LivreModel();
                        $success = $majLivreModel->update($majLivre);

                        // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        $success
                        ? $this->myHeader("Livre", "listAdmin", "success_livreUpdate")
                        : $this->myHeader("Livre", "formUpdate", "error_request", ["id_livre" => $id_livre]);

                    } else {

                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        $this->myHeader("Livre", "formUpdate", "error_input", ["id_livre" => $id_livre]);
                    }
                } else {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                    $this->myHeader("Livre", "formUpdate", "error_token");
                }
            } 
        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    /////////////////////////////////////
    // METHODE POUR SUPPRIMER UN LIVRE //
    /////////////////////////////////////
    public function delete()
    {
        // VERIFICATION DES DROITS
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // VERIFICATION DU TOKEN
            $token = $_GET["token"] ?? "";
            if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                // SUPPRESSION DU TOKEN
                unset($_SESSION["token"]);

                // VERIFICATION DU GET
                if ($_GET["id_livre"] ?? null) {

                    // LECTURE DU LIVRE
                    $delLivre = new Livre();
                    $delLivre->setId_livre($_GET["id_livre"]);
                    $delLivreModel = new LivreModel();
                    $livre = $delLivreModel->readById($delLivre);

                    // VERIFICATION DU STATUT DU LIVRE
                    if (!$livre->statut) { // 0 = Disponible

                        // SUPPRESSION DU LIVRE
                        $success = $delLivreModel->delete($delLivre);

                        // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        $success
                        ? $this->myHeader("Livre", "listAdmin", "success_livreDelete")
                        : $this->myHeader("Livre", "listAdmin", "error_request");
                        
                    } else {

                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        $this->myHeader("Livre", "listAdmin", "error_isEmprunt");
                    }
                } else {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                    $this->myHeader("Livre", "listAdmin", "error_id");
                }
            } else {

                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                $this->myHeader("Livre", "listAdmin", "error_reinput");
            }
        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }
}