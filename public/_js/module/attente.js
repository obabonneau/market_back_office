//const image = document.querySelector("#image");

//const imageError = document.querySelector("#imageError");

//const containerImage = document.querySelector("#containerImage");
//const showImage = document.querySelector("#showImage");


// IMPORTATION DES FONCTIONS
//import {
//    validerImage
//} from "../../_js/module/formCreate.js";

//import {
//   addCreation
//} from "../../_js/module/addCreation.js";

    // VALIDATION DE L'IMAGE
    //if (image.files.length == 0) {
     //   afficherErreur(imageErreur, "Veuillez sélectionner une image.");
     //   isValid = false;
    //} else {
    //
        // SI FICHIER EXISTANT, ON VERIFIE QU'IL S'AGIT D'UNE IMAGE
    //    if (!validerImage(image, imageErreur)) {
    //        isValid = false;
    //    };
    //}

    // VALIDATION DE LA DATE
    //const dateSaisie = new Date(jour.value).toLocaleDateString();
    //const dateDuJour = new Date().toLocaleDateString();
    //if (jour.value == "" || dateSaisie < dateDuJour) {
    //    afficherErreur(jourErreur, "La date doit être supérieure à la date actuelle.");
    //    isValid = false;
    //} else {
    //    effacerErreur(jourErreur);
    //}


    
// ECOUTER SUR LE CHAMP DE LA DATE
// jour.addEventListener("input", () => {
//     const dateSaisie = new Date(jour.value).toLocaleDateString();
//     const dateDuJour = new Date().toLocaleDateString();

//     if (jour.value != "" && dateSaisie >= dateDuJour) {
//         effacerErreur(jourErreur);
//     }
// });

// ECOUTEUR SUR LE CHAMP DE L'IMAGE
// image.addEventListener("input", () => {
//     if (image.files.length > 0) {
//         effacerErreur(imageErreur);
//     }
//});

    // RECUPERATION DE LA CATEGORIE SELECTIONNEE
   //const nomCategorie = categorie.options[categorie.selectedIndex];

   <td>
                                    <img class="rounded-3" style="max-width: 100px; max-height: 100px;" src="images/${data.image}" alt="Image de l'évènement">
                                </td>

                                <td>${new Date(jour.value).toLocaleDateString()}</td>