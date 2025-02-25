<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Entities;


/////////////////
// CLASSE MAIL //
/////////////////
class Mail
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    private $nom;
    private $prenom;
    private $email;
    private $token;

    ///////////////////////////////
    // METHODES GETTER ET SETTER //
    ///////////////////////////////

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;

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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

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
}