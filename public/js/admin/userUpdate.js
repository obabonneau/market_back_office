//////////////////////////////////////////////////
// SCRIPT POUR LA MODIFICATION D'UN UTILISATEUR //
//////////////////////////////////////////////////

// SELECTION DES ELEMENTS DU DOM
const listBtnsUpdate = document.querySelectorAll("#listBtnUpdate");
const prenom = document.querySelector("#prenom");
const nom = document.querySelector("#nom");
const email = document.querySelector("#email");
const password = document.querySelector("#password");
const statut = document.querySelector("#statut");

// IMPORTATION DES MODULES
import { tokenCreate } from "../module/tokenCreate.js";
import { modalForm, modalFormToken, modalFormId, modalFormTitle } from "../module/modalForm.js";


//--------------------------------------------------------//
// AFFICHAGE DE LA MODAL DE MODIFICATION D'UN UTILISATEUR //
//--------------------------------------------------------//
listBtnsUpdate.forEach((listBtnUpdate) => {
    listBtnUpdate.addEventListener("click", () => {
        const id = listBtnUpdate.getAttribute("data-id");

        // REQUETE DE LECTURE DE L'UTILISATEUR
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

                    // AFFICHAGE DES DONNEES DANS LA MODAL
                    modalFormId.value = result.data.id_utilisateur;
                    prenom.value = result.data.prenom;
                    nom.value= result.data.nom;
                    email.value = result.data.email;
                    password.setAttribute("placeholder", "Laisser vide pour ne pas modifier le mot de passe");
                    result.data.statut === "admin" ? statut.value = "admin" : statut.value = "user";
                }
            })
            .catch(error => {
                //console.error("Erreur:", error);
            });

        // AFFICHAGE DE LA MODAL
        modalForm.show();
    });
});


//--------------------------------------------//
// miSE A JOUT D'UN UTILISATEUR EN ASYNCHRONE //
//--------------------------------------------//
export function userUpdate(form) {

    // RECUPERATION DES DONNEES DU FORMULAIRE
    const formData = new FormData(form);
    const id = form.id_utilisateur.value;
    const prenom = form.prenom.value;
    const nom = form.nom.value;
    const email = form.email.value;
    const statut = form.statut.value;

    // REQUETE DE CREATION
    fetch("index.php?controller=Admin&action=updateUser",
        {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((result) =>
        {
            if (result.data) {

                // MISE A JOUR DE LA LIGNE DANS LE TABLEAU
                const tr = document.querySelector("#listTr" + id);
                tr.innerHTML = `<td class="text-start ps-3">${prenom}</td>
                                <td class="text-start ps-3">${nom}</td>
                                <td class="text-start ps-3">${email}</td>
                                <td>
                                    <span class="badge bg-secondary">${statut}</span>
                                </td>
                                <td class="text-center p-2">
                                    <button id="listBtnUpdate" class="btn btn-sm btn-warning" data-id="${id}" 
                                        title="Modifier">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button id="listBtnDelete" class="btn btn-sm btn-danger" data-id="${id}"
                                        title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>`;
                tr.classList.add("table-warning", "border-3", "border-warning");
                setTimeout(() => {
                    tr.classList.remove("table-warning", "border-3", "border-warning");
                }, 2000); 
            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });
}