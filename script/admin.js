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