<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Controllers\Controller;
use App\Entities\User;
use App\Entities\Mail;
use App\Models\UserModel;
use App\Models\MailModel;


///////////////////////////////////////////////
// CLASSE CONTROLEUR DE L'ENTITE UTILISATEUR //
///////////////////////////////////////////////
class UserController extends Controller
{
    //---------------------------//
    // METHODE POUR SE CONNECTER //
    //---------------------------//
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
                    $readUtilisateur = new User();
                    $readUtilisateur->setEmail($email);
                    $readUtilisateurModel = new UserModel();
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

    //-----------------------------//
    // METHODE POUR SE DECONNECTER //
    //-----------------------------//
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

    //------------------------------------------------------------------//
    // METHODE POUR ENVOYER UN MAIL DE REINITIALISATION DU MOT DE PASSE //
    //------------------------------------------------------------------//
    public function forgotPasswordEmail()
    {
        // VERIFICATION DE LA METHODE POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $input = json_decode(file_get_contents("php://input"), true);

            // VERIFICATION DU TOKEN
            $token = $input["token"] ?? "";
            if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                // VERIFICATION DU CHAMP EMAIL
                if ($input["email"] ?? null) {

                    // LECTURE DE L'UTILISATEUR
                    $majUtilisateur = new User();
                    $majUtilisateur->setEmail($input["email"]);
                    $majUtilisateurModel = new UserModel();
                    $utilisateur = $majUtilisateurModel->readByEmail($majUtilisateur);

                    if ($utilisateur) {
                        
                        // SUPPRESSION DU TOKEN
                        unset($_SESSION["token"]);

                        // GENERATION D'UN TOKEN ET D'UNE DATE D'EXPIRATION
                        $token = bin2hex(random_bytes(32)); // 64 caractères
                        $date = date("Y-m-d H:i:s", strtotime("+1 hour"));

                        // MISE A JOUR DE L'UTILISATEUR AVEC LE TOKEN ET LA DATE D'EXPIRATION
                        $majUtilisateur->setToken($token);
                        $majUtilisateur->setToken_expire($date);
                        $success1 = $majUtilisateurModel->updateToken($majUtilisateur);

                        // ENVOI D'UN MAIL DE REINITIALISATION
                        $majMdpMail = new Mail();
                        $majMdpMail->setPrenom($utilisateur->prenom);
                        $majMdpMail->setNom($utilisateur->nom);
                        $majMdpMail->setEmail($utilisateur->email);
                        $majMdpMail->setToken($token);
                        $majMdpMailModel = new MailModel();
                        $success2 = $majMdpMailModel->mdpForgot($majMdpMail);

                        // VERIFICATION DES ACCUSES DE TRAITEMENT
                        // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                        $success1 && $success2
                        ? $this->myJsonEncode(true, "success_email")
                        : $this->myJsonEncode(false, "error_email");

                    } else {

                        // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                        $this->myJsonEncode(false, "error_noEmail");
                    }
                } else {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                    $this->myJsonEncode(false, "error_inputEmail");
                }
            } else {
            
                // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                $this->myJsonEncode(false, "error_token");
            }
        }
    }

    //--------------------------------------------------------------------//
    // METHODE POUR CONTROLER LE LIEN DE REINITIALISATION DU MOT DE PASSE //
    //--------------------------------------------------------------------//
    public function forgotPasswordCtrl()
    {
        // HEADER JSON
        //header("Access-Control-Allow-Origin: *");
        //header("Content-Type: application/json; charset=UTF-8");
        //header("Access-Control-Allow-Methods: GET");
        //header("Access-Control-Max-Age: 3600");
        //header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if ($_SERVER["REQUEST_METHOD"] === "GET") {

            // VERIFICATION DU GET
            if ($_GET["token"] ?? null) {

                // LECTURE DE L'UTILISATEUR AVEC LE TOKEN
                $readUtilisateur = new User();
                $readUtilisateur->setToken($_GET["token"]);
                $readUtilisateurModel = new UserModel();
                $utilisateur = $readUtilisateurModel->readByToken($readUtilisateur);
                if ($utilisateur && ($_GET["token"] === $utilisateur->token)) {

                    // VERIFICATION DE LA DATE D'EXPIRATION
                    // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                    strtotime($utilisateur->token_expire) > time()
                    ? $this->myJsonEncode(true, "success_expire")
                    : $this->myJsonEncode(false, "error_expire");
                } else {

                    // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                    $this->myJsonEncode(false, "error_link");
                }
            } else {

                // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                $this->myJsonEncode(false, "error_id");
            }
        } else {
            http_response_code(405); // 405 Method Not Allowed
            echo json_encode("ERREUR : Méthode non autorisée !");
        }
    }

    //--------------------------------------------//
    // METHODE POUR REINITIALISER LE MOT DE PASSE //
    //--------------------------------------------//
    public function forgotPasswordUpdate()
    {
        // VERIFICATION DE LA METHODE POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $input = json_decode(file_get_contents("php://input"), true);

            // VERIFICATION DU TOKEN
            $token = $input["token"] ?? "";
            if ((hash_equals($_SESSION["token"]["id"], $token)) && (time() < $_SESSION["token"]["token_expiration"])) {

                // VERIFICATION DES CHAMPS
                $userToken = $input["userToken"] ?? null;
                $password = $input["password"] ?? null;
                if ($token && $password) {

                    // SUPPRESSION DU TOKEN
                    unset($_SESSION["token"]);

                    // LECTURE DE L'UTILISATEUR AVEC LE TOKEN
                    $majUtilisateur = new User();
                    $majUtilisateur->setToken($userToken);
                    $majUtilisateurModel = new UserModel();
                    $utilisateur = $majUtilisateurModel->readByToken($majUtilisateur);
  
                    // MISE A JOUR DU PASSWORD
                    $majUtilisateur->setEmail($utilisateur->email);
                    $majUtilisateur->setPassword($password);
                    $majUtilisateur->setToken(null); // Réinitialisation du token
                    $majUtilisateur->setToken_expire(null); // Réinitialisation de la date d'expiration
                    $success = $majUtilisateurModel->updatePassword($majUtilisateur);

                    // VERIFICATION DE L'ACCUSE DE TRAITEMENT
                    // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"
                    $success
                    ? $this->myJsonEncode(true, "success_updateMdp")
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
    }


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
}