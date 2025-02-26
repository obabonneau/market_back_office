<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Controllers;

// IMPORT DE CLASSES
use App\Controllers\Controller;
use App\Entities\Categorie;
use App\Models\CategorieModel;


/////////////////////////////////////////////
// CLASSE CONTROLEUR DE L'ENTITE CATEGORIE //
/////////////////////////////////////////////
class CategorieController extends Controller
{
    //------------------------------------//
    // METHODE POUR LISTER LES CATEGORIES //
    //------------------------------------//
    // Pas de conditonnment : categories existants
    public function list()
    {
        // LECTURE DE TOUS LES CATEGORIES
        $readCategorieModel = new CategorieModel();        
        $categories = $readCategorieModel->readAll();
    
        // ENVOI VERS LE CONTROLEUR PRINCIPAL "ASYNCHRONE"

        $this->myJsonEncode($categories, "");
   }
}