<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Models\MessageModel;


/////////////////////////////////
// CLASSE CONTROLEUR PRINCIPAL //
/////////////////////////////////
abstract class Controller
{
    //////////////////////////////////////
    // METHODE POUR LE RENDU DANS VIEWS //
    //////////////////////////////////////
    public function render($view, $data = [])
    {
        extract($data); // Les clés du tableau deviennent des noms de variables.

        ob_start();
        require_once "../app/Includes/header.php";
        require_once "../app/views/" . $view . ".php";
        require_once "../app/Includes/footer.php";
        $content = ob_get_clean(); // Capture toute la sortie
    
        echo $content;
        //exit();
    }

    /////////////////////////////////////
    // METHODE POUR RECHARGER UNE PAGE //
    /////////////////////////////////////
    public function myHeader($controller, $action, $messageKey, $data = [])
    {
        // CONSTRUCTION DE L'URL
        $controller === "Home"
            ? $location = "index.php"
            : $location = "index.php?controller=" . $controller . "&action=" . $action;

        // AJOUT D'UN PARAMETRE ID
        if ($data ?? null) {
            $location .= "&" . key($data) . "=" . current($data);
        }

        // AJOUT D'UN MESSAGE
        if (isset($messageKey)) {   
            $messageModel = new MessageModel();
            $message = $messageModel->getMessage($messageKey);

            if (str_starts_with($messageKey, "success_")) {
                $_SESSION["msgOK"] = $message;
            } else {
                $_SESSION["msgKO"] = $message;
            }
        }
        
        header("location: " . $location);
        //exit();  
    }

    //////////////////////////////////////
    // METHODE POUR LE RENDU DANS VIEWS //
    //////////////////////////////////////
    public function myJsonEncode($data, $messageKey)
    {
        $messageModel = new MessageModel();
        $message = $messageModel->getMessage($messageKey);

        echo json_encode(["data" => $data, "message" => $message]);
    }

    ////////////////////////////////////////
    // METHODE POUR GENERER UN TOKEN CSRF //
    ////////////////////////////////////////
    // public function generateToken()
    // {
    //     $token_expiration = time() + 900; // 15 minutes (900 secondes)
    //     $_SESSION["token"] = [
    //         "id" => bin2hex(random_bytes(32)),
    //         "token_expiration" => $token_expiration
    //     ];
    // }
}