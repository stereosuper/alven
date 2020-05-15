import { gsap } from 'gsap';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin.js';

gsap.registerPlugin(ScrollToPlugin);

import { forEach } from '@stereorepo/sac';

const gallery = () => {
    const galleries = document.querySelectorAll('.gallery-wrapper');

    if (!galleries.length) return;

    const slide = (gallery, dir) => {
        const galleryInner = gallery.querySelector('.gallery');
        const imgs = gallery.querySelectorAll('.img');
        const next = gallery.querySelector('.next');
        const prev = gallery.querySelector('.prev');

        let x = parseInt(gallery.dataset.x);

        if (dir === 'next') {
            gallery.dataset.x = x - imgs[gallery.dataset.index].clientWidth;
            gallery.dataset.index++;
        } else {
            gallery.dataset.x = x + imgs[gallery.dataset.index - 1].clientWidth;
            gallery.dataset.index--;
        }

        x = parseInt(gallery.dataset.x);

        gsap.to(galleryInner, 0.3, { x: x });

        galleryInner.clientWidth + x < gallery.clientWidth ? next.classList.add('off') : next.classList.remove('off');
        x < 0 ? prev.classList.remove('off') : prev.classList.add('off');
    };

    forEach(galleries, gallery => {
        gallery.dataset.index = 0;
        gallery.dataset.x = 0;

        gallery.querySelector('.next').addEventListener(
            'click',
            () => {
                slide(gallery, 'next');
            },
            false
        );

        gallery.querySelector('.prev').addEventListener(
            'click',
            () => {
                slide(gallery, 'prev');
            },
            false
        );
    });
};

export default gallery;
