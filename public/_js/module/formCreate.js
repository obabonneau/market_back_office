///////////////////////////////////////////////
// FONCTIONS EXPLOITEES PAR FORMCREATE___.JS //
///////////////////////////////////////////////

// DECLARATION DES CONSTANTES
const imageAutorise = {
    "jpg": "image/jpg",
    "jpeg": "image/jpeg",
    "png": "image/png",
    "gif": "image/gif"
};
const imageTailleAutorise = 2 * 1024 * 1024;





//-------------------------------//
// FONCTION POUR VALIDER L'IMAGE //
//-------------------------------//
export function validerImage(image, imageErreur) {
    
    // VERIFICATION DE L'EXTENSION  
    const imageExtension = image.files[0].name.toLowerCase().split(".").pop(); // Récupération de l'extension
    if (!Object.keys(imageAutorise).includes(imageExtension)) {
        afficherErreur(imageErreur, "Seuls les fichiers jpg, jpeg, png, gif sont acceptés.");
        return false;
    }

    // VERIFICATION DU TYPE MIME
    if (!Object.values(imageAutorise).includes(image.files[0].type)) {
        afficherErreur(imageErreur, "Le fichier n'est pas une image originale.");
        return false;
    }

    // VERIFICATION DE LA TAILLE
    if (image.files[0].size > imageTailleAutorise) {
        afficherErreur(imageErreur, "Le fichier est trop volumineux. La taille maximale est de 2 Mo.");
        return false;
    }

    effacerErreur(imageErreur);
    return true;
}