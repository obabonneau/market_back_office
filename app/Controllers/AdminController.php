<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Controllers\Controller as Controller;
use App\Entities\Utilisateur as Utilisateur;
use App\Models\UtilisateurModel as UtilisateurModel;


///////////////////////////////////////////////
// CLASSE CONTROLEUR DE L'ENTITE UTILISATEUR //
///////////////////////////////////////////////
class AdminController extends Controller
{
    //----------------------------------------//
    // METHODE POUR AFFICHER LES UTILISATEURS //
    //----------------------------------------//
    public function listUser()
    {
        // VERIFICATION DES DROITS D'ACCES
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // LECTURE DE TOUS LES UTILISATEURS
            $readUtilisateurModel = new UtilisateurModel();        
            $utilisateurs = $readUtilisateurModel->readAll();

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE
            $data = [
                "utilisateurs" => $utilisateurs, 
                "title" => "Utilisateurs",
                "scripts" => [
                    "type='module' src='../public/js/module/tokenCreate.js'",
                    "type='module' src='../public/js/module/modalForm.js'",
                    "type='module' src='../public/js/module/modalFormError.js'",
                    "type='module' src='../public/js/admin/userFormCtrl.js'",
                    "type='module' src='../public/js/admin/userCreate.js'",
                    "type='module' src='../public/js/admin/userUpdate.js'",
                    "type='module' src='../public/js/admin/userDelete.js'"
                ]
            ];
            $this->render("utilisateur/list", $data);

        } else{

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myHeader("Home", "home", "error_rights");
        }
    }
    
    //----------------------------------//
    // METHODE POUR LIRE UN UTILISATEUR //
    //----------------------------------//
    public function readUserById()
    {
        // VERIFICATION DES DROITS D'ACCES
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {
            $input = json_decode(file_get_contents("php://input"), true);

            // VERIFICATION DU GET
            if ($input["id_utilisateur"] ?? null) {

                // LECTURE DE L'UTILISATEUR
                $readUtilisateur = new Utilisateur();
                $readUtilisateur->setId_utilisateur($input["id_utilisateur"]);
                $readUtilisateurModel = new UtilisateurModel();
                $utilisateur = $readUtilisateurModel->readById($readUtilisateur);

                // VERIFICATION DE L'EXISTENCE DE L'UTILISATEUR
                if ($utilisateur) {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE
                    $this->myJsonEncode($utilisateur, "");
                } else
                {
                    // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                    $this->myJsonEncode(false, "error_request");
                }
            } else {

                // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
                $this->myJsonEncode(false, "error_id");
            } 
        } else {

            // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
            $this->myJsonEncode(false, "error_rights");
        }
    }

    //-----------------------------------//
    // METHODE POUR CREER UN UTILISATEUR //
    //-----------------------------------//
    public function createUser()
    {
        // VERIFICATION DES DROITS D'ACCES
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // VERIFICATION DE LA METHODE POST
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                // VERIFICATION DU TOKEN
                $token = $_POST["token"] ?? "";
                if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                    // SUPPRESSION DU TOKEN
                    unset($_SESSION["token"]);

                    // VERIFICATION DES CHAMPS
                    $prenom = $_POST["prenom"] ?? null;
                    $nom = $_POST["nom"] ?? null;
                    $email = $_POST["email"] ?? null;
                    $password = $_POST["password"] ?? null;
                    $statut = $_POST["statut"] ?? "user"; // Statut user minimum
                    if ($prenom && $nom && $email && $password) {

                        // CREATION D'UN UTILISATEUR
                        $addUtilisateur = new Utilisateur();
                        $addUtilisateur->setPrenom($prenom);
                        $addUtilisateur->setNom($nom);
                        $addUtilisateur->setEmail($email);
                        $addUtilisateur->setPassword($password);
                        $addUtilisateur->setStatut($statut);
                        $addUtilisateurModel = new UtilisateurModel();
                        $success = $addUtilisateurModel->create($addUtilisateur);

                        // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                        if ($success === true) {

                            // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                            $this->myJsonEncode(true, "success_createUserByAdmin");

                            // VERIFICATION DE L'EXISTENCE DE L'EMAIL
                        } elseif ($success === "emailExistant") {

                            // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                            $this->myJsonEncode(false, "error_adminFound");
                        } else {

                            // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                            $this->myJsonEncode(false, "error_request");
                        }
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

    //--------------------------------------//
    // METHODE POUR MODIFIER UN UTILISATEUR //
    //--------------------------------------//
    public function updateUser()
    {
        // VERIFICATION DES DROITS D'ACCES
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {

            // VERIFICATION DE LA METHODE POST
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                // VERIFICATION DU TOKEN
                $token = $_POST["token"] ?? "";
                if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                    // SUPPRESSION DU TOKEN
                    unset($_SESSION["token"]);

                    // VERIFICATION DES CHAMPS
                    $id_utilisateur = $_POST["id_utilisateur"] ?? null;
                    $prenom = $_POST["prenom"] ?? null;
                    $nom = $_POST["nom"] ?? null;
                    $email = $_POST["email"] ?? null;
                    $password = $_POST["password"] ?? ""; // Le mot de passe peut être nul.
                    $statut = $_POST["statut"] ?? "user"; // Statut user minimum
                    if ($id_utilisateur && $prenom && $nom && $email) {

                        // MISE A JOUR DE L'UTILISATEUR
                        $majUtilisateur = new Utilisateur();
                        $majUtilisateur->setId_utilisateur($id_utilisateur);
                        $majUtilisateur->setPrenom($prenom);
                        $majUtilisateur->setNom($nom);
                        $majUtilisateur->setEmail($email);
                        $majUtilisateur->setPassword($password);
                        $majUtilisateur->setStatut($statut);

                        $majUtilisateurModel = new UtilisateurModel();
                        $success = $majUtilisateurModel->update($majUtilisateur);

                        // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                        // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                        $success
                            ? $this->myJsonEncode(true, "success_updateUserByAdmin")
                            : $this->myJsonEncode(false, "error_request");

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

    //---------------------------------------//
    // METHODE POUR SUPPRIMER UN UTILISATEUR //
    //---------------------------------------//
    public function deleteUser()
    {
        // VERIFICATION DES DROITS D'ACCES
        if (($_SESSION["user"]["statut"] ?? "") === "admin") {
            $input = json_decode(file_get_contents("php://input"), true);

            // VERIFICATION DU TOKEN
            $token = $input["token"] ?? "";
            if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                // SUPPRESSION DU TOKEN
                unset($_SESSION["token"]);

                // VERIFICATION DU GET
                if ($input["id"] ?? null) {

                    // CONTROLE DE L'EXISTENCE D'UN EMPRUNT
                    $delUtilisateur = new utilisateur();
                    $delUtilisateur->setId_utilisateur($input["id"]);
                    $delUtilisateurModel = new utilisateurModel();
                    $success = $delUtilisateurModel->delete($delUtilisateur);

                    // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                    // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                    $success
                        ? $this->myJsonEncode(true, "success_deleteUser")
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