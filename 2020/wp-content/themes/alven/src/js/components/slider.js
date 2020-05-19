import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin.js';

gsap.registerPlugin(ScrollToPlugin);

import 'hammerjs';
import { forEach } from '@stereorepo/sac';

const slider = () => {
    const slider = document.getElementById('slider');
    const nav = document.getElementById('slider-nav');

    if (!slider || !nav) return;

    const slides = slider.querySelectorAll('.slide');
    const btns = nav.querySelectorAll('button');
    let index = 0;
    let nextBtn;
    let slideNextCall;
    const mc = new Hammer(slider);

    const slide = btn => {
        slideNextCall.kill();

        forEach(slides, slide => {
            slide.classList.remove('on');
        });
        slider.querySelector('[data-startup="' + btn.dataset.slide + '"').classList.add('on');

        forEach(btns, elt => {
            elt.classList.remove('on');
        });
        btn.classList.add('on');
        btn.blur();

        slideNextCall = gsap.delayedCall(5, slideNext);
    };

    const slideNext = () => {
        index = [].indexOf.call(btns, nav.querySelector('.on'));
        nextBtn = btns[index + 1] ? btns[index + 1] : btns[0];
        slide(nextBtn);
    };

    const slidePrev = () => {
        index = [].indexOf.call(btns, nav.querySelector('.on'));
        nextBtn = btns[index - 1] ? btns[index - 1] : btns[btns.length - 1];
        slide(nextBtn);
    };

    slideNextCall = gsap.delayedCall(5, slideNext);

    forEach(btns, btn => {
        btn.addEventListener(
            'click',
            () => {
                slide(btn);
            },
            false
        );
    });

    mc.on('swipeleft', () => {
        slideNextCall.kill();
        slideNext();
    });

    mc.on('swiperight', () => {
        slideNextCall.kill();
        slidePrev();
    });
};

export default slider;
