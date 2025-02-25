<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Controllers\Controller as Controller;
use App\Entities\Categorie as Categorie;
use App\Models\CategorieModel as CategorieModel;


/////////////////////////////////////////////
// CLASSE CONTROLEUR DE L'ENTITE CATEGORIE //
/////////////////////////////////////////////
class CategorieController extends Controller
{
    //////////////////////////////////////
    // METHODE POUR CHERCHER DES CATEGORIES //
    //////////////////////////////////////
    // public function search()
    // {
    //     // VERIFICATION DE LA METHODE POST
    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //         // VERIFICATION DU CHAMP
    //         if ($_POST["search"] ?? null) {

    //             // PREPARATION DE LA RECHERCHE
    //             $search = "%" . $_POST["search"] . "%"; // Nécessaire pour lancer la recherche en bdd

    //             // LECTURE DES CATEGORIES CORRESPONDANTS
    //             $readCategorie = new CategorieModel();
    //             $categories = $readCategorie->search($search);
     
    //             // VERIFICATION DE L'EXISTENCE DE CATEGORIES
    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE OU LE RECHARGEMENT
    //             $categories                   
    //             ? $this->render("categorie/list", ["categories" => $categories])
    //             : $this->myHeader("Home", "home", "error_blank");

    //         } else {

    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //             $this->myHeader("Home", "home", "error_search");
    //         }
    //     }
    // }

    ////////////////////////////////////
    // METHODE POUR LISTER LES CATEGORIES //
    ////////////////////////////////////
    // Pas de conditonnment : categories existants
    public function list()
    {
        // LECTURE DE TOUS LES CATEGORIES
        $readCategorieModel = new CategorieModel();        
        $categories = $readCategorieModel->readAll();
    
        // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"

        $this->myJsonEncode($categories, "");
   }

    // ////////////////////////////////////
    // // METHODE POUR LISTER LES CATEGORIES //
    // ////////////////////////////////////
    // // Pas de conditionnement : categories existants
    // public function listAdmin()
    // {
    //     // VERIFICATION DES DROITS D'ACCES
    //     if (($_SESSION["user"]["statut"] ?? "") === "admin") {

    //         // CREATION D'UN TOKEN CSRF
    //         $this->generateToken();

    //         // LECTURE DE TOUS LES CATEGORIES
    //         $readCategorieModel = new CategorieModel();
    //         $categories = $readCategorieModel->readAll();

    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE
    //         $this->render("categorie/listAdmin", ["categories" => $categories]);

    //     } else {

    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //         $this->myHeader("Home", "home", "error_rights");
    //     }
    // }

    ////////////////////////////////
    // METHODE POUR VOIR UN CATEGORIE //
    ////////////////////////////////
    // public function view()
    // {
    //     // VERIFICATION DU GET
    //     if ($_GET["id_categorie"] ?? null) {

    //         // CREATION D'UN TOKEN CSRF
    //         $this->generateToken();

    //         // LECTURE DU CATEGORIE
    //         $readCategorie = new Categorie();
    //         $readCategorie->setId_categorie($_GET["id_categorie"]);
    //         $readCategorieModel = new CategorieModel();
    //         $categorie = $readCategorieModel->readById($readCategorie);

    //         // VERIFICATION DE L'EXISTENCE DU CATEGORIE
    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE OU RECHARGEMENT
    //         $categorie
    //         ? $this->render("categorie/view", ["categorie" => $categorie])
    //         : $this->myHeader("Home", "home", "error_request");

    //     } else {

    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //         $this->myHeader("Home", "home", "error_id");
    //     }
    // }

    //////////////////////////////////////////////////////////////
    // METHODE POUR AFFICHER UN FORMULAIRE DE CREATION DE CATEGORIE //
    //////////////////////////////////////////////////////////////
    // public function formCreate()
    // {
    //     // VERIFICATION DES DROITS
    //     if ($_SESSION["user"]["statut"] ?? "" === "admin") {
            
