import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin.js';

gsap.registerPlugin(ScrollToPlugin);

const slider = () => {
    const slider = document.getElementById('slider');
    const nav = document.getElementById('slider-nav');

    if (!slider || !nav) return;

    const slides = slider.querySelectorAll('.slide');
    const btns = nav.querySelectorAll('button');
    let index = 0;
    let nextBtn;
    let slideAutoCall;

    const slide = btn => {
        slideAutoCall.kill();

        slides.forEach(slide => {
            slide.classList.remove('on');
        });
        slider.querySelector('[data-startup="' + btn.dataset.slide + '"').classList.add('on');

        btns.forEach(elt => {
            elt.classList.remove('on');
        });
        btn.classList.add('on');
        btn.blur();

        slideAutoCall = gsap.delayedCall(5, slideAuto);
    };

    const slideAuto = () => {
        index = [].indexOf.call(btns, nav.querySelector('.on'));
        nextBtn = btns[index + 1] ? btns[index + 1] : btns[0];
        slide(nextBtn);
    };

    slideAutoCall = gsap.delayedCall(5, slideAuto);

    btns.forEach(btn => {
        btn.addEventListener(
            'click',
            () => {
                slide(btn);
            },
            false
        );
    });
};

export default slider;
