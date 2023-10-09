
window.onload = () => {
    const diapos = document.querySelectorAll('.diapo-container');
    diapos.forEach((diapo) => {
        let compteur = 0;
        let dogId = 0;
        let elements, slides, timer, speed;
        dogId = diapo.dataset.dogId;
        console.log(dogId);

        elements = document.querySelector('.diapo-' + dogId);
        slides = Array.from(elements.children);

        let next = document.querySelector('.bi-caret-right-' + dogId);
        let before = document.querySelector('.bi-caret-left-' + dogId);
        next.addEventListener('click', slideNext);
        before.addEventListener('click', slideBefore);
        // speed = diapo.dataset.speed;
        //timer = setInterval(slideNext, speed);
        // diapo.addEventListener('mouseover', autoSlideStop);
        // diapo.addEventListener('mouseout', autoSlideStart);


        function slideNext() {
            console.info('ca clic clic clic')
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
    });

}
function autoSlideStart() {
    setInterval(slideNext, speed);
}

function autoSlideStop() {
    clearInterval(timer);
}