    //         // CREATION D'UN TOKEN CSRF
    //         $this->generateToken();

    //         // ENVOI VERS LE SCRIPT
    //         echo json_encode($_SESSION["token"]["id"]);

    //     } else {

    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //         $this->myHeader("Home", "home", "error_rights");
    //     }
    // }

    /////////////////////////////////
    // METHODE POUR CREER UN CATEGORIE //
    /////////////////////////////////
    // public function create()
    // {
    //     // VERIFICATION DES DROITS
    //     if (($_SESSION["user"]["statut"] ?? "") === "admin") {

    //         // VERIFICATION DE LA METHODE POST
    //         if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //             // VERIFICATION DU TOKEN
    //             $token = $_POST["token"] ?? "";
    //             if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

    //                 // SUPPRESSION DU TOKEN
    //                 unset($_SESSION["token"]);

    //                 // VERIFICATION DES CHAMPS
    //                 $titre = $_POST["titre"] ?? null;
    //                 $auteur = $_POST["auteur"] ?? null;
    //                 $genre = $_POST["genre"] ?? null;
    //                 $annee = $_POST["annee"] ?? null;
    //                 if ($titre && $auteur && $genre && $annee) {

    //                     // CREATION DU CATEGORIE
    //                     $addCategorie = new Categorie();
    //                     $addCategorie->setTitre($titre);
    //                     $addCategorie->setAuteur($auteur);
    //                     $addCategorie->setGenre($genre);
    //                     $addCategorie->setAnnee($annee);
    //                     $addCategorie->setStatut(0); // 0 = Disponible
    //                     $addCategorieModel = new CategorieModel();
    //                     $success = $addCategorieModel->create($addCategorie);

    //                     // VERIFICATION DE L'ACCUSE DE TRAITEMENT
    //                     // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                     if ($success) {
    //                     echo json_encode($success); 
    //                     } else {
    //                     $this->myHeader("Categorie", "formCreate", "error_request");
    //                     }

    //                 } else {

    //                     // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                     $this->myHeader("Categorie", "formCreate", "error_input");
    //                 }
    //             } else {

    //                 // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                 $this->myHeader("Categorie", "formCreate", "error_token");
    //             }
    //         }
    //     } else {
            
    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //         $this->myHeader("Home", "home", "error_rights");
    //     }
    // }

    ///////////////////////////////////////////////////////////
    // METHODE POUR AFFICHER UN FORMULAIRE DE MAJ D'UN CATEGORIE //
    ///////////////////////////////////////////////////////////
    // public function formUpdate()
    // {
    //     // VERIFICATION DES DROITS
    //     if (($_SESSION["user"]["statut"] ?? "") === "admin") {

    //         // VERIFICATION DU GET
    //         if ($_GET["id_categorie"] ?? null) {

    //             // CREATION D'UN TOKEN CSRF
    //             $this->generateToken();

    //             // LECTURE DU CATEGORIE
    //             $readCategorie = new Categorie();
    //             $readCategorie->setId_categorie($_GET["id_categorie"]);
    //             $readCategorieModel = new CategorieModel();
    //             $categorie = $readCategorieModel->readbyId($readCategorie);

    //             // VERIFICATION DE L'EXISTENCE DU CATEGORIE
    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE OU RECHARGEMENT
    //             $categorie
    //             ? $this->render("categorie/formUpdate", ["categorie" => $categorie])
    //             : $this->myHeader("Categorie", "listAdmin", "error_request");

    //         } else {

    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //             $this->myHeader("Categorie", "listAdmin", "error_id");
    //        }
    //     } else {

    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //         $this->myHeader("Home", "home", "error_rights");
    //     }
    // }

    ////////////////////////////////////
    // METHODE POUR MODIFIER UN CATEGORIE //
    ////////////////////////////////////
    // public function update()
    // {
    //     // VERIFICATION DES DROITS
    //     if (($_SESSION["user"]["statut"] ?? "") === "admin") {

