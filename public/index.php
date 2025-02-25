<?php

// AFFICHAGE DES ERREURS PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);

// INITIALISATION DE LA SESSION
session_start();

// VERIFICATION DE LA CONNEXION DE L'UTILISATEUR
if (isset($_COOKIE["id_utilisateur"])) {
    if (!isset($_SESSION["user"])) {
        $_SESSION["user"] = [
            "id_utilisateur" => $_COOKIE["id_utilisateur"],
            "username" => $_COOKIE["username"],
            "statut" => $_COOKIE["statut"]
        ];
    }
}

// INCLUSION DE L'AUTOLOADER
require_once '../app/Autoloader.php';

// IMPORT DE CLASSES
use App\Autoloader;
use App\Core\Router;

// CHARGEMENT DE L'AUTOLOADER
App\Autoloader::register();

// INSTANCIATION D'UN OBJET "routeur"
$routeur = new Router();

// UTILISATION DE LA METHODE "routes" DE L'OBJET "routeur"
$routeur->routes();