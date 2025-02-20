////////////////////////////////////////////////////////
// 
////////////////////////////////////////////////////////

const modalDelete = new bootstrap.Modal(document.querySelector("#modalDelete"));

import { tokenCreate } from "../tokenCreate.js";


//-----------------------------------------------//
// 
//-----------------------------------------------//
document.querySelectorAll("#btnDelete").forEach((btn) => {
    btn.addEventListener("click", () => {

        tokenCreate().then((token) => {
            const token = token;
            console.log(token);
        });

        modalDelete.show();

        // let id = btn.getAttribute("data-id");
        // fetch("index.php?controller=Utilisateur&action=delete",
        // {
        //     method: "POST",
        //     body: JSON.stringify({
        //         token: token,
        //         id: id,
        //     }),
        //     headers: {
        //         "Content-type": "application/json; charset=UTF-8",
        //     },
        // })
        //     .then((response) => response.json())
        //     .then((data) => {
        //         if (data.success) {
        //             console.log(data);
        //         }
        //     })
        //     .catch(error => {
        //         //console.error("Erreur:", error);
        //     });
    });
});