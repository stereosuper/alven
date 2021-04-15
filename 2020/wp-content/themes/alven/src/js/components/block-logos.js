import { forEach } from '@stereorepo/sac';
import { gsap } from 'gsap';

const blockLogos = () => {
    const logos = document.getElementsByClassName('js-logos');

    if (!logos.length) return;

    const nexts = document.getElementsByClassName('js-logos-next');
    const prevs = document.getElementsByClassName('js-logos-prev');

    const setSlider = slider => {
        const nbLogosDisplayed = window.innerWidth > 767 ? 4 : 2;

        slider.dataset.next = 0;
        slider.dataset.prev = 0;
        slider.dataset.nbLogos = slider.querySelectorAll('.js-logo').length;

        if (slider.dataset.nbLogos > nbLogosDisplayed) {
            slider.querySelector('.js-logos-prev').classList.remove('off');
            slider.querySelector('.js-logos-next').classList.remove('off');
        }
    };

    const slideNext = (slider, list, nbLogosDisplayed, widthLogo) => {
        if (slider.dataset.nbLogos - nbLogosDisplayed - slider.dataset.next > 0) {
            gsap.to(list, 0.3, { x: '-=' + widthLogo });
            slider.dataset.next = +slider.dataset.next + 1;
            slider.dataset.prev = +slider.dataset.prev - 1;
            slider.querySelector('.js-logos-prev').removeAttribute('disabled');
        } else {
            slider.querySelector('.js-logos-next').setAttribute('disabled', true);
        }
    };

    const slidePrev = (slider, list, widthLogo) => {
        if (slider.dataset.prev < 0) {
            gsap.to(list, 0.3, { x: '+=' + widthLogo });
            slider.dataset.prev = +slider.dataset.prev + 1;
            slider.dataset.next = +slider.dataset.next - 1;
            slider.querySelector('.js-logos-next').removeAttribute('disabled');
        } else {
            slider.querySelector('.js-logos-prev').setAttribute('disabled', true);
        }
    };

    const slide = (id, dir) => {
        const slider = document.getElementById(id);
        const list = slider.querySelector('.js-logos-list');

        if (gsap.isTweening(list)) return;

        const wWidth = window.innerWidth;
        const widthLogo = wWidth > 767 ? '25%' : '50%';
        const nbLogosDisplayed = wWidth > 767 ? 4 : 2;

        dir === 'next' ? slideNext(slider, list, nbLogosDisplayed, widthLogo) : slidePrev(slider, list, widthLogo);
    };

    forEach(logos, logosSlider => setSlider(logosSlider));
    forEach(nexts, next => next.addEventListener('click', () => slide(next.dataset.slider, 'next'), false));
    forEach(prevs, prev => prev.addEventListener('click', () => slide(prev.dataset.slider, 'prev'), false));
};

export default blockLogos;
