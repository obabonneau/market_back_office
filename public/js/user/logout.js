/////////////////////////////////////////////////
// SCRIPT POUR LA DECONNEXION DE L'UTILISATEUR //
/////////////////////////////////////////////////

// SELECTION DE L'ELEMENT DU DOM
const modalLogoutBtn = document.querySelector("#modalLogoutBtn");


//---------------------------------------//
// DECONNEXION DE L'UTILISATEUR AU CLICK //
//---------------------------------------//
modalLogoutBtn.addEventListener("click", () => {

    // REQUETE POUR LA DECONNEXION DE L'UTILISATEUR
    fetch("index.php?controller=User&action=logout")
        .then((response) => response.json())
        .then((result) => {
            if (result.data) { // Si la requête est true

                // REDIRECTION VERS LA PAGE D'ACCUEIL
                window.location.href = "index.php"; 
            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });
});