    //         // VERIFICATION DE LA METHODE
    //         if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //             // VERIFICATION DU TOKEN
    //             $token = $_POST["token"] ?? "";
    //             if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

    //                 // SUPPRESSION DU TOKEN
    //                 unset($_SESSION["token"]);

    //                 // VERIFICATION DES CHAMPS
    //                 $id_categorie = $_POST["id_categorie"] ?? null;
    //                 $titre = $_POST["titre"] ?? null;
    //                 $auteur = $_POST["auteur"] ?? null;
    //                 $genre = $_POST["genre"] ?? null;
    //                 $annee = $_POST["annee"] ?? null;
    //                 if ($id_categorie && $titre && $auteur && $genre && $annee) {

    //                     // MISE A JOUR DU CATEGORIE
    //                     $majCategorie = new Categorie();
    //                     $majCategorie->setId_categorie($id_categorie);
    //                     $majCategorie->setTitre($titre);
    //                     $majCategorie->setAuteur($auteur);
    //                     $majCategorie->setGenre($genre);
    //                     $majCategorie->setAnnee($annee);
    //                     $majCategorieModel = new CategorieModel();
    //                     $success = $majCategorieModel->update($majCategorie);

    //                     // VERIFICATION DE L'ACCUSE DE TRAITEMENT
    //                     // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                     $success
    //                     ? $this->myHeader("Categorie", "listAdmin", "success_categorieUpdate")
    //                     : $this->myHeader("Categorie", "formUpdate", "error_request", ["id_categorie" => $id_categorie]);

    //                 } else {

    //                     // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                     $this->myHeader("Categorie", "formUpdate", "error_input", ["id_categorie" => $id_categorie]);
    //                 }
    //             } else {

    //                 // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                 $this->myHeader("Categorie", "formUpdate", "error_token");
    //             }
    //         } 
    //     } else {

    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //         $this->myHeader("Home", "home", "error_rights");
    //     }
    // }

    /////////////////////////////////////
    // METHODE POUR SUPPRIMER UN CATEGORIE //
    /////////////////////////////////////
    // public function delete()
    // {
    //     // VERIFICATION DES DROITS
    //     if (($_SESSION["user"]["statut"] ?? "") === "admin") {

    //         // VERIFICATION DU TOKEN
    //         $token = $_GET["token"] ?? "";
    //         if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

    //             // SUPPRESSION DU TOKEN
    //             unset($_SESSION["token"]);

    //             // VERIFICATION DU GET
    //             if ($_GET["id_categorie"] ?? null) {

    //                 // LECTURE DU CATEGORIE
    //                 $delCategorie = new Categorie();
    //                 $delCategorie->setId_categorie($_GET["id_categorie"]);
    //                 $delCategorieModel = new CategorieModel();
    //                 $categorie = $delCategorieModel->readById($delCategorie);

    //                 // VERIFICATION DU STATUT DU CATEGORIE
    //                 if (!$categorie->statut) { // 0 = Disponible

    //                     // SUPPRESSION DU CATEGORIE
    //                     $success = $delCategorieModel->delete($delCategorie);

    //                     // VERIFICATION DE L'ACCUSE DE TRAITEMENT
    //                     // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                     $success
    //                     ? $this->myHeader("Categorie", "listAdmin", "success_categorieDelete")
    //                     : $this->myHeader("Categorie", "listAdmin", "error_request");
                        
    //                 } else {

    //                     // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                     $this->myHeader("Categorie", "listAdmin", "error_isEmprunt");
    //                 }
    //             } else {

    //                 // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                 $this->myHeader("Categorie", "listAdmin", "error_id");
    //             }
    //         } else {

    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //             $this->myHeader("Categorie", "listAdmin", "error_reinput");
    //         }
    //     } else {

    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //         $this->myHeader("Home", "home", "error_rights");
    //     }
    // }
}