
//export default function deleteItem() {
export function deleteItem() {
    document.querySelectorAll('.delete').forEach(link => {
        link.addEventListener('click', event => {
            event.preventDefault();
            let id = link.getAttribute('data-id');
            let url = link.getAttribute('data-url');
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let data = {
                id: id,
                _token: token
            };

            if (confirm('Voulez-vous vraiment supprimer cet évènement ?')) {

                fetch(url, {
                    //method: "GET",
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            item.closest('tr').remove();
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            }
        });
    });
}



// idcreation- //
// $REQUEST si asynchrones

document.querySelectorAll('.delete-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const creationId = this.getAttribute('data-id');

        if (confirm('Êtes-vous sûr de vouloir supprimer cette création ?')) {
            fetch(`index.php?controller=Creation&action=deleteCreation&id=${creationId}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`creation-${creationId}`).remove();
                        document.getElementById('message').innerHTML =
                            '<div class="success">' + data.message + '</div>';
                    } else {
                        document.getElementById('message').innerHTML =
                            '<div class="errorMsg">' + data.message + '</div>';
                    }
                })
                .catch(error => {
                    document.getElementById('message').innerHTML =
                        '<div class="errorMsg">Une erreur est survenue lors de la suppression.</div>';
                });
        }
    });
});