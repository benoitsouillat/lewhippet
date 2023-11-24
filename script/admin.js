const confirmDeletePuppy = (id, name) => {
    if (confirm(`Vous allez supprimer ${name}, en êtes-vous sûr ??`)) {
        location.assign('../administration/puppies/crud.php?id=' + id + "&delete=true");
    }
}

const toggleActivePuppy = (id, state) => {
    state ?
        location.assign('../administration/puppies/updater.php?puppyId=' + id + '&enable=0')
        :
        location.assign('../administration/puppies/updater.php?puppyId=' + id + '&enable=1')
}

const toggleActiveLitter = (id, state) => {
    state ?
        location.assign('../administration/litters/updater.php?litterId=' + id + '&enable=0')
        :
        location.assign('../administration/litters/updater.php?litterId=' + id + '&enable=1')
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

const errorReproDisplay = () => {
    errorContainer = document.getElementById('errorContainer');
    errorArray.forEach(error => {
        errorDiv = document.createElement('div');
        errorDiv.className = "error_php alert alert-danger text-center";
        errorText = document.createElement('p');
        if (error == 10000)
            errorText.innerText = 'Une erreur de test';
        else if (error == 23000)
            errorText.innerText = "Vous ne pouvez pas supprimer un reproducteur qui possède une portée.";
        else
            errorText.innerText = 'Ca marche pas !';
        errorDiv.appendChild(errorText);
        errorContainer.appendChild(errorDiv);
    });
}
const errorLitterDisplay = () => {
    errorContainer = document.getElementById('errorContainer');
    errorArray.forEach(error => {
        errorDiv = document.createElement('div');
        errorDiv.className = "error_php alert alert-danger text-center";
        errorText = document.createElement('p');
        if (error == 10000)
            errorText.innerText = 'Une erreur de test';
        else if (error == 23000)
            errorText.innerText = "Vous ne pouvez pas supprimer une portée qui possède encore des chiots.";
        else
            errorText.innerText = 'Ca marche pas !';
        errorDiv.appendChild(errorText);
        errorContainer.appendChild(errorDiv);
    });
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
