<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Entities;


///////////////////////////////
// CLASSE ET BDD UTILISATEUR //
///////////////////////////////
class User
{
    //-----------//
    // ATTRIBUTS //
    //-----------//
    private $id_utilisateur;
    private $prenom;
    private $nom;
    private $email;
    private $password;
    private $statut;
    private $token;
    private $token_expire;

    //---------------------------//
    // METHODES GETTER ET SETTER //
    //---------------------------//
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
        return $this;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function getToken_expire()
    {
        return $this->token_expire;
    }

    public function setToken_expire($token_expire)
    {
        $this->token_expire = $token_expire;
        return $this;
    }
}