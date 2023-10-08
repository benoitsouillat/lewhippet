let compteur = 0, elements, slides, timer, speed;

window.onload = () => {
    const diapo = document.querySelector('.diapo-container');
    elements = document.querySelector('.diapo');
    speed = diapo.dataset.speed;
    slides = Array.from(elements.children);

    let next = document.querySelector('.bi-caret-right');
    let before = document.querySelector('.bi-caret-left');
    next.addEventListener('click', slideNext);
    before.addEventListener('click', slideBefore);
    //timer = setInterval(slideNext, speed);
    // diapo.addEventListener('mouseover', autoSlideStop);
    // diapo.addEventListener('mouseout', autoSlideStart);

}

function slideNext() {
    compteur++;
    let decal = -100 * compteur;
    elements.style.transition = '1s ease-in-out';
    elements.style.transform = `translateX(${decal}%)`;
    setTimeout(function () {
        if (compteur >= slides.length - 1) {
            compteur = 0;
            elements.style.transition = 'unset';
            elements.style.transform = 'translateX(0)';
        }
    }, 1000);
}

function slideBefore() {
    compteur--;
    elements.style.transition = '1s ease-in-out';
    if (compteur < 0) {
        compteur = slides.length - 1;
        let decal = -100 * compteur;
        elements.style.transition = 'unset';
        elements.style.transform = `translateX(${decal}%)`;
        setTimeout(() => {
            slideBefore()
        }, 1);
    }
    let decal = -100 * compteur;
    elements.style.transform = `translateX(${decal}%)`;
}

function autoSlideStart() {
    setInterval(slideNext, speed);
}

function autoSlideStop() {
    clearInterval(timer);
}