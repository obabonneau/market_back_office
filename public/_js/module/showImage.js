///////////////////////////////////////////////////////////////////
// SCRIPT POUR LA PREVISUALISATION DE L'IMAGE DANS LE FORMULAIRE //
///////////////////////////////////////////////////////////////////

// SELECTION DES ELEMENTS DU DOM
const image = document.querySelector("#image");
const imageErreur = document.querySelector("#imageErreur");
const containerImage = document.querySelector("#containerImage");
const showImage = document.querySelector("#showImage");
const deleteImage = document.querySelector("#deleteImage");

// IMPORTATION DES FONCTIONS
import {
    validerImage
} from "../module/formCreate.js";


//---------------------------------------------//
// AFFICHAGE DE LA PREVISUALISATION DE L'IMAGE //
//---------------------------------------------//

// ECOUTEUR SUR LE CHANGEMENT DE L'IMAGE
image.addEventListener("change", () => {
    const isValid = validerImage(image, imageErreur);
    if (isValid) {

        // AFFICHAGE DE LA DIV CONTENANT L'IMAGE
        containerImage.classList.add("d-flex");
        containerImage.classList.remove("d-none");

        // AFFICHAGE DE L'IMAGE
        const lectureImage = new FileReader(); // Création d'une instance FileReader
        lectureImage.readAsDataURL(image.files[0]);   // Lecture de l'image avec la méthode readAsDataURL
        lectureImage.onload = (event) => {
            showImage.src = event.target.result; //  Affichage de l'image avec la propriété onload 
        }
    }
});


//-------------------------------------------//
// RETRAIT DE LA PREVISUALISATION DE L'IMAGE //
//-------------------------------------------//

// ECOUTEUR SUR LE BOUTON DE SUPPRESSION DE L'IMAGE
deleteImage.addEventListener("click", () => {

    // SUPPRESSION DE L'IMAGE
    showImage.src = "";
    image.value = "";

    // DESAFFICHAGE DE LA DIV CONTENANT L'IMAGE
    containerImage.classList.add("d-none");
    containerImage.classList.remove("d-flex");
})