/////////////////////////////////////////////////////////
// FONCTION POUR AJOUTER UN LIVRE DANS LA BIBLIOTHEQUE //
/////////////////////////////////////////////////////////
export function addLivre(form) {
    
    // SELECTION DU TABLEAU
    const tabLivre = document.querySelector("#tabLivre");

    // RECUPERATION DES DONNEES DU FORMULAIRE
    const formData = new FormData(form);
    const titre = form.titre.value;
    const auteur = form.auteur.value;
    const genre = form.genre.value;
    const annee = form.annee.value;

    // if (titre === "" || auteur === "" || genre === "" || annee === "")

    fetch("index.php?controller=Livre&action=create",
        {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((data) =>
        {
            if (data) {

                // AJOUT DE LA NOUVELLE LIGNE DANS LE TABLEAU
                const tr = document.createElement("tr");
                tr.innerHTML = `<td class="text-start ps-3">${titre}</td>
                                <td class="text-start ps-3">${auteur}</td>
                                <td class="text-start ps-3">${genre}</td>
                                <td>${annee}</td>
                                <td><span class="badge bg-success">Disponible</span></td>
                                <td>
                                    <a class="btn btn-sm btn-warning text-white" href="index.php?controller=Evenement&action=formUpdate&id_evenement="
                                        title="Modifier">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger text-white" href="index.php?controller=Evenement&action=delete&id_evenement="
                                        title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet évènement ?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>`;
                tabLivre.insertBefore(tr, tabLivre.firstChild);        
            }
        })
        .catch(error => {
            console.error("Erreur:", error);
        });
}