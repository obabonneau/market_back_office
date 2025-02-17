<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Entities;


/////////////////////////
// CLASSE ET BDD LIVRE //
/////////////////////////
class Livre
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    private $id_livre;
    private $titre;
    private $auteur;
    private $genre;
    private $annee;
    private $statut;

    ///////////////////////////////
    // METHODES GETTER ET SETTER //
    ///////////////////////////////
    public function getId_livre()
    {
        return $this->id_livre;
    }

    public function setId_livre($id_livre)
    {
        $this->id_livre = $id_livre;

        return $this;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function setAnnee($annee)
    {
        $this->annee = $annee;

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
}