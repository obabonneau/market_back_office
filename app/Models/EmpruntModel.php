<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Models;

// IMPORT DE CLASSES
use App\Core\DbConnect;
use App\Entities\Emprunt;
use PDO;
use PDOException;


//////////////////////////////////////
// CLASSE MODEL DE L'ENTITE EMPRUNT //
//////////////////////////////////////
class EmpruntModel extends DbConnect
{
    /////////////////////////////////////////
    // METHODE POUR LIRE UN EMPRUNT VIA ID //
    /////////////////////////////////////////
    public function readById(Emprunt $readEmprunt)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT emprunt.id_emprunt, emprunt.debut, emprunt.fin , utilisateur.id_utilisateur, utilisateur.prenom, utilisateur.nom, livre.id_livre, livre.titre
                FROM emprunt
                INNER JOIN utilisateur ON utilisateur.id_utilisateur = emprunt.id_utilisateur
                INNER JOIN livre ON livre.id_livre = emprunt.id_livre
                WHERE id_emprunt = :id_emprunt");
            $this->request->bindValue(":id_emprunt", $readEmprunt->getId_emprunt(), PDO::PARAM_INT);

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $emprunt = $this->request->fetch();

            // RETOUR DES RESULTATS
            return $emprunt;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }
    
    ///////////////////////////////////////////
    // METHODE POUR LIRE UN EMPRUNT VIA USER //
    ///////////////////////////////////////////
    public function readByUser(Emprunt $readEmprunt)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT emprunt.id_emprunt, emprunt.debut, emprunt.fin , livre.titre, livre.auteur, livre.genre, livre.annee
                FROM emprunt
                INNER JOIN livre ON emprunt.id_livre = livre.id_livre
                WHERE emprunt.id_utilisateur = :id_utilisateur
                ORDER BY emprunt.debut DESC");
            $this->request->bindValue(":id_utilisateur", $readEmprunt->getId_utilisateur(), PDO::PARAM_INT);

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $emprunts = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $emprunts;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    /////////////////////////////////////////
    // METHODE POUR LIRE TOUS LES EMPRUNTS //
    /////////////////////////////////////////
    public function readAll()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT emprunt.id_emprunt, emprunt.debut, emprunt.fin, utilisateur.prenom, utilisateur.nom, livre.id_livre, livre.titre
                FROM emprunt
                INNER JOIN utilisateur ON utilisateur.id_utilisateur = emprunt.id_utilisateur
                INNER JOIN livre ON livre.id_livre = emprunt.id_livre
                ORDER BY emprunt.fin IS NULL DESC, emprunt.debut DESC");
            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $emprunts = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $emprunts;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ///////////////////////////////////
    // METHODE POUR CREER UN EMPRUNT //
    ///////////////////////////////////
    public function create(Emprunt $addEmprunt)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("INSERT INTO emprunt (id_utilisateur, id_livre, debut, fin)
                VALUES (:id_utilisateur, :id_livre, :debut, :fin)");
            $this->request->bindValue(":id_utilisateur", $addEmprunt->getId_utilisateur(), PDO::PARAM_INT);
            $this->request->bindValue(":id_livre", $addEmprunt->getId_Livre(), PDO::PARAM_INT);
            $this->request->bindValue(":debut", $addEmprunt->getDebut(), PDO::PARAM_STR);
            $this->request->bindValue(":fin", $addEmprunt->getFin(), PDO::PARAM_STR);

            // EXECUTION DE LA REQUETE SQL
            return $this->request->execute();

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    //////////////////////////////////////
    // METHODE POUR MODIFIER UN EMPRUNT //
    //////////////////////////////////////
    public function update(Emprunt $majEmprunt)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("UPDATE emprunt SET
                id_emprunt = :id_emprunt,
                id_utilisateur = :id_utilisateur,
                id_livre = :id_livre,
                debut = :debut,
                fin = :fin
                WHERE id_emprunt = :id_emprunt");
            $this->request->bindValue(":id_emprunt", $majEmprunt->getId_emprunt(), PDO::PARAM_INT);
            $this->request->bindValue(":id_utilisateur", $majEmprunt->getId_utilisateur(), PDO::PARAM_INT);
            $this->request->bindValue(":id_livre", $majEmprunt->getId_livre(), PDO::PARAM_INT);
            $this->request->bindValue(":debut", $majEmprunt->getDebut(), PDO::PARAM_STR);
            $this->request->bindValue(":fin", $majEmprunt->getFin(), PDO::PARAM_STR);

            // EXECUTION DE LA REQUETE SQL
            $execution = $this->request->execute();

            // VERIFICATION DE L'UPDATE
            if ($execution && $this->request->rowCount() > 0) {
                return true;  // Suppression réussie
            } else {
                return false; // Aucuns emprunts trouvés ou erreur dans l'exécution
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    ///////////////////////////////////////
    // METHODE POUR RESTITUER UN EMPRUNT //
    ///////////////////////////////////////
    public function return(Emprunt $retEmprunt)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("UPDATE emprunt SET
                fin = :fin
                WHERE id_emprunt = :id_emprunt");
            $this->request->bindValue(":id_emprunt", $retEmprunt->getId_emprunt(), PDO::PARAM_INT);
            $this->request->bindValue(":fin", $retEmprunt->getFin(), PDO::PARAM_STR);
    
            // EXECUTION DE LA REQUETE SQL
            return $this->request->execute();
        
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ///////////////////////////////////////
    // METHODE POUR SUPPRIMER UN EMPRUNT //
    ///////////////////////////////////////
    public function delete(Emprunt $delEmprunt)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("DELETE FROM emprunt WHERE id_emprunt = :id_emprunt");
            $this->request->bindValue(":id_emprunt", $delEmprunt->getId_emprunt(), PDO::PARAM_INT);

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