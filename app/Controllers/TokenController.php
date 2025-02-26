<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Controllers;


/////////////////////////////
// CLASSE TOKEN CONTROLLER //
/////////////////////////////
class TokenController
{
    //------------------------------------//
    // METHODE POUR GENERER UN TOKEN CSRF //
    //------------------------------------//
    public function create()
    {
        $token_expiration = time() + 900; // 15 minutes (900 secondes)
        $_SESSION["token"] = [
            "id" => bin2hex(random_bytes(32)),
            "token_expiration" => $token_expiration
        ];
        echo json_encode($_SESSION["token"]);
    }
}