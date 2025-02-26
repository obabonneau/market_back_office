<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Models;

// IMPORT DE CLASSES
use App\Core\DbConnect;
use App\Entities\Produit;
use PDO;
use PDOException;

////////////////////////////////////
// CLASSE MODEL DE L'ENTITE PRODUIT //
////////////////////////////////////
class ProduitModel extends DbConnect
{
    //-------------------------------------//
    // METHODE POUR LIRE TOUS LES PRODUITS //
    //-------------------------------------//
    public function readAll()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT com_produit.*, com_categorie.categorie
                FROM com_produit
                INNER JOIN com_categorie ON com_produit.id_categorie = com_categorie.id_categorie");

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $produits = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $produits;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    //-------------------------------//
    // METHODE POUR CREER UN PRODUIT //
    //-------------------------------//
    public function create(Produit $addProduit)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("INSERT INTO com_produit (id_categorie, produit, marque, description, prix, image)
                VALUES (:id_categorie, :produit, :marque, :description, :prix, :image)");
            $this->request->bindValue(":id_categorie", $addProduit->getId_categorie(), PDO::PARAM_INT);
            $this->request->bindValue(":produit", $addProduit->getProduit(), PDO::PARAM_STR);
            $this->request->bindValue(":marque", $addProduit->getMarque(), PDO::PARAM_STR);
            $this->request->bindValue(":description", $addProduit->getDescription(), PDO::PARAM_STR);
            $this->request->bindValue(":prix", $addProduit->getPrix(), PDO::PARAM_STR);
            $this->request->bindValue(":image", $addProduit->getImage(), PDO::PARAM_STR);

            // EXECUTION DE LA REQUETE SQL
            return $this->request->execute();

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ////////////////////////////////////
    // METHODE POUR MODIFIER UN PRODUIT //
    ////////////////////////////////////
    //public function update(Produit $majProduit)
    // {
    //     try {
    //         // PREPARATION DE LA REQUETE SQL
    //         $this->request = $this->connection->prepare("UPDATE produit SET
    //             titre = :titre,
    //             auteur = :auteur,
    //             genre = :genre,
    //             annee = :annee
    //             WHERE id_produit = :id_produit");
    //         $this->request->bindValue(":id_produit", $majProduit->getId_produit(), PDO::PARAM_INT);
    //         $this->request->bindValue(":titre", $majProduit->getTitre(), PDO::PARAM_STR);
    //         $this->request->bindValue(":auteur", $majProduit->getAuteur(), PDO::PARAM_STR);
    //         $this->request->bindValue(":genre", $majProduit->getGenre(), PDO::PARAM_STR);
    //         $this->request->bindValue(":annee", $majProduit->getAnnee(), PDO::PARAM_INT);

    //         // EXECUTION DE LA REQUETE SQL
    //         $execution = $this->request->execute();

    //         // VERIFICATION DE L'UPDATE
    //         if ($execution && $this->request->rowCount() > 0) {
    //             return true;  // Suppression réussie
    //         } else {
    //             return false; // Aucuns produits trouvés ou erreur dans l'exécution
    //         }

    //     } catch (PDOException $e) {
    //         //echo $e->getMessage();
    //         //die;
    //     }
    // }

    /////////////////////////////////////
    // METHODE POUR SUPPRIMER UN PRODUIT //
    /////////////////////////////////////
    public function delete(Produit $delProduit)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("DELETE FROM com_produit WHERE id_produit = :id_produit");
            $this->request->bindValue(":id_produit", $delProduit->getId_produit(), PDO::PARAM_INT);

            // EXECUTION DE LA REQUETE SQL
            $execution = $this->request->execute();

            // VERIFICATION DE LA SUPPRESSION
            if ($execution && $this->request->rowCount() > 0) {
                return true;  // Suppression réussie
            } else {
                return false; // Aucunes tâches trouvées ou erreur dans l'exécution
            }

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }
}