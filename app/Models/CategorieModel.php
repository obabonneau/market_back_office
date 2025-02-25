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

    /////////////////////////////////////
    // METHODE POUR CREER UN CATEGORIE //
    /////////////////////////////////////
    // public function create(Categorie $addCategorie)
    // {
    //     try {
    //         // PREPARATION DE LA REQUETE SQL
    //         $this->request = $this->connection->prepare("INSERT INTO categorie (titre, auteur, genre, annee, statut)
    //             VALUES (:titre, :auteur, :genre, :annee, :statut)");
    //         $this->request->bindValue(":titre", $addCategorie->getTitre(), PDO::PARAM_STR);
    //         $this->request->bindValue(":auteur", $addCategorie->getAuteur(), PDO::PARAM_STR);
    //         $this->request->bindValue(":genre", $addCategorie->getGenre(), PDO::PARAM_STR);
    //         $this->request->bindValue(":annee", $addCategorie->getAnnee(), PDO::PARAM_INT);
    //         $this->request->bindValue(":statut", $addCategorie->getStatut(), PDO::PARAM_BOOL);

    //         // EXECUTION DE LA REQUETE SQL
    //         return $this->request->execute();

    //     } catch (PDOException $e) {
    //         //echo $e->getMessage();
    //         //die;
    //     }
    // }

    ////////////////////////////////////
    // METHODE POUR MODIFIER UN CATEGORIE //
    ////////////////////////////////////
    //public function update(Categorie $majCategorie)
    // {
    //     try {
    //         // PREPARATION DE LA REQUETE SQL
    //         $this->request = $this->connection->prepare("UPDATE categorie SET
    //             titre = :titre,
    //             auteur = :auteur,
    //             genre = :genre,
    //             annee = :annee
    //             WHERE id_categorie = :id_categorie");
    //         $this->request->bindValue(":id_categorie", $majCategorie->getId_categorie(), PDO::PARAM_INT);
    //         $this->request->bindValue(":titre", $majCategorie->getTitre(), PDO::PARAM_STR);
    //         $this->request->bindValue(":auteur", $majCategorie->getAuteur(), PDO::PARAM_STR);
    //         $this->request->bindValue(":genre", $majCategorie->getGenre(), PDO::PARAM_STR);
    //         $this->request->bindValue(":annee", $majCategorie->getAnnee(), PDO::PARAM_INT);

    //         // EXECUTION DE LA REQUETE SQL
    //         $execution = $this->request->execute();

    //         // VERIFICATION DE L'UPDATE
    //         if ($execution && $this->request->rowCount() > 0) {
    //             return true;  // Suppression réussie
    //         } else {
    //             return false; // Aucuns categories trouvés ou erreur dans l'exécution
    //         }

    //     } catch (PDOException $e) {
    //         //echo $e->getMessage();
    //         //die;
    //     }
    // }

    /////////////////////////////////////
    // METHODE POUR SUPPRIMER UN CATEGORIE //
    /////////////////////////////////////
    // public function delete(Categorie $delCategorie)
    // {
    //     try {
    //         // PREPARATION DE LA REQUETE SQL
    //         $this->request = $this->connection->prepare("DELETE FROM categorie WHERE id_categorie = :id_categorie");
    //         $this->request->bindValue(":id_categorie", $delCategorie->getId_categorie(), PDO::PARAM_INT);

    //         // EXECUTION DE LA REQUETE SQL
    //         $execution = $this->request->execute();

    //         // VERIFICATION DE LA SUPPRESSION
    //         if ($execution && $this->request->rowCount() > 0) {
    //             return true;  // Suppression réussie
    //         } else {
    //             return false; // Aucunes tâches trouvées ou erreur dans l'exécution
    //         }

    //     } catch (PDOException $e) {
    //         //echo $e->getMessage();
    //         //die;
    //     }
    // }
}