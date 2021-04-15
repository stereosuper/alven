import { gsap } from 'gsap';
import vimeo from './vimeo';
import { forEach } from '@stereorepo/sac';

const videos = () => {
    const wrapper = document.getElementById('videos');
    const slider = document.getElementById('videos-slider');

    if (!wrapper || !slider) return;

    let slides = slider.querySelectorAll('.slide-video');
    let slideW = slides[0].offsetWidth;
    const lastSlideIndex = slides.length - 1;
    const lastSlide = slides[lastSlideIndex];

    const sliderText = wrapper.querySelector('#video-text');
    const nexts = wrapper.querySelectorAll('.js-video-next');
    const prevs = wrapper.querySelectorAll('.js-video-prev');
    const btns = wrapper.querySelectorAll('.js-video-nav');

    let currentPlayer;

    // center slider
    const setInitialPos = () => {
        const wWidth = window.innerWidth;
        let ratio = 0.5;

        if (wWidth < 768) {
            ratio = 1;
        } else if (wWidth < 1264) {
            ratio = 0.825;
        }

        gsap.set(slider, { left: -slideW * ratio, opacity: 1 });
    };

    // update text
    const updateText = () =>
        gsap.to(sliderText, 0.3, {
            opacity: 0,
            y: 20,
            onComplete: () => {
                sliderText.innerHTML = '';
                sliderText.appendChild(slider.querySelector('.on').querySelector('.js-video-text').cloneNode(true));
                gsap.to(sliderText, 0.3, { opacity: 1, y: 0 });
            }
        });

    // set active slide
    const setActiveSlide = newSlide => {
        // set active slide
        slides[1].classList.remove('on');
        slides[newSlide].classList.add('on');

        // set player
        vimeo.unloadPlayer(currentPlayer);
        currentPlayer = vimeo.addPlayer(slides[newSlide].querySelector('.video'));

        // set active nav btn
        forEach(btns, btn => btn.classList.remove('on'));
        wrapper.querySelector('[data-slide="' + (slides[newSlide].dataset.index | 0) + '"]').classList.add('on');
    };

    // slide next
    const slideNext = noTransition => {
        if (gsap.isTweening(slider)) return;

        const dur = noTransition === true ? 0 : 0.3;

        slides = slider.querySelectorAll('.slide-video');

        // clone first slide and add it at the end
        slider.appendChild(slides[0].cloneNode(true));

        // set active slide
        setActiveSlide(2);

        // slide
        gsap.to(slider, dur, {
            x: -slideW,
            // once slider has slided, remove first slide and put slider at the right place
            onComplete: () => {
                slider.removeChild(slides[0]);
                gsap.set(slider, { x: 0 });
            }
        });

        if (noTransition !== true) updateText();
    };

    // slide prev
    const slidePrev = () => {
        if (gsap.isTweening(slider)) return;

        slides = slider.querySelectorAll('.slide-video');

        // clone last slide, add it at the beginning and put slider at the right place
        slider.insertBefore(slides[lastSlideIndex].cloneNode(true), slides[0]);
        gsap.set(slider, { x: -slideW });

        // set active slide
        setActiveSlide(0);

        // slide
        gsap.to(slider, 0.3, {
            x: 0,
            // once slider has slided, remove last slide
            onComplete: () => slider.removeChild(slides[lastSlideIndex])
        });

        updateText();
    };

    // slide
    const slide = slide => {
        if (gsap.isTweening(slider)) return;

        const nbSlide = slide | 0;

        slides = slider.querySelectorAll('.slide-video');

        // get index of the next slide to display
        const nextSlide = [].slice.call(slides).indexOf(slider.querySelector('[data-index="' + nbSlide + '"]'));
        // get index of the current active slide
        const currentSlide = [].slice.call(slides).indexOf(slider.querySelector('.on'));
        // get the difference between those indexes to know how many times to slide next
        const nbSlidesToMove = nextSlide === 0 ? slides.length - currentSlide : nextSlide - currentSlide;

        let i = 0;
        for (i; i < nbSlidesToMove; i++) {
            slideNext(i < nbSlidesToMove - 1);
        }
    };

    // center slider and then make it appear and add first player
    slider.insertBefore(lastSlide.cloneNode(true), slides[0]);
    slider.removeChild(lastSlide);
    btns[0].classList.add('on');
    setInitialPos();
    updateText();
    currentPlayer = vimeo.addPlayer(slides[0].querySelector('.video'));

    // add events
    forEach(nexts, next => next.addEventListener('click', slideNext, false));
    forEach(prevs, prev => prev.addEventListener('click', slidePrev, false));
    forEach(btns, btn => btn.addEventListener('click', () => slide(btn.dataset.slide), false));

    // resize
    window.$stereorepo.superWindow.initializeWindow();
    window.$stereorepo.superWindow.addResizeFunction(() => {
        slides = slider.querySelectorAll('.slide-video');
        slideW = slides[0].offsetWidth;
        setInitialPos();
    });
};

export default videos;
