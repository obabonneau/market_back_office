////////////////////////////////////////////////////////
// 
////////////////////////////////////////////////////////

const modalDelete = new bootstrap.Modal(document.querySelector("#modalDelete"));
const modalDeleteToken = document.querySelector("#modalDeleteToken");
const modalDeleteId = document.querySelector("#modalDeleteId");
//const tr = document.querySelector("#tr");
 
import { tokenCreate } from "../tokenCreate.js";

//-----------------------------------------------//
// 
//-----------------------------------------------//
document.querySelectorAll("#btnListDelete").forEach((btn) => {
    btn.addEventListener("click", () => {

        // RECUPERATION DE L'ID
        const id = btn.getAttribute("data-id");
        modalDeleteId.value = id;

        // CREATION DU TOKEN
        tokenCreate().then((token) => {        
            modalDeleteToken.value = token;
        });

        // AFFICHAGE DE LA MODAL
        modalDelete.show();
    });
});

document.querySelector("#modalDeleteBtn").addEventListener("click", () => {
    const token = modalDeleteToken.value;
    const id = modalDeleteId.value;
    fetch("index.php?controller=Utilisateur&action=delete",
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
        .then((data) => {
            if (data.success) {

                const tr = document.querySelector("#trList" + id);
                tr.classList.add("table-danger", "border-3", "border-danger");
                setTimeout(() => {
                    tr.remove();
                }, 2000);
                
                // FERMETURE DE LA MODAL
                modalDelete.hide();
            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });
});