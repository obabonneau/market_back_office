// 
export const modalFormToken = document.querySelector("#modalFormToken");
export const modalFormId = document.querySelector("#modalFormId");
export const modalFormTitle = document.querySelector("#modalFormTitle");

const modalElement = document.querySelector("#modalForm");
export const modalForm = new bootstrap.Modal(modalElement, {
    backdrop: "static" // ou 'true'/'false'
});

modalElement.addEventListener('hidden.bs.modal', () => {
    // Vider le formulaire lorsque le modal est fermé
    document.querySelector("#modalForm form").reset();  // Réinitialise le formulaire à l'intérieur du modal
});