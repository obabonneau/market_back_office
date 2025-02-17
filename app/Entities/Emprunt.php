<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Entities;


///////////////////////////
// CLASS ET BDD EMPRUNTS //
///////////////////////////
class Emprunt
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    private $id_emprunt;
    private $id_livre;
    private $id_utilisateur;
    private $debut;
    private $fin;

    ///////////////////////////////
    // METHODES GETTER ET SETTER //
    ///////////////////////////////
    public function getId_emprunt()
    {
        return $this->id_emprunt;
    }

    public function setId_emprunt($id_emprunt)
    {
        $this->id_emprunt = $id_emprunt;

        return $this;
    }

    public function getId_livre()
    {
        return $this->id_livre;
    }

    public function setId_livre($id_livre)
    {
        $this->id_livre = $id_livre;

        return $this;
    }

    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getDebut()
    {
        return $this->debut;
    }

    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin()
    {
        return $this->fin;
    }

    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }
}