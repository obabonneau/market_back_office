//////////////////////////////////
// SCRIPT POUR GENERER UN TOKEN //
//////////////////////////////////
document.querySelector("#btnToken").addEventListener("click", () => {

    fetch("index.php?controller=Livre&action=formCreate",
    {
        method: "GET",
    })
    .then((response) => response.json())
    .then((token) => 
    {
        document.querySelector("#token").value = token; 
    })
    .catch(error => {
        console.error("Erreur:", error);
    })
});