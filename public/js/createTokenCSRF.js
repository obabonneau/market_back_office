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
        document.querySelector("#tokenCSRF").value = token.id; 
    })
    .catch(error => {
        //console.error("Erreur:", error);
    })