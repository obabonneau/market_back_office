// RECUPERATION DES DONNEES DANS LE DOM
const image = document.getElementById('picture');
const imageNom = document.getElementById("imageNom");
const imageVisualisation = document.getElementById("imageVisualisation");

const boutonChoisir = document.querySelector(".boutonChoisir");
const boutonRetirer = document.querySelector(".boutonRetirer");

// AU CHARGEMENT D'UNE IMAGE, ON AFFICHE LA PREVISUALISATION
image.addEventListener("change", () => {
    if (image.files.length > 0) {

        // PREVISUALISATION DE L'IMAGE
        const file = image.files[0]; // Récupération de l'image
        const reader = new FileReader(); // Création d'une instance FileReader
        reader.readAsDataURL(file);   // Lecture de l'image avec la méthode readAsDataURL
        reader.onload = function (e) {
            imageVisualisation.src = e.target.result; //  Affichage de l'image avec la propriété onload (Resultat transmis à imageVisualisation.src)        
        };             

        // AFFICHAGE DU NOM DE l'IMAGE
        imageNom.textContent = image.files[0].name;

        // MODIFICATION DES BOUTONS
        boutonChoisir.style.display = "none";
        boutonRetirer.style.display = "block";
    }
})

// AU CLICK, ON RETIRE LA PREVISUALISATION
boutonRetirer.addEventListener("click", () => {

    // REINITIALISATION DE L'IMAGE PAR DEFAUT
    image.value = "";
    imageNom.textContent = "Aucun fichier choisi";
    imageVisualisation.src = "images/default.png";

    // MODIFICATION DES BOUTONS
    boutonChoisir.style.display = "block";
    boutonRetirer.style.display = "none";
})