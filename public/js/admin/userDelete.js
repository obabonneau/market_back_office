//////////////////////////////////////////
// SCRIPT POUR SUPPRIMER UN UTILISATEUR //
//////////////////////////////////////////

// SELECTION DES ELEMENTS DU DOM
const listBtnsDelete = document.querySelectorAll("#listBtnDelete");
const modalDelete = new bootstrap.Modal(document.querySelector("#modalDelete"), {
    backdrop: "static" // ou 'true'/'false'
});
const modalDeleteToken = document.querySelector("#modalDeleteToken");
const modalDeleteId = document.querySelector("#modalDeleteId");
const modalDeleteBtn = document.querySelector("#modalDeleteBtn");

// IMPORTATION DES MODULES
import { tokenCreate } from "../module/tokenCreate.js";


//-------------------------------------------------------//
// AFFICHAGE DE LA MODAL DE SUPPRESSION D'UN UTILISATEUR //
//-------------------------------------------------------//
listBtnsDelete.forEach((listBtnDelete) => {
    listBtnDelete.addEventListener("click", () => {

        // RECUPERATION DE L'ID ET AFFICHAGE DANS LA MODAL
        const id = listBtnDelete.getAttribute("data-id");
        modalDeleteId.value = id;

        // CREATION DU TOKEN ET AFFICHAGE DANS LA MODAL
        tokenCreate().then((token) => {        
            modalDeleteToken.value = token;
        });

        // AFFICHAGE DE LA MODAL
        modalDelete.show();
    });
});


//--------------------------------------------//
// SUPPRESSION D'UN UTILISATEUR EN ASYNCHRONE //
//--------------------------------------------//
modalDeleteBtn.addEventListener("click", () => {

    // RECUPERATION DES DONNEES DANS LA MODAL
    const token = modalDeleteToken.value;
    const id = modalDeleteId.value;

    // REQUETE DE SUPPRESSION
    fetch("index.php?controller=Admin&action=deleteUser",
        {
            method: "POST",
            body: JSON.stringify({
                token: token,
                id: id,
            }),
            headers: {
                "Content-type": "application/json; charset=UTF-8",
            },
        })
        .then((response) => response.json())
        .then((result) => {
            if (result.data) { // Si la requête est true

                // SUPPRESSION DE LA LIGNE DU TABLEAU
                const tr = document.querySelector("#listTr" + id);
                tr.classList.add("table-danger", "border-3", "border-danger");
                setTimeout(() => {
                    tr.remove();
                }, 1000);
                
                // FERMETURE DE LA MODAL
                modalDelete.hide();
            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });
});