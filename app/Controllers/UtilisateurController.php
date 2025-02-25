<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Controllers\Controller as Controller;
use App\Entities\Utilisateur as Utilisateur;
use App\Entities\Mail as Mail;
use App\Models\UtilisateurModel as UtilisateurModel;
use App\Models\MailModel as MailModel;


///////////////////////////////////////////////
// CLASSE CONTROLEUR DE L'ENTITE UTILISATEUR //
///////////////////////////////////////////////
class UtilisateurController extends Controller
{
    ///////////////////////////////////////////////////////////
    // METHODE POUR CONTROLER L'EXISTENCE D'UN COOKIE "RGPD" //
    ///////////////////////////////////////////////////////////
    // public function ctrlCookie()
    // {
    //     // RETOUR VERS LE FETCH
    //     echo json_encode(isset($_COOKIE["ackCookie"]));
    // }

    //////////////////////////////////////////////////
    // METHODE POUR DEFINIR l'ETAT DU COOKIE "RGPD" //
    //////////////////////////////////////////////////
    // public function validCookie()
    // {
    //     // VERIFICATION DU GET
    //     $valid = $_GET["cookie"] ?? "";
    //     if ($valid === "accept") {
    //         setcookie("ackCookie", "yes", time() + 365 * 24 * 3600, "/"); // Expire dans 1 an
    //     } else {
    //         setcookie("ackCookie", "no", time() + 365 * 24 * 3600, "/"); // Expire dans 1 an sans acceptation
    //     }

    //     // RETOUR VERS LE FETCH
    //     echo json_encode(true);
    // }

