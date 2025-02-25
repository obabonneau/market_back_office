<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Controllers\Controller as Controller;
use App\Entities\Produit as Produit;
use App\Models\ProduitModel as ProduitModel;


/////////////////////////////////////////
// CLASSE CONTROLEUR DE L'ENTITE PRODUIT //
/////////////////////////////////////////
class ProduitController extends Controller
{
    //////////////////////////////////////
    // METHODE POUR CHERCHER DES PRODUITS //
    //////////////////////////////////////
    // public function search()
    // {
    //     // VERIFICATION DE LA METHODE POST
    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //         // VERIFICATION DU CHAMP
    //         if ($_POST["search"] ?? null) {

    //             // PREPARATION DE LA RECHERCHE
    //             $search = "%" . $_POST["search"] . "%"; // Nécessaire pour lancer la recherche en bdd

    //             // LECTURE DES PRODUITS CORRESPONDANTS
    //             $readProduit = new ProduitModel();
    //             $produits = $readProduit->search($search);
     
    //             // VERIFICATION DE L'EXISTENCE DE PRODUITS
    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE OU LE RECHARGEMENT
    //             $produits                   
    //             ? $this->render("produit/list", ["produits" => $produits])
    //             : $this->myHeader("Home", "home", "error_blank");

    //         } else {

    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //             $this->myHeader("Home", "home", "error_search");
    //         }
    //     }
    // }

    //----------------------------------//
    // METHODE POUR LISTER LES PRODUITS //
    //----------------------------------//
    // Pas de conditonnment : produits existants
    public function list()
    {
        // LECTURE DE TOUS LES PRODUITS
        $readProduitModel = new ProduitModel();        
        $produits = $readProduitModel->readAll();
    
        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE
        $data = [
            "produits" => $produits,
            "title" => "Produits",
            "scripts" => [
                "type='module' src='../public/js/module/tokenCreate.js'",
                "type='module' src='../public/js/module/modalForm.js'",
                "type='module' src='../public/js/module/modalFormError.js'",
                "type='module' src='../public/js/produit/produitFormCtrl.js'",
                "type='module' src='../public/js/produit/produitCreate.js'",
                // "type='module' src='../public/js/produit/produitUpdate.js'",
                "type='module' src='../public/js/produit/produitDelete.js'"
            ]
        ];
        $this->render("produit/list", $data);
    }

    //-------------------------------//
    // METHODE POUR CREER UN PRODUIT //
    //-------------------------------//
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
                    $id_categorie = $_POST["id_categorie"] ?? null;
                    $produit = $_POST["produit"] ?? null;
                    $marque = $_POST["marque"] ?? null;
                    $description = $_POST["description"] ?? null;
                    $prix = $_POST["prix"] ?? null;
                    if ($id_categorie && $produit && $marque && $description && $prix) {

                        // CREATION DU PRODUIT
                        $addProduit = new Produit();
                        $addProduit->setId_categorie($id_categorie);
                        $addProduit->setProduit($produit);
                        $addProduit->setMarque($marque);
                        $addProduit->setDescription($description);
                        $addProduit->setPrix($prix);
                        $addProduitModel = new ProduitModel();
                        $success = $addProduitModel->create($addProduit);

                        // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                        // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                        $success ? $this->myJsonEncode(true, "") : $this->myJsonEncode(false, "error_request");

                    } else {

                        // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                        $this->myJsonEncode(false, "error_input");
                    }
                } else {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                    $this->myJsonEncode(false, "error_token");
                }
            }
        } else {
            
            // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
            $this->myJsonEncode(false, "error_rights");
        }
    }

    ///////////////////////////////////////////////////////////
    // METHODE POUR AFFICHER UN FORMULAIRE DE MAJ D'UN PRODUIT //
    ///////////////////////////////////////////////////////////
    // public function formUpdate()
    // {
    //     // VERIFICATION DES DROITS
    //     if (($_SESSION["user"]["statut"] ?? "") === "admin") {

    //         // VERIFICATION DU GET
    //         if ($_GET["id_produit"] ?? null) {

    //             // CREATION D'UN TOKEN CSRF
    //             $this->generateToken();

    //             // LECTURE DU PRODUIT
    //             $readProduit = new Produit();
    //             $readProduit->setId_produit($_GET["id_produit"]);
    //             $readProduitModel = new ProduitModel();
    //             $produit = $readProduitModel->readbyId($readProduit);

    //             // VERIFICATION DE L'EXISTENCE DU PRODUIT
    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE OU RECHARGEMENT
    //             $produit
    //             ? $this->render("produit/formUpdate", ["produit" => $produit])
    //             : $this->myHeader("Produit", "listAdmin", "error_request");

    //         } else {

    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //             $this->myHeader("Produit", "listAdmin", "error_id");
    //        }
    //     } else {

    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //         $this->myHeader("Home", "home", "error_rights");
    //     }
    // }

    ////////////////////////////////////
    // METHODE POUR MODIFIER UN PRODUIT //
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
    //                 $id_produit = $_POST["id_produit"] ?? null;
    //                 $titre = $_POST["titre"] ?? null;
    //                 $auteur = $_POST["auteur"] ?? null;
    //                 $genre = $_POST["genre"] ?? null;
    //                 $annee = $_POST["annee"] ?? null;
    //                 if ($id_produit && $titre && $auteur && $genre && $annee) {

    //                     // MISE A JOUR DU PRODUIT
    //                     $majProduit = new Produit();
    //                     $majProduit->setId_produit($id_produit);
    //                     $majProduit->setTitre($titre);
    //                     $majProduit->setAuteur($auteur);
    //                     $majProduit->setGenre($genre);
    //                     $majProduit->setAnnee($annee);
    //                     $majProduitModel = new ProduitModel();
    //                     $success = $majProduitModel->update($majProduit);

    //                     // VERIFICATION DE L'ACCUSE DE TRAITEMENT
    //                     // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                     $success
    //                     ? $this->myHeader("Produit", "listAdmin", "success_produitUpdate")
    //                     : $this->myHeader("Produit", "formUpdate", "error_request", ["id_produit" => $id_produit]);

    //                 } else {

    //                     // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                     $this->myHeader("Produit", "formUpdate", "error_input", ["id_produit" => $id_produit]);
    //                 }
    //             } else {

    //                 // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                 $this->myHeader("Produit", "formUpdate", "error_token");
    //             }
    //         } 
    //     } else {

    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //         $this->myHeader("Home", "home", "error_rights");
    //     }
    // }

    /////////////////////////////////////
    // METHODE POUR SUPPRIMER UN PRODUIT //
    /////////////////////////////////////
    public function delete()
    {
        // VERIFICATION DES DROITS
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {
            $input = json_decode(file_get_contents("php://input"), true);

            // VERIFICATION DU TOKEN
            $token = $input["token"] ?? "";
            if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                // SUPPRESSION DU TOKEN
                unset($_SESSION["token"]);

                // VERIFICATION DU GET
                if ($input["id_produit"] ?? null) {

                    // LECTURE DU PRODUIT
                    $delProduit = new Produit();
                    $delProduit->setId_produit($input["id_produit"]);
                    $delProduitModel = new ProduitModel();
                    $success = $delProduitModel->delete($delProduit);

                    $success
                        ? $this->myJsonEncode(true, "")
                        : $this->myJsonEncode(false, "error_request"); 
                        
                } else {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                    $this->myJsonEncode(false, "error_id");
                }
            } else {

                // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                $this->myJsonEncode(false, "error_token");
            }
        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
            $this->myJsonEncode(false, "error_rights");
        }
    }
}