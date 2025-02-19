//////////////////////////////////////
// SCRIPT POUR TESTER LE FORMULAIRE //
//////////////////////////////////////

// DEFINITION DES REGEX
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
const mdpRegex = /^.{4,}$/;

// SELECTION DES ELEMENTS DU DOM
const tokenCSRF = document.querySelector("#tokenCSRF");
const emailLogin = document.querySelector("#emailLogin");
const mdpLogin = document.querySelector("#mdpLogin");
const emailError = document.querySelector("#emailError");
const mdpError = document.querySelector("#mdpError");


//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE AU SUBMIT //
//-----------------------------------------------//
document.querySelector("#formLogin").addEventListener("submit", function(event) {
   
    // EMPECHER L'ENVOI DU FORMULAIRE
    event.preventDefault();
    let isValid = true;

    // VALIDATION DE L'EMAIL
    if (!emailRegex.test(emailLogin.value)) {
        showError(emailError, "L'email n'est pas valide.");
        isValid = false;
    } else {
        eraseError(emailError);
    }

    // VALIDATION DU MOT DE PASSE
    if (!mdpRegex.test(mdpLogin.value)) {
        showError(mdpError, "Le mdp doit contenir au moins 8 caractères.");
        isValid = false;
    }   else {
        eraseError(mdpError);
    }

    // SI LE FORMULAIRE EST VALIDE, ON LANCE LA VERIFICATION DU USER ET DU MDP
    if (isValid) {
        ctrlUser(tokenCSRF.value, emailLogin.value, mdpLogin.value);
    }
});


//-----------------------------------------------//
// VALIDATION DES CHAMPS DU FORMULAIRE EN ERREUR //
//-----------------------------------------------//

// ECOUTER SUR LE CHAMP DU TITRE
emailLogin.addEventListener("input", () => {
    if (emailRegex.test(emailLogin.value)) {
        eraseError(emailError);
    }
});


// ECOUTEUR SUR LE CHAMP DE L'AUTEUR
mdpLogin.addEventListener("input", () => {
    if (mdpRegex.test(mdpLogin.value)) {
        eraseError(mdpError);
    }
});


//----------------------------------//
// FONCTION D'AFFICHAGE DES ERREURS //
//----------------------------------//

// FONCTION POUR AFFICHER LES ERREURS
function showError(fieldError, message) {
    fieldError.textContent = message;
    fieldError.style.display = "block";
}

// FONCTION POUR EFFACER LES ERREURS
function eraseError(fieldError) {
    fieldError.textContent = "";
    fieldError.style.display = "none";
}


//
// 
//
function ctrlUser(token, email, mdp) {
    fetch("index.php?controller=Utilisateur&action=logon", {
        method: "POST",
        body: JSON.stringify({
            token: token,
            email: email,
            mdp: mdp,
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.success === true) {
                window.location.href = "index.php?controller=Home&action=home";
            }
        })
        .catch(error => {
            //console.error("Erreur:", error);
        });
};

// ul.innerHTML = "";
// data.forEach(element => {
//     const li = document.createElement("li");
//     li.textContent = element.name + ": " + element.category;
//     ul.appendChild(li);
// });