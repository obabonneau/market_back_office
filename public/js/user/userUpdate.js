////////////////////////////////////////////////////////
// 
////////////////////////////////////////////////////////

const prenom = document.querySelector("#prenom");
const nom = document.querySelector("#nom");
const email = document.querySelector("#email");
const password = document.querySelector("#password");
const statut = document.querySelector("#statut");

import { modalForm, modalFormToken, modalFormId, modalFormTitle } from "../module/modalForm.js";
import { tokenCreate } from "../module/tokenCreate.js";

//-----------------------------------------------//
// 
//-----------------------------------------------//
document.querySelectorAll("#btnListUpdate").forEach((btn) => {
    btn.addEventListener("click", () => {
        const id = btn.getAttribute("data-id");
        fetch("index.php?controller=Admin&action=readUserById",
            {
                method: "POST",
                body: JSON.stringify({
                    id_utilisateur: id,
                }),
                headers: {
                    "Content-type": "application/json; charset=UTF-8",
                },
            })
            .then((response) => response.json())
            .then((result) => {
                if (result.data) {

                    // MODIFICATION DU TITRE DE LA MODAL
                    modalFormTitle.textContent = "Modifier un utilisateur";

                    // CREATION DU TOKEN ET AFFICHAGE DANS LA MODAL
                    tokenCreate().then((token) => {        
                        modalFormToken.value = token;
                    });

                    modalFormId.value = result.data.id_utilisateur;
                    prenom.value = result.data.prenom;
                    nom.value= result.data.nom;
                    email.value = result.data.email;
                    password.setAttribute("placeholder", "Laisser vide pour ne pas modifier le mot de passe");
                    result.data.statut === "admin" ? statut.value = "admin" : statut.value = "user";





                }
            })

        // AFFICHAGE DE LA MODAL
        modalForm.show();
    });
});