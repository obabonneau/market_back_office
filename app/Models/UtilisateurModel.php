<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Models;

// IMPORT DE CLASSES
use App\Core\DbConnect;
use App\Entities\Utilisateur;
use PDO;
use PDOException;


//////////////////////////////////////////
// CLASSE MODEL DE L'ENTITE UTILISATEUR //
//////////////////////////////////////////
class UtilisateurModel extends DbConnect
{
    //////////////////////////////////////
    // METHODE POUR LIRE UN UTILISATEUR //
    //////////////////////////////////////
    public function readByID(Utilisateur $readUtilisateur)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM com_utilisateur WHERE id_utilisateur = :id_utilisateur");
            $this->request->bindValue(":id_utilisateur", $readUtilisateur->getId_utilisateur(), PDO::PARAM_INT);

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $utilisateur = $this->request->fetch();

            // RETOUR DU RESULTAT
            return $utilisateur;

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    //////////////////////////////////////
    // METHODE POUR LIRE UN UTILISATEUR //
    //////////////////////////////////////
    public function readByEmail(Utilisateur $readUtilisateur)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM com_utilisateur WHERE email = :email");
            $this->request->bindValue(":email", $readUtilisateur->getEmail(), PDO::PARAM_STR);

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $utilisateur = $this->request->fetch();

            // RETOUR DU RESULTAT
            return $utilisateur;

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    //////////////////////////////////////
    // METHODE POUR LIRE UN UTILISATEUR //
    //////////////////////////////////////
    public function readByToken(Utilisateur $readUtilisateur)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM com_utilisateur WHERE token = :token");
            $this->request->bindValue(":token", $readUtilisateur->getToken(), PDO::PARAM_STR);

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE
            $utilisateur = $this->request->fetch();

            // RETOUR DU RESULTAT
            return $utilisateur;

        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ////////////////////////////////////////
    // METHODE POUR LIRE LES UTILISATEURS //
    ////////////////////////////////////////
    public function readAll()
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("SELECT * FROM com_utilisateur ORDER BY prenom ASC");

            // EXECUTION DE LA REQUETE SQL
            $this->request->execute();

            // FORMATAGE DU RESULTAT DE LA REQUETE EN TABLEAU
            $utilisateurs = $this->request->fetchAll();

