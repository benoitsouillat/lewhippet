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