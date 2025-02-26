<?php

// DEFINITION DE L'ESPACE DE NOM
namespace App\Core;

///////////////////////////////////////
// CLASSE POUR LA GESTION DES IMAGES //
///////////////////////////////////////
class Picture
{

    //-----------//
    // CONSTANTE //
    //-----------//
    const IMAGE_ALLOW = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png", "gif" => "image/gif"]; // Tableau associatif des formats autorisés

    //----------------------------------// 
    // METHODE POUR CONTROLER UNE IMAGE //
    //----------------------------------//
    public function controle($picture)
    {
        // VERIFICATION DE L'EXTENSION, ON LIMITE AUX FORMATS JPG, JPEG, PNG et GIF
        $formatImage = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION)); //pathinfo : cette méthode extrait uniquement l'extension du fichier après le dernier point dans le nom de fichier.
        
        if (!array_key_exists($formatImage, self::IMAGE_ALLOW)) { // in_array : cette méthode permet de vérifier si une valeur existe dans un tableau.
            return "Seuls les images JPG, JPEG, PNG & GIF sont autorisés !";
        }

        // VERIFICATION DU TYPE MIME
        // La vérification du type MIME, basée sur le contenu réel du fichier permet de confirmer que le fichier est conforme à son extension.
        $formatMime = mime_content_type($picture["tmp_name"]); //mime_content_type : cette méthode permet de récupérer le type MIME du fichier.
        
        if (!in_array($formatMime, self::IMAGE_ALLOW)) {
            return "Le fichier n'est pas une image !";
        }

        // VERIFICATION DE LA TAILLE DE L'IMAGE (5Mo)
        if ($picture["size"] > 5000000) {
            return "Votre image dépasse les 5Mo !";
        }

        // MESSAGE DE CONFIRMATION
        return "OK";
    }

    //////////////////////////////////// 
    // METHODE POUR UPLODER UNE IMAGE //
    ////////////////////////////////////
    public function upload($pictureDir, $pictureName, $picture)
    {
        // CHEMIN COMPLET POUR L'ENREGISTREMENT DE L'IMAGE
        $pictureDir .= $pictureName;    

        // VERIFICATION DE L'EXISTENCE DU FICHIER
        if (file_exists($pictureDir)) {
            return "Le fichier existe déjà !";
        }
        
        // TELECHARGEMENT DU FICHIER
        if (move_uploaded_file($picture["tmp_name"], $pictureDir)) {
            return "OK";
        }

        // MESSAGE D'ERREUR
        return "Il y a eu une erreur lors du téléchargement de votre fichier !";
    }

    ////////////////////////////////////// 
    // METHODE POUR SUPPRIMER UNE IMAGE //
    //////////////////////////////////////
    // public function delete($dossierDestination, $nomFichier)
    // {
    //     // CHEMIN COMPLET DE LA PHOTO A SUPPRIMER
    //     $cheminComplet = $dossierDestination . $nomFichier;

    //     // VERIFICATION DE L'EXISTANCE DE LA PHOTO
    //     if (file_exists($cheminComplet)) {

    //         // SUPPRESSION DE LA PHOTO
    //         if (unlink($cheminComplet)) {
    //             $message = "ok";
    //         } else {
    //             $message = "impossible de supprimer l'image !";
    //         }
    //     } else {
    //         $message = "l'image n'existe pas !";
    //     }
    //     return $message;
    // }
}