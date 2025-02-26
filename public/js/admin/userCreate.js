//////////////////////////////////////////////
// SCRIPT POUR LA CREATION D'UN UTILISATEUR //
//////////////////////////////////////////////

// SELECTION DES ELEMENTS DU DOM
const password = document.querySelector("#password");

// IMPORTATION DES MODULES
import { tokenCreate } from "../module/tokenCreate.js";
import { modalForm, modalFormTitle, modalFormToken } from "../module/modalForm.js";


// SELECTION DES ELEMENTS DU DOM
const listBtnCreate = document.querySelector("#listBtnCreate");


//----------------------------------------------------//
// AFFICHAGE DE LA MODAL DE CREATION D'UN UTILISATEUR //
//----------------------------------------------------//
listBtnCreate.addEventListener("click", () => {

        // MODIFICATION DU TITRE DE LA MODAL
        modalFormTitle.textContent = "Créer un utilisateur";

        // CREATION DU TOKEN ET AFFICHAGE DANS LA MODAL
        tokenCreate().then((token) => {        
            modalFormToken.value = token;
        });

        password.setAttribute("placeholder", "Entrer votre mot de passe");

        // AFFICHAGE DE LA MODAL
        modalForm.show();
});


//-----------------------------------------//
// CREATION D'UN UTILISATEUR EN ASYNCHRONE //
//-----------------------------------------//
export function userCreate(form) {
    
    // SELECTION DU TABLEAU
    const tableBody = document.querySelector("#tableBody");

    // RECUPERATION DES DONNEES DU FORMULAIRE
    const formData = new FormData(form);
    const prenom = form.prenom.value;
    const nom = form.nom.value;
    const email = form.email.value;
    const statut = form.statut.value;

    // REQUETE DE CREATION
    fetch("index.php?controller=Admin&action=createUser",
        {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((result) =>
        {
            if (result.data) {

                // AJOUT DE LA NOUVELLE LIGNE DANS LE TABLEAU
                const tr = document.createElement("tr");
                tr.innerHTML = `<td class="text-start ps-3">${prenom}</td>
                                <td class="text-start ps-3">${nom}</td>
                                <td class="text-start ps-3">${email}</td>
                                <td>
                                    <span class="badge bg-secondary">${statut}</span>
                                </td>
                                <td class="text-center p-2">
                                    <button id="listBtnUpdate" class="btn btn-sm btn-warning text-white" data-id=""
                                        title="Modifier">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button id="listBtnDelete" class="btn btn-sm btn-danger text-white" data-id=""
                                        title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>`;
                tableBody.insertBefore(tr, tableBody.firstChild);
                tr.classList.add("table-success", "border-3", "border-success");
                setTimeout(() => {
                    tr.classList.remove("table-success", "border-3", "border-success");
                }, 2000); 
            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });
}