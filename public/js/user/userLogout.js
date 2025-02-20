////////////////////////////////////////////////////////
// 
////////////////////////////////////////////////////////

//-----------------------------------------------//
// 
//-----------------------------------------------//
document.querySelector("#btnLogout").addEventListener("click", () => {
    fetch("index.php?controller=Utilisateur&action=logout")
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                window.location.href = "index.php";
            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });
});