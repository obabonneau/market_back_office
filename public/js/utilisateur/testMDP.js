//////////////////////////////////////////
// CONTROLE DU MOT DE PASSE UTILISATEUR //
//////////////////////////////////////////

// DECLARATION DES CONSTANTES
const requirements = {
    length: { regex: /.{8,}/, element: 'length' },
    lowercase: { regex: /[a-z]/, element: 'lowercase' },
    uppercase: { regex: /[A-Z]/, element: 'uppercase' },
    number: { regex: /[0-9]/, element: 'number' },
    special: { regex: /[!@#$%^&*(),.?":{}|<>[\]\\\/+=~`'_;-]/, element: 'special' }
};
const colors = ["red", "orange", "green"];

// SELECTION DES ELEMENTS DU DOM
const password = document.querySelector("#password");
const showPassword = document.querySelector("#showPassword");
const menuCheck = document.querySelector("#menuCheck");
const progressBar = document.querySelector("#progressBar");


//------------------------------------//
// AFFICHAGE DU MOT DE PASSE EN CLAIR //
//------------------------------------//
showPassword.addEventListener("change", () => {
    if (showPassword.checked) {
        password.type = "text";
    } else {
        password.type = "password";
    }
});


//-----------------------------------------------//
// AFFICHAGE DU MENU DE CONTROLE DU MOT DE PASSE //
//-----------------------------------------------//
password.addEventListener("click", (event) => {
    menuCheck.style.display = "block";
    event.stopPropagation(); // Empêche la propagation pour éviter la fermeture immédiate
});

// FERMETURE DU MENU DE CONTROLE EN DEHORS DE LA ZONE
document.addEventListener("click", () => {
    menuCheck.style.display = "none";
});

// EMPECHER LA FERMETURE DU MENU DE CONROLE EN CLIQUANT DEDANS
menuCheck.addEventListener("click", (event) => {
    event.stopPropagation();
});


//------------------------------//
// VERIFICATION DU MOT DE PASSE //
//------------------------------//
password.addEventListener("input", (event) => {
    checkPassword(event.target.value);
});

// FONCTION DE VERIFICATION DU MOT DE PASSE
function checkPassword(password) {
    Object.values(requirements).forEach(({ regex, element }) => {
        const isOk = regex.test(password);
        checkDisplay(`#${element}`, isOk);
    });
    majProgression();
}

// FONCTION D'AFFICHAGE DE L'ICONE DE VALIDATION
function checkDisplay(unit, isOk) {
    const element = document.querySelector(unit);
    const addClasses = isOk ? ["bi-check-circle-fill", "text-success"] : ["bi-x-circle-fill", "text-danger"];
    const removeClasses = isOk ? ["bi-x-circle-fill", "text-danger"] : ["bi-check-circle-fill", "text-success"]; 
    element.classList.remove(...removeClasses); //... pour extraire les éléments du tableau
    element.classList.add(...addClasses);
}

// FONCTION D'AFFICHAGE DE LA BARRE DE PROGRESSION
function majProgression() {
    const checkCount = document.querySelectorAll(".bi-check-circle-fill");
    checkPourcentage = checkCount.length * 100/5;  
    progressBar.style.width = `${checkPourcentage}%`;
    const colorIndex = checkPourcentage < 50 ? 0 : checkPourcentage < 90 ? 1 : 2; 
    progressBar.style.backgroundColor = colors[colorIndex];
}