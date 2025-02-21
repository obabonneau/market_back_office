//////////////////////////////////
// SCRIPT POUR GENERER UN TOKEN //
//////////////////////////////////

//--------------------------------//
// FONCTION POUR GENERER UN TOKEN //
//--------------------------------//
export async function tokenCreate() {
    try {
        const response = await fetch("index.php?controller=Token&action=create");
        const token = await response.json();
        return token.id;
    } catch (error) {
        //console.error("Erreur:", error);
    }
}