/////////////////////////////////////////////////////////
// FONCTION POUR AJOUTER UN LIVRE DANS LA BIBLIOTHEQUE //
/////////////////////////////////////////////////////////
export function userAdd(form) {
    
    // SELECTION DU TABLEAU
    const tableBody = document.querySelector("#tableBody");

    // RECUPERATION DES DONNEES DU FORMULAIRE
    const formData = new FormData(form);
    const prenom = form.prenom.value;
    const nom = form.nom.value;
    const email = form.email.value;
    const statut = form.statut.value;

    // if (titre === "" || auteur === "" || genre === "" || annee === "")

    fetch("index.php?controller=Utilisateur&action=create",
        {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((data) =>
        {
            if (data) {
                console.log(data);

                // AJOUT DE LA NOUVELLE LIGNE DANS LE TABLEAU
                const tr = document.createElement("tr");
                tr.innerHTML = `<td class="text-start ps-3">${prenom}</td>
                                <td class="text-start ps-3">${nom}</td>
                                <td class="text-start ps-3">${email}</td>
                                <td>
                                    <span class="badge bg-secondary">${statut}</span>
                                </td>
                                <td class="text-center p-2">
                                    <a class="btn btn-sm btn-warning text-white" href=""
                                        title="Modifier">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger text-white" href=""
                                        title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>`;
                tableBody.insertBefore(tr, tableBody.firstChild);
                tr.classList.add("table-success", "border-3", "border-success");
                setTimeout(() => {
                    tr.classList.remove("table-success", "border-3", "border-success");
                }, 5000);        
            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });
}