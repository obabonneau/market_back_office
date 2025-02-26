//------------------------------------------------//
// SCRIPT POUR LA GESTION DE L'IMAGE D'UN PRODUIT //
//------------------------------------------------//

// DECLARATION DES CONSTANTES
const imageAllow = {
    "jpg": "image/jpg",
    "jpeg": "image/jpeg",
    "png": "image/png",
    "gif": "image/gif"
};
const imageSize = 2 * 1024 * 1024;

// SELECTION DES ELEMENTS DU DOM
const image = document.querySelector("#image");
const imageShow = document.querySelector("#imageShow");
const imageDelete = document.querySelector("#imageDelete");


//-------------------------------------------//
// CHARGEMENT DE L'IMAGE EN PREVISUALISATION //
//-------------------------------------------//
image.addEventListener("change", () => {
    if (image.files.length > 0) {

        // PREVISUALISATION DE L'IMAGE
        const file = image.files[0]; // Récupération de l'image
        const reader = new FileReader(); // Création d'une instance FileReader
        reader.readAsDataURL(file);   // Lecture de l'image avec la méthode readAsDataURL
        reader.onload = function (e) {
            imageShow.src = e.target.result; //  Affichage de l'image avec la propriété onload (Resultat transmis à imageVisualisation.src)        
        };             
    }
})

//--------------------------------------------//
// SUPPRESSION DE L'IMAGE EN PREVISUALISATION //
//--------------------------------------------//
imageDelete.addEventListener("click", () => {

    // REINITIALISATION DE L'IMAGE PAR DEFAUT
    image.value = "";
    imageShow.src = "../public/img/nopicture.jpg";
})

//---------------------------------//
// FONCTION POUR VALIDER UNE IMAGE //
//---------------------------------//
export function imageCtrl(image) {
    
    // VERIFICATION DE L'EXTENSION  
    const imageExt = image.files[0].name.toLowerCase().split(".").pop(); // Récupération de l'extension
    if (!Object.keys(imageAllow).includes(imageExt)) {
        return "Seuls les fichiers jpg, jpeg, png, gif sont acceptés."
    }

    // VERIFICATION DU TYPE MIME
    if (!Object.values(imageAllow).includes(image.files[0].type)) {
        return "Le fichier n'est pas une image originale."
    }

    // VERIFICATION DE LA TAILLE
    if (image.files[0].size > imageSize) {
        return "Le fichier est trop volumineux. La taille maximale est de 2 Mo."
    }

    return "OK";
}