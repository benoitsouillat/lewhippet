let compteur = 0, elements, slides;

window.onload = () => {
    const diapo = document.querySelector('.diapo-container');
    elements = document.querySelector('.diapo');
    slides = Array.from(elements.children);

    let next = document.querySelector('.bi-caret-right');
    next.addEventListener('click', slideNext);
    let before = document.querySelector('.bi-caret-left');
    before.addEventListener('click', slideBefore);
}

function slideNext() {
    compteur++;
    console.log(compteur);
    if (compteur > slides.length - 1) {
        compteur = 0;
        elements.style.transition = 'unset';
        elements.style.transform = 'translate(0)';
    }
    let decal = -100 * compteur;
    elements.style.transform = `translate(${decal}%)`;

}

function slideBefore() {
    compteur--;
    if (compteur < 0) {
        compteur = slides.length - 1;
        elements.style.transform = `translate(-200%)`;
        elements.style.transition = 'unset';

    }
    else if (compteur >= 0) {
        let decal = -100 * compteur;
        elements.style.transform = `translate(${decal}%)`;
    }
}