const confirmDeletePuppy = (id, name) => {
    if (confirm(`Vous allez supprimer ${name}, en êtes-vous sûr ??`)) {
        location.assign('../administration/puppies/crud.php?id=' + id + "&delete=true");
    }
}

const confirmDeleteRepro = (id, name) => {
    if (confirm(`Vous allez supprimer le reproducteur ${name}, en êtes-vous sûr ??`)) {
        location.assign('../administration/repros/crud.php?id=' + id + "&delete=true");
    }
}
let reproDiv = document.getElementById('repro_breeder');
let breederReproNoButton = document.getElementById('breeder_no');
let inputReproName = document.createElement('input');
inputReproName.placeholder = "Entrez l'affixe du chien";
inputReproName.className = 'form-control';
inputReproName.name = 'repro_breeder';
breederReproNoButton.addEventListener('click', () => {
    reproDiv.appendChild(inputReproName);
});