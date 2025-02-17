<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Entities\Emprunt;
use App\Entities\Livre;
use App\Models\EmpruntModel;
use App\Models\LivreModel;
use App\Models\UtilisateurModel;
use App\Controllers\Controller;


///////////////////////////////////////////
// CLASSE CONTROLEUR DE L'ENTITE EMPRUNT //
///////////////////////////////////////////
class EmpruntController extends Controller
{
    //////////////////////////////////////
    // METHODE POUR LISTER LES EMPRUNTS //
    //////////////////////////////////////
    public function list()
    {
        // VERIFICATION DES DROITS D'ACCES
        if (isset($_SESSION["user"]["id_utilisateur"])) {

            // LECTURE DES EMPRUNTS DE L'UTILISATEUR
            $readEmprunt = new Emprunt();
            $readEmprunt->setId_utilisateur($_SESSION["user"]["id_utilisateur"]);
            $readEmpruntModel = new EmpruntModel();
            $emprunts = $readEmpruntModel->readByUser($readEmprunt);

            // VERIFICATION DE L'EXISTENCE D'EMPRUNTS
            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE OU LE RECHARGEMENT
            $emprunts
            ? $this->render("emprunt/list", ["emprunts" => $emprunts])
            : $this->myHeader("Home", "home", "error_blank");

        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    //////////////////////////////////////
    // METHODE POUR LISTER LES EMPRUNTS //
    //////////////////////////////////////
    // Pas de conditionnement, emprunts existants
    public function listAdmin()
    {
        // VERIFICATION DES DROITS D'ACCES
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // CREATION D'UN TOKEN CSRF
            $this->generateToken();

            // LECTURE DE TOUS LES EMPRUNTS
            $readEmpruntModel = new EmpruntModel();
            $emprunts = $readEmpruntModel->readAll();

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE
            $this->render("emprunt/listAdmin", ["emprunts" => $emprunts]);

        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    ///////////////////////////////////////////////////////////////
    // METHODE POUR AFFICHER UN FORMULAIRE DE CREATION D'EMPRUNT //
    ///////////////////////////////////////////////////////////////
    // Pas de conditionnement, utilisateurs et livres existants
    public function formCreate()
    {
        // VERIFICATION DES DROITS
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // CREATION D'UN TOKEN CSRF
            $this->generateToken();

            // LECTURE DE TOUS LES UTILISATEURS
            $readUtilisateurModel = new UtilisateurModel();
            $utilisateurs = $readUtilisateurModel->readAll();

            // LECTURE DES LIVRES DISPONIBLES
            $readLivre = new Livre();
            $readLivre->setStatut(0); // 0 = Disponible
            $readLivreModel = new LivreModel();
            $livres = $readLivreModel->readbyStatut($readLivre);

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE
            $this->render("emprunt/formCreate", ["utilisateurs" => $utilisateurs, "livres" => $livres]);
        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    ///////////////////////////////////////////////
    // METHODE POUR CREER UN EMPRUNT PAR L'ADMIN //
    ///////////////////////////////////////////////
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
                    $id_livre = $_POST["id_livre"] ?? null;
                    $id_utilisateur = $_POST["id_utilisateur"] ?? null;
                    if ($id_livre && $id_utilisateur) {

                        // CREATION D'UN EMPRUNT
                        $addEmprunt = new Emprunt();
                        $addEmprunt->setId_Livre($id_livre);
                        $addEmprunt->setId_Utilisateur($id_utilisateur);
                        $addEmprunt->setDebut(date("Y-m-d"));
                        $addEmprunt->setFin(null);
                        $addEmpruntModel = new EmpruntModel();
                        $success1 = $addEmpruntModel->create($addEmprunt);
            
                        // MISE A JOUR DU STATUT DU LIVRE
                        $success2 = $this->updateStatutLivre($id_livre, 1); // 1 = Emprunté

                        // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        $success1 && $success2
                        ? $this->myHeader("Emprunt", "listAdmin", "success_createEmprunt")
                        : $this->myHeader("Emprunt", "formCreate", "error_request");  
                    } else {

                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        $this->myHeader("Emprunt", "formCreate", "error_input");
                    }
                } else {
                
                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                    $this->myHeader("Emprunt", "formCreate", "error_token");
                }
            } else {
            
                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                $this->myHeader("Home", "home", "error_rights");
            }
        }
    }

    /////////////////////////////////////////////////////
    // METHODE POUR CREER UN EMPRUNT PAR L'UTILISATEUR //
    /////////////////////////////////////////////////////
    public function userCreate()
    {
        // VERIFICATION DES DROITS
        if (isset($_SESSION["user"]["id_utilisateur"])) {

            // VERIFICATION DU TOKEN
            $token = $_GET["token"] ?? "";
            if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                // SUPPRESSION DU TOKEN
                unset($_SESSION["token"]);

                // VERIFICATION DU PARAMETRE
                if ($_GET["id_livre"] ?? null) {

                    // VERIFICATION DU NOMBRE D'EMPRUNTS EN COURS
                    if ($this->checkEmprunt() < 3) {

                        // CREATION D'UN EMPRUNT
                        $addEmprunt = new Emprunt();
                        $addEmprunt->setId_Livre($_GET["id_livre"]);
                        $addEmprunt->setId_Utilisateur($_SESSION["user"]["id_utilisateur"]);
                        $addEmprunt->setDebut(date("Y-m-d"));
                        $addEmprunt->setFin(null);
                        $addEmpruntModel = new EmpruntModel();
                        $success1 = $addEmpruntModel->create($addEmprunt);

                        // MISE A JOUR DU STATUT DU LIVRE  
                        $success2 = $this->updateStatutLivre($_GET["id_livre"], 1); // 1 = Emprunté

                        // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        $success1 && $success2
                        ? $this->myHeader("Emprunt", "list", "success_createEmprunt")
                        : $this->myHeader("Livre", "list", "error_request");
                    } else {

                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        $this->myHeader("Emprunt", "list", "error_limitEmprunt");
                    }
                } else {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                    $this->myHeader("Livre", "list", "error_id");
                }
            } else {

                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                $this->myHeader("Emprunt", "list", "error_token");
            }
        } else {
            
            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    /////////////////////////////////////////////////////////////
    // METHODE POUR AFFICHER UN FORMULAIRE DE MAJ D'UN EMPRUNT //
    /////////////////////////////////////////////////////////////
    // Pas de conditionnement, utilisateurs et livres existants
    public function formUpdate()
    {
        // VERIFICATION DES DROITS
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // VERIFICATION DU PARAMETRE
            if ($_GET["id_emprunt"] ?? null) {

                // CREATION D'UN TOKEN CSRF
                $this->generateToken();

                // LECTURE DE TOUS LES LIVRES
                $readLivreModel = new LivreModel();        
                $livres = $readLivreModel->readAll();

                // LECTURE DE TOUS LES UTILISATEURS
                $readUtilisateurModel = new UtilisateurModel();
                $utilisateurs = $readUtilisateurModel->readAll();

                // LECTURE DE L'EMPRUNT
                $readEmprunt = new Emprunt();
                $readEmprunt->setId_Emprunt($_GET["id_emprunt"]);
                $readEmpruntModel = new EmpruntModel();
                $emprunt = $readEmpruntModel->readbyId($readEmprunt);

                // VERIFICATION DE L'EXISTENCE DE L'EMPRUNT
                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE OU LE RECHARGEMENT
                $emprunt              
                ? $this->render("emprunt/formUpdate", ["emprunt" => $emprunt, "livres" => $livres, "utilisateurs" => $utilisateurs])
                : $this->myHeader("Emprunt", "listAdmin", "error_request");
            } else {

                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                $this->myHeader("Emprunt", "listAdmin", "error_id");
            }
        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    //////////////////////////////////////
    // METHODE POUR MODIFIER UN EMPRUNT //
    //////////////////////////////////////
    public function update()
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
                    $id_emprunt = $_POST["id_emprunt"] ?? null;
                    $id_utilisateur = $_POST["id_utilisateur"] ?? null;
                    $id_livre = $_POST["id_livre"] ?? null;
                    $debut = $_POST["debut"] ?? null;
                    $fin = $_POST["fin"] ?? null;
                    if ($id_emprunt && $id_utilisateur && $id_livre && $debut && $fin) {

                        // MISE A JOUR DE L'EMPRUNT
                        $majEmprunt = new Emprunt();
                        $majEmprunt->setId_emprunt($id_emprunt);
                        $majEmprunt->setId_utilisateur($id_utilisateur);
                        $majEmprunt->setId_livre($id_livre);
                        $majEmprunt->setDebut($debut);
                        $majEmprunt->setFin($fin);
                        $majEmpruntModel = new EmpruntModel();
                        $success = $majEmpruntModel->update($majEmprunt);

                        // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        $success
                        ? $this->myHeader("Emprunt", "listAdmin", "success_updateEmprunt")
                        : $this->myHeader("Emprunt", "formUpdate", "error_request", ["id_emprunt" => $id_emprunt]);
                    } else {

                        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                        $this->myHeader("Emprunt", "formUpdate", "error_input", ["id_emprunt" => $id_emprunt]);
                    }
                } else {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                    $this->myHeader("Emprunt", "listAdmin", "error_token");
                } 
            } 
        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    ///////////////////////////////////////
    // METHODE POUR RESTITUER UN EMPRUNT //
    ///////////////////////////////////////
    public function return()
    {
        // VERIFICATION DES DROITS
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // VERIFICATION DU TOKEN
            $token = $_GET["token"] ?? "";
            if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                // SUPPRESSION DU TOKEN
                unset($_SESSION["token"]);

                // VERIFICATION DU PARAMETRE
                if ($_GET["id_emprunt"] ?? null) {

                    // RESTITUTION DE L'EMPRUNT
                    $majEmprunt = new Emprunt();
                    $majEmprunt->setId_Emprunt($_GET["id_emprunt"]);
                    $majEmprunt->setFin(date("Y-m-d"));
                    $majEmpruntModel = new EmpruntModel();
                    $emprunt = $majEmpruntModel->readById($majEmprunt); // On récupère l'emprunt pour récupérer l'id_livre
                    $success1 = $majEmpruntModel->return($majEmprunt);

                    // MISE A JOUR DU STATUT DU LIVRE
                    $success2 = $this->updateStatutLivre($emprunt->id_livre, 0); // 0 = Disponible

                    // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                    $success1 && $success2
                    ? $this->myHeader("Emprunt", "listAdmin", "success_updateEmprunt")
                    : $this->myHeader("Emprunt", "listAdmin", "error_request");
                } else {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                    $this->myHeader("Emprunt", "listAdmin", "error_id");
                }
            } else {
                
                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                $this->myHeader("Emprunt", "listAdmin", "error_token");
            }
        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }

    ///////////////////////////////////////
    // METHODE POUR SUPPRIMER UN EMPRUNT //
    ///////////////////////////////////////
    public function delete()
    {
        // VERIFICATION DES DROITS
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // VERIFICATION DU TOKEN
            $token = $_GET["token"] ?? "";
            if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                // SUPPRESSION DU TOKEN
                unset($_SESSION["token"]);

                // VERIFICATION DU PARAMETRE
                if ($_GET["id_emprunt"] ?? null) {

                    // SUPPRESSION DE L'EMPRUNT
                    $delEmprunt = new Emprunt();
                    $delEmprunt->setId_Emprunt($_GET["id_emprunt"]);
                    $delEmpruntModel = new EmpruntModel();
                    $emprunt = $delEmpruntModel->readById($delEmprunt); // On récupère l'emprunt pour récupérer l'id_livre
                    $success1 = $delEmpruntModel->delete($delEmprunt);

                    // MISE A JOUR DU STATUT DU LIVRE
                    $success2 = $this->updateStatutLivre($emprunt->id_livre, 0); // 0 = Disponible

                    // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                    $success1 && $success2
                    ? $this->myHeader("Emprunt", "listAdmin", "success_deleteEmprunt")
                    : $this->myHeader("Emprunt", "listAdmin", "error_request");
                } else {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                    $this->myHeader("Emprunt", "listAdmin", "error_id");
                }
            } else {

                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                $this->myHeader("Emprunt", "listAdmin", "error_token");
            }
        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }



    ////////////////////////////////////////////////
    // METHODE POUR MODIFIER LE STATUT D'UN LIVRE //
    ////////////////////////////////////////////////
    private function updateStatutLivre($id_livre, $statut)
    {
        // MISE A JOUR DU STATUT DU LIVRE
        $majLivre = new Livre();
        $majLivre->setId_livre($id_livre);
        $majLivre->setStatut($statut);
        $majLivreModel = new LivreModel();

        // RETOUR DE L'ACCUSE DE TRAITEMENT
        return $majLivreModel->updateStatut($majLivre);
    }

    /////////////////////////////////////////////////////////
    // METHODE POUR VERIFIER LE NOMBRE D'EMPRUNTS EN COURS //
    /////////////////////////////////////////////////////////
    private function checkEmprunt()
    {
        // LECTURE DES EMPRUNTS
        $readEmprunt = new Emprunt();
        $readEmprunt->setId_utilisateur($_SESSION["user"]["id_utilisateur"]);
        $readEmpruntModel = new EmpruntModel();
        $emprunts = $readEmpruntModel->readByUser($readEmprunt);

        // COMPTE DU NOMBRE D'EMPRUNTS EN COURS
        $nbrEmprunt = 0;
        foreach ($emprunts as $emprunt) {
            if ($emprunt->fin === 0) {
                $nbrEmprunt++;
            }
        }

        // RETOUR DU NOMBRE D'EMPRUNTS
        return $nbrEmprunt;
    }
}