    ///////////////////////////////
    // METHODE POUR SE CONNECTER //
    ///////////////////////////////
    public function logon()
    {
        // VERIFICATION DE LA METHODE POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $input = json_decode(file_get_contents("php://input"), true);

            // VERIFICATION DU TOKEN
            $token = $input["token"] ?? "";
            if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                // VERIFICATION DES CHAMPS
                $email = $input["email"] ?? null;
                $password = $input["password"] ?? null;
                if ($email && $password) {

                    // LECTURE DE L'UTILISATEUR
                    $readUtilisateur = new Utilisateur();
                    $readUtilisateur->setEmail($email);
                    $readUtilisateurModel = new UtilisateurModel();
                    $utilisateur = $readUtilisateurModel->readByEmail($readUtilisateur);

                    // VERIFICATION DE L'EXISTENCE DE L'UTILISATEUR ET DU PASSWORD
                    if ($utilisateur && (password_verify($password, $utilisateur->password))) {

                        // SUPPRESSION DU TOKEN
                        // CREATION D'UNE NOUVELLE SESSION
                        unset($_SESSION["token"]);
                        session_regenerate_id();

                        // DEFINITION DE LA SESSION UTILISATEUR
                        $_SESSION["user"] = [
                            "id_utilisateur" => $utilisateur->id_utilisateur,
                            "username" => "$utilisateur->prenom $utilisateur->nom",
                            "statut" => $utilisateur->statut,
                        ];        

                        // DEFINITION DES COOKIES UTILISATEUR
                        //if ($_COOKIE["ackCookie"] === "yes") {                                   
                        //    foreach ($_SESSION["user"] as $name => $value) {
                        //        setcookie($name, $value, time() + 86400, "/");
                        //    }
                        //}

                        // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                        $this->myJsonEncode(true, "success_login");
                    
                    } else {

                        // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                        $this->myJsonEncode(false, "error_login");
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
    }

    /////////////////////////////////
    // METHODE POUR SE DECONNECTER //
    /////////////////////////////////
    public function logout()
    {
        // DESTRUCTION DES COOKIES UTILISATEUR
        //foreach ($_SESSION["user"] as $name => $value) {
        //    setcookie($name, "", time() - 3600, "/");
        //}

        // DESTRUCTION DE LA SESSION UTILISATEUR
        unset($_SESSION["user"]);
        session_destroy();

        // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
        //$this->myHeader("Home", "home", "success_logout");
        $this->myJsonEncode(true, "success_logout");
    }

    /////////////////////////////////////////////////////////////
    // METHODE POUR AFFICHER UN FORMULAIRE DE REINISIALISATION //
    /////////////////////////////////////////////////////////////
    // public function formForgetMdp()
    // {
    //     // CREATION D'UN TOKEN CSRF
    //     $this->generateToken();

    //     // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE
    //     $this->render("utilisateur/formForgetMdp");
    // }

    //////////////////////////////////////////
    // METHODE POUR REINITIALISATION UN MDP //
    //////////////////////////////////////////
    // public function forgetMdp()
    // {
    //     // VERIFICATION DE LA METHODE POST
    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //         // VERIFICATION DU TOKEN
    //         $token = $_POST["token"] ?? "";
    //         if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

    //             // SUPPRESSION DU TOKEN
    //             unset($_SESSION["token"]);

    //             // VERIFICATION DU CHAMP EMAIL
    //             if ($_POST["email"] ?? null) {

    //                 // LECTURE DE L'UTILISATEUR
    //                 $majUtilisateur = new Utilisateur();
    //                 $majUtilisateur->setEmail($_POST["email"]);
    //                 $majUtilisateurModel = new UtilisateurModel();
    //                 $utilisateur = $majUtilisateurModel->readByEmail($majUtilisateur);

    //                 if ($utilisateur) {

    //                     // GENERATION D'UN TOKEN ET D'UNE DATE D'EXPIRATION
    //                     $token = bin2hex(random_bytes(32)); // 64 caractères
    //                     $date = date("Y-m-d H:i:s", strtotime("+1 hour"));

    //                     // MISE A JOUR DE L'UTILISATEUR AVEC LE TOKEN ET LA DATE D'EXPIRATION
    //                     $majUtilisateur->setToken($token);
    //                     $majUtilisateur->setToken_expire($date);
    //                     $success1 = $majUtilisateurModel->updateToken($majUtilisateur);

    //                     // ENVOI D'UN MAIL DE REINITIALISATION
    //                     $majMdpMail = new Mail();
    //                     $majMdpMail->setPrenom($utilisateur->prenom);
    //                     $majMdpMail->setNom($utilisateur->nom);
    //                     $majMdpMail->setEmail($utilisateur->email);
    //                     $majMdpMail->setToken($token);
    //                     $majMdpMailModel = new MailModel();
    //                     $success2 = $majMdpMailModel->mdpForget($majMdpMail);

    //                     // VERIFICATION DES ACCUSES DE TRAITEMENT
    //                     // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                     $success1 && $success2
    //                     ? $this->myHeader("Home", "home", "success_email")
    //                     : $this->myHeader("Utilisateur", "formForgetMdp", "error_email");

    //                 } else {

    //                     // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                     $this->myHeader("Utilisateur", "formCreate", "error_noEmail");
    //                 }
    //             } else {

    //                 // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                 $this->myHeader("Utilisateur", "formForgetMdp", "error_inputEmail");
    //             }
    //         } else {
            
    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //         $this->myHeader("Utilisateur", "formForgetMdp", "error_token");          
    //         }
    //     }
    // }

    /////////////////////////////////////////////////////////////
    // METHODE POUR AFFICHER UN FORMULAIRE DE REINITIALISATION //
    /////////////////////////////////////////////////////////////
    // public function formUpdateMdp()
    // {
    //     // VERIFICATION DU GET
    //     if ($_GET["token"] ?? null) {

    //         // CREATION D'UN TOKEN CSRF
    //         $this->generateToken();

    //         // LECTURE DE L'UTILISATEUR AVEC LE TOKEN
    //         $readUtilisateur = new Utilisateur();
    //         $readUtilisateur->setToken($_GET["token"]);
    //         $readUtilisateurModel = new UtilisateurModel();
    //         $utilisateur = $readUtilisateurModel->readByToken($readUtilisateur);
    //         if ($utilisateur && ($_GET["token"] === $utilisateur->token)) {

    //             // VERIFICATION DE LA DATE D'EXPIRATION
    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR L'AFFICHAGE OU LE RECHARGEMENT
    //             strtotime($utilisateur->token_expire) > time()
    //             ? $this->render("utilisateur/formUpdateMdp")
    //             : $this->myHeader("Utilisateur", "formForgetMdp", "error_expire");

    //         } else {

    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //             $this->myHeader("Utilisateur", "formForgetMdp", "error_link");
    //         }
    //     } else {

    //         // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //         $this->myHeader("Home", "home", "error_id");
    //     }
    // }

    ////////////////////////////////// A OPTIMISER //////////////////////////////////
    // METHODE POUR MODIFIER LE MDP //
    //////////////////////////////////
    // public function updateMdp()
    // {
    //     // VERIFICATION DE LA METHODE POST
    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //         // VERIFICATION DU TOKEN
    //         $token = $_POST["token"] ?? "";
    //         if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

    //             // SUPPRESSION DU TOKEN
    //             unset($_SESSION["token"]);

    //             // VERIFICATION DES CHAMPS
    //             $token = $_POST["token"] ?? null;
    //             $mdp = $_POST["mdp"] ?? null;
    //             if ($token && $mdp) {

    //                 // LECTURE DE L'UTILISATEUR AVEC LE TOKEN
    //                 $majUtilisateur = new Utilisateur();
    //                 $majUtilisateur->setToken($token);
    //                 $majUtilisateurModel = new UtilisateurModel();
    //                 $utilisateur = $majUtilisateurModel->readByToken($majUtilisateur);

    //                 // MISE A JOUR DU MDP
    //                 $majUtilisateur->setEmail($utilisateur->email);
    //                 $majUtilisateur->setMdp($mdp);
    //                 $majUtilisateur->setToken(null); // Réinitialisation du token
    //                 $majUtilisateur->setToken_expire(null); // Réinitialisation de la date d'expiration
    //                 $success = $majUtilisateurModel->updateMdp($majUtilisateur);

    //                 // VERIFICATION DE L'ACCUSE DE TRAITEMENT
    //                 // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                 $success
    //                 ? $this->myHeader("Utilisateur", "formLogon", "success_updateMdp")
    //                 : $this->myHeader("Utilisateur", "formUpdateMdp", "error_request");

    //             } else {

    //                 // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //                 $this->myHeader("Utilisateur", "formUpdateMdp", "error_input");
    //             }
    //         } else {

    //             // ENVOI VERS LE CONTROLEUR PRINCIPAL POUR LE RECHARGEMENT
    //             $this->myHeader("Utilisateur", "formUpdateMdp", "error_token");
    //         }
    //     }
    // }            
}