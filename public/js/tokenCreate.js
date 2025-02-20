//////////////////////////////////
// SCRIPT POUR GENERER UN TOKEN //
//////////////////////////////////
fetch("index.php?controller=Token&action=create",
    {
        method: "GET",
    })
    .then((response) => response.json())
    .then((token) => 
    {
        document.querySelector("#token").value = token.id; 
    })
    .catch(error => {
        //console.error("Erreur:", error);
    })

    
const btnToken = document.querySelector("#btnToken");
if (btnToken) {
    btnToken.addEventListener("click", () => {
        fetch("index.php?controller=Token&action=create",
            {
                method: "GET",
            })
            .then((response) => response.json())
            .then((token) => {
                document.querySelector("#token").value = token.id;
            })
            .catch(error => {
                //console.error("Erreur:", error);
            })
    });
}