<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Models;

// IMPORT DE CLASSES
use App\Core\DbConnect;
use App\Entities\Categorie;
use PDO;
use PDOException;

////////////////////////////////////////
// CLASSE MODEL DE L'ENTITE CATEGORIE //
////////////////////////////////////////
class CategorieModel extends DbConnect
{
    //---------------------------------------//
    // METHODE POUR LIRE TOUS LES CATEGORIES //
    //---------------------------------------//
    public function readAll()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM com_categorie");

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $categories = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $categories;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }
}