<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Controllers\Controller as Controller;


///////////////////////////////////////
// CLASSE CONTROLEUR DE LA PAGE HOME //
///////////////////////////////////////
class HomeController extends Controller
{

    //------------------------------------//
    // METHODE POUR AFFICHER LA PAGE HOME // --> Tableau de bord
    //------------------------------------//
    public function home()
    {
        if (isset($_SESSION["user"]["id_utilisateur"])) {
            $this->render("home/home", ["title" => "Tableau de bord"]);
        } else {
            header("Location: index.php");
        }
    }
}