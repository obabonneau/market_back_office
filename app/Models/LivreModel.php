<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Models;

// IMPORT DE CLASSES
use App\Core\DbConnect;
use App\Entities\Livre;
use PDO;
use PDOException;

////////////////////////////////////
// CLASSE MODEL DE L'ENTITE LIVRE //
////////////////////////////////////
class LivreModel extends DbConnect
{
    //////////////////////////////////////
    // METHODE POUR RECHERCHER UN LIVRE //
    //////////////////////////////////////
    public function search($search)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request= $this->connection->prepare("SELECT id_livre, titre, auteur, genre, annee, statut
                FROM livre
                WHERE livre.titre LIKE :search
                OR livre.auteur LIKE :search
                OR livre.genre LIKE :search
                OR livre.annee LIKE :search
                ORDER BY titre ASC");
            $this->request->bindParam(':search', $search);

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $livres = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $livres;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ///////////////////////////////////////
    // METHODE POUR LIRE UN LIVRE VIA ID //
    ///////////////////////////////////////
    public function readById(Livre $readLivre)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM livre WHERE id_livre = :id_livre");
            $this->request->bindValue(":id_livre", $readLivre->getId_livre(), PDO::PARAM_INT);

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $livre = $this->request->fetch();

            // RETOUR DES RESULTATS
            return $livre;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ///////////////////////////////////////////
    // METHODE POUR LIRE UN LIVRE VIA STATUT //
    ///////////////////////////////////////////
    public function readByStatut(Livre $readLivre)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM livre WHERE statut = :statut");
            $this->request->bindValue(":statut", $readLivre->getStatut(), PDO::PARAM_BOOL);

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $livres = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $livres;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ///////////////////////////////////////
    // METHODE POUR LIRE TOUS LES LIVRES //
    ///////////////////////////////////////
    public function readAll()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM livre ORDER BY titre ASC");

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $livres = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $livres;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    /////////////////////////////////
    // METHODE POUR CREER UN LIVRE //
    /////////////////////////////////
    public function create(Livre $addLivre)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("INSERT INTO livre (titre, auteur, genre, annee, statut)
                VALUES (:titre, :auteur, :genre, :annee, :statut)");
            $this->request->bindValue(":titre", $addLivre->getTitre(), PDO::PARAM_STR);
            $this->request->bindValue(":auteur", $addLivre->getAuteur(), PDO::PARAM_STR);
            $this->request->bindValue(":genre", $addLivre->getGenre(), PDO::PARAM_STR);
            $this->request->bindValue(":annee", $addLivre->getAnnee(), PDO::PARAM_INT);
            $this->request->bindValue(":statut", $addLivre->getStatut(), PDO::PARAM_BOOL);

            // EXECUTION DE LA REQUETE SQL
            return $this->request->execute();

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ////////////////////////////////////
    // METHODE POUR MODIFIER UN LIVRE //
    ////////////////////////////////////
    public function update(Livre $majLivre)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("UPDATE livre SET
                titre = :titre,
                auteur = :auteur,
                genre = :genre,
                annee = :annee
                WHERE id_livre = :id_livre");
            $this->request->bindValue(":id_livre", $majLivre->getId_livre(), PDO::PARAM_INT);
            $this->request->bindValue(":titre", $majLivre->getTitre(), PDO::PARAM_STR);
            $this->request->bindValue(":auteur", $majLivre->getAuteur(), PDO::PARAM_STR);
            $this->request->bindValue(":genre", $majLivre->getGenre(), PDO::PARAM_STR);
            $this->request->bindValue(":annee", $majLivre->getAnnee(), PDO::PARAM_INT);

            // EXECUTION DE LA REQUETE SQL
            $execution = $this->request->execute();

            // VERIFICATION DE L'UPDATE
            if ($execution && $this->request->rowCount() > 0) {
                return true;  // Suppression réussie
            } else {
                return false; // Aucuns livres trouvés ou erreur dans l'exécution
            }

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

        ////////////////////////////////////
    // METHODE POUR MODIFIER UN LIVRE //
    ////////////////////////////////////
    public function updateStatut(Livre $majLivre)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("UPDATE livre SET
                statut = :statut
                WHERE id_livre = :id_livre");
            $this->request->bindValue(":id_livre", $majLivre->getId_livre(), PDO::PARAM_INT);
            $this->request->bindValue(":statut", $majLivre->getStatut(), PDO::PARAM_BOOL);

            // EXECUTION DE LA REQUETE SQL
            $execution = $this->request->execute();

            // VERIFICATION DE L'UPDATE
            if ($execution && $this->request->rowCount() > 0) {
                return true;  // Suppression réussie
            } else {
                return false; // Aucuns livres trouvés ou erreur dans l'exécution
            }

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    /////////////////////////////////////
    // METHODE POUR SUPPRIMER UN LIVRE //
    /////////////////////////////////////
    public function delete(Livre $delLivre)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("DELETE FROM livre WHERE id_livre = :id_livre");
            $this->request->bindValue(":id_livre", $delLivre->getId_livre(), PDO::PARAM_INT);

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