            // RETOUR DES RESULTATS
            return $utilisateurs;
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ///////////////////////////////////////
    // METHODE POUR CREER UN UTILISATEUR //
    ///////////////////////////////////////
    public function create(Utilisateur $addUtilisateur)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("INSERT INTO com_utilisateur (prenom, nom, email, password, statut)
                VALUES (:prenom, :nom, :email, :password, :statut)");
            $this->request->bindValue(":prenom", $addUtilisateur->getPrenom(), PDO::PARAM_STR);
            $this->request->bindValue(":nom", $addUtilisateur->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(":email", $addUtilisateur->getEmail(), PDO::PARAM_STR);
            $this->request->bindValue(":password", password_hash($addUtilisateur->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);
            $this->request->bindValue(":statut", $addUtilisateur->getStatut(), PDO::PARAM_STR);

            // EXECUTION DE LA REQUETE SQL ET RETOUR DE L'EXECUTION
            return $this->request->execute();

        } catch (PDOException $e) {          
            if ($e->errorInfo[1] == 1062) {
                return "emailExistant";
            } 
            //echo $e->getMessage();
            //die;
        }
    }

    //////////////////////////////////////////
    // METHODE POUR MODIFIER UN UTILISATEUR //
    //////////////////////////////////////////
    public function update(Utilisateur $majUtilisateur)
    {
        try {
            // CONSTRUCTION DE LA REQUETE EN FONCTION DU PASSWORD
            $sql = "UPDATE com_utilisateur SET
                prenom = :prenom,
                nom = :nom,
                email = :email,
                statut = :statut";

            if ($majUtilisateur->getPassword() != "") {
                $sql .= ", password = :password";
            }

            $sql .= " WHERE id_utilisateur = :id_utilisateur";

            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare($sql);
            $this->request->bindValue(":id_utilisateur", $majUtilisateur->getId_utilisateur(), PDO::PARAM_INT);
            $this->request->bindValue(":prenom", $majUtilisateur->getPrenom(), PDO::PARAM_STR);
            $this->request->bindValue(":nom", $majUtilisateur->getNom(), PDO::PARAM_STR);
            $this->request->bindValue(":email", $majUtilisateur->getEmail(), PDO::PARAM_STR);
            $this->request->bindValue(":statut", $majUtilisateur->getStatut(), PDO::PARAM_STR);

            if ($majUtilisateur->getPassword() != "") {
                $this->request->bindValue(":password", password_hash($majUtilisateur->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);
            }

            // EXECUTION DE LA REQUETE SQL
            $execution = $this->request->execute();

            // VERIFICATION DE L'UPDATE
            if ($execution && $this->request->rowCount() > 0) {
                return true;  // MAJ réussie
            } else {
                return false; // Aucun utilisateur trouvé ou erreur dans l'exécution
            }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    ///////////////////////////////////////
    // METHODE POUR MODIFIER UN PASSWORD //
    ///////////////////////////////////////
    public function updateToken(Utilisateur $majUtilisateur)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("UPDATE com_utilisateur SET
                token = :token,
                token_expire = :token_expire
                WHERE email = :email");

            // PREPARATION DE LA REQUETE SQL
            $this->request->bindValue(":email", $majUtilisateur->getEmail(), PDO::PARAM_STR);
            $this->request->bindValue(":token", $majUtilisateur->getToken(), PDO::PARAM_STR);
            $this->request->bindValue(":token_expire", $majUtilisateur->getToken_expire(), PDO::PARAM_STR);

            // EXECUTION DE LA REQUETE SQL ET RETOUR DE L'EXECUTION
            return $this->request->execute();
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    //////////////////////////////////
    // METHODE POUR MODIFIER UN password //
    //////////////////////////////////
    public function updatePassword(Utilisateur $majUtilisateur)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("UPDATE com_utilisateur SET
                password = :password,
                token = :token,
                token_expire = :token_expire
                WHERE email = :email");

            // PREPARATION DE LA REQUETE SQL
            $this->request->bindValue(":email", $majUtilisateur->getEmail(), PDO::PARAM_STR);
            $this->request->bindValue(":password", password_hash($majUtilisateur->getPassword(), PASSWORD_DEFAULT), PDO::PARAM_STR);
            $this->request->bindValue(":token", $majUtilisateur->getToken(), PDO::PARAM_STR);
            $this->request->bindValue(":token_expire", $majUtilisateur->getToken_expire(), PDO::PARAM_STR);

            // EXECUTION DE LA REQUETE SQL ET RETOUR DE L'EXECUTION
            return $this->request->execute();
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }

    ///////////////////////////////////////////
    // METHODE POUR SUPPRIMER UN UTILISATEUR //
    ///////////////////////////////////////////
    public function delete(Utilisateur $delUtilisateur)
    {
        try {
            // PREPARATION DE LA REQUETE SQL
            $this->request = $this->connection->prepare("DELETE FROM com_utilisateur WHERE id_utilisateur = :id_utilisateur");
            $this->request->bindValue(":id_utilisateur", $delUtilisateur->getId_utilisateur(), PDO::PARAM_INT);

            // EXECUTION DE LA REQUETE SQL
            $execution = $this->request->execute();

            // VERIFICATION DE LA SUPPRESSION
            if ($execution && $this->request->rowCount() > 0) {
                return true;  // Suppression réussie
            } else {
                return false; // Aucun utilisateur trouvé ou erreur dans l'exécution
            }
            
        } catch (PDOException $e) {
            //echo $e->getMessage();
            //die;
        }
    }
}