//----------------------------------------------------------//
// FONCTION POUR LES MESSAGES D'ERREUR DANS LES FORMULAIRES //
//----------------------------------------------------------//

// FONCTION POUR AFFICHER LES ERREURS
export function showError(fieldError, message) {
    fieldError.textContent = message;
    fieldError.style.display = "block";
}

// FONCTION POUR EFFACER LES ERREURS
export function eraseError(fieldError) {
    fieldError.textContent = "";
    fieldError.style.display = "none";
}