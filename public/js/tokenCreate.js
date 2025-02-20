//////////////////////////////////
// SCRIPT POUR GENERER UN TOKEN //
//////////////////////////////////
fetch("index.php?controller=Token&action=create")
    .then((response) => response.json())
    .then((token) => 
    {
        document.querySelector("#token").value = token.id; 
    })
    .catch(error => {
        //console.error("Erreur:", error);
    })


export async function tokenCreate() {
    try {
        const response = await fetch("index.php?controller=Token&action=create");
        const token = await response.json();
        return token.id;

    } catch (error) {
        // Gérer l'erreur et l'afficher dans la console
        console.error("Erreur:", error);
    }
}

    
const btnToken = document.querySelector("#btnToken");
if (btnToken) {
    btnToken.addEventListener("click", () => {
        fetch("index.php?controller=Token&action=create")
            .then((response) => response.json())
            .then((token) => {
                document.querySelector("#token").value = token.id;
            })
            .catch(error => {
                //console.error("Erreur:", error);
            })
    });
}