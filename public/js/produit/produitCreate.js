//////////////////////////////////////////
// SCRIPT POUR LA CREATION D'UN PRODUIT //
//////////////////////////////////////////

// IMPORTATION DES MODULES
import { tokenCreate } from "../module/tokenCreate.js";
import { modalForm, modalFormTitle, modalFormToken } from "../module/modalForm.js";


// SELECTION DES ELEMENTS DU DOM
const listBtnCreate = document.querySelector("#listBtnCreate");
const idCategorie = document.querySelector("#id_categorie");


//-----------------------------------------------//
// AFFICHAGE DE LA MODAL DE CREATION D'UN PODUIT //
//-----------------------------------------------//
listBtnCreate.addEventListener("click", () => {

    // REQUETE DE LECTURE DE L'UTILISATEUR
    fetch("index.php?controller=Categorie&action=list")
        .then((response) => response.json())
        .then((result) => {
            if (result.data) {

                // MODIFICATION DU TITRE DE LA MODAL
                modalFormTitle.textContent = "Créer un produit";

                // CREATION DU TOKEN ET AFFICHAGE DANS LA MODAL
                tokenCreate().then((token) => {
                    modalFormToken.value = token;
                });

                // AFFICHAGE DES DONNEES DANS LA MODAL
                Object.keys(result.data).forEach((key) => {
                    const option = document.createElement("option");
                    option.value = result.data[key].id_categorie;
                    option.textContent = result.data[key].categorie;
                    idCategorie.appendChild(option);
                });

            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });

        // AFFICHAGE DE LA MODAL
        modalForm.show();
});

//-----------------------------------------//
// CREATION D'UN UTILISATEUR EN ASYNCHRONE //
//-----------------------------------------//
export function produitCreate(form) {
    
    // SELECTION DU TABLEAU
    const tableBody = document.querySelector("#tableBody");

    // RECUPERATION DES DONNEES DU FORMULAIRE
    const formData = new FormData(form);
    const categorie =  form.id_categorie.options[form.id_categorie.selectedIndex].textContent;
    const produit = form.produit.value;
    const marque = form.marque.value;
    const description = form.description.value;
    const prix = form.prix.value;

    // REQUETE DE CREATION
    fetch("index.php?controller=Produit&action=create",
        {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((result) =>
        {
            if (result.data) {
                console.log(result.data);

                // AJOUT DE LA NOUVELLE LIGNE DANS LE TABLEAU
                const tr = document.createElement("tr");
                tr.innerHTML = `<td class="text-start ps-3">${"image"}</td>
                                <td class="text-start ps-3">
                                    <span class="badge bg-secondary">${categorie}</span>
                                </td>
                                <td class="text-start ps-3">${produit}</td>
                                <td class="text-start ps-3">${marque}</td>
                                <td class="text-start ps-3">${description}</td>
                                <td class="text-start ps-3">${prix}</td>
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