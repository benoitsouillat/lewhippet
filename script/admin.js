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

const confirmDeleteLitter = (id, name) => {
    if (confirm(`Vous allez supprimer la portée de ${name}, en êtes-vous sûr ??`)) {
        location.assign('../administration/litters/crud.php?id=' + id + "&delete=true");
    }
}
let reproDiv = document.getElementById('repro_breeder');
let breederReproNoButton = document.getElementById('breeder_no');
let breederReproYesButton = document.getElementById('breeder_yes');
let inputReproName = document.createElement('input');
inputReproName.placeholder = "Entrez l'affixe du chien";
inputReproName.className = 'form-control border border-3 border-primary bg-light';
inputReproName.name = 'repro_breeder';

if (breederReproNoButton) {
    if (breederReproNoButton.checked) {
        inputReproName.value = breederReproNoButton.value;
        reproDiv.appendChild(inputReproName);
    }
    breederReproNoButton.addEventListener('click', (e) => {
        reproDiv.appendChild(inputReproName);
    });
    breederReproYesButton.addEventListener('click', (e) => {
        console.info(e.target.value);
        if (inputReproName) {
            reproDiv.removeChild(inputReproName);
        }
    